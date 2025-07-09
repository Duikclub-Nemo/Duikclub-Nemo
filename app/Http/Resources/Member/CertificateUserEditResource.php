<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateUserEditResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'certificate_id' => $this->certificate->id,
            'certificate_type' => $this->certificate->certificate_type,
            'date_of_issue' => $this->date_of_issue->format('Y-m-d'),
            'certificate_number' => $this->certificate_number,
            'federation' => $this->federation,
        ];
    }
}
