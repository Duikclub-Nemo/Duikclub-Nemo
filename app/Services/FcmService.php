<?php

namespace App\Services;

use App\Models\FcmToken;
use App\Models\User;
use Exception;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FcmService
{
    protected Messaging $messaging;

    public function __construct()
    {
        $factory = (new Factory())
            ->withServiceAccount(storage_path(''));
        $this->messaging = $factory->createMessaging();
    }

    /**
     * Send a notification to a specific user
     */
    public function sendToUser(
        User  $user,
        array $data
    ): array
    {
        $tokens = $user->fcmTokens->pluck('token')->unique()->values()->toArray();

        if (empty($tokens)) {
            return [
                'success' => false,
                'message' => 'User has no registered devices',
            ];
        }

        return $this->sendToTokens($tokens, $data);
    }

    /**
     * Send notification to specific tokens
     */
    protected function sendToTokens(
        array $tokens,
        array $data
    ): array
    {
        if (!isset($data['messageId'])) {
            $data['messageId'] = uniqid();
        }

        // Create a message
        $message = CloudMessage::new()
            ->withData($data);

        try {
            $sendReport = $this->messaging->sendMulticast($message, $tokens);

            // Handle invalid tokens
            if ($sendReport->hasFailures()) {
                $invalidTokens = [];

                foreach ($sendReport->failures()->getItems() as $failure) {
                    $error = $failure->error()->getMessage();
                    $shouldRemove = in_array($error, [
                        'messaging/invalid-argument',
                        'messaging/registration-token-not-registered',
                    ]);

                    if ($shouldRemove) {
                        $invalidTokens[] = $tokens[$failure->index()];
                    }
                }
                // Remove invalid tokens from the database
                if (!empty($invalidTokens)) {
                    FcmToken::whereIn('token', $invalidTokens)->delete();
                }
            }

            return [
                'success' => true,
                'message' => 'Notification sent',
                'successes' => $sendReport->successes()->count(),
                'failures' => $sendReport->failures()->count(),
            ];

        } catch (Exception|MessagingException|FirebaseException $e) {
            return ['success' => false,
                'message' => 'Failed to send notification: ' . $e->getMessage(),];
        }

    }

}
