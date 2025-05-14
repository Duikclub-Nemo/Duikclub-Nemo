<?php

namespace Database\Factories;

use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        $created_at = fake()->dateTimeBetween('-10 years');
        $deleted_at = fake()->dateTimeBetween($created_at, now());

        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => null,

            //Additional columns
            'uuid' => Str::uuid(),
            'first_name' => $first_name,
            'initials' => $first_name[0] . '.',
            'last_name' => $last_name,
            'gender' => fake()->randomElement(GenderEnum::cases()),
            'date_of_birth' => fake()->dateTimeBetween('-60 years', '-10 years'),
            'street' => fake()->streetAddress(),
            'zipcode' => fake()->postcode(),
            'place' => fake()->randomElement(['Kerkrade', 'Landgraaf', 'Heerlen', 'Brunssum']),
            'country_id' => 154,
            'phone_number' => fake()->numerify('06########'),
            'about_me' => fake()->optional()->paragraph(),
            'avatar' => null,
            'medical_check' => fake()->optional()->dateTimeBetween('-1 years', now()),
            'dives' => fake()->optional()->randomNumber(4),
            'federation' => FederationEnum::NOB,
            'federation_membership' => fake()->optional()->numerify('#######'),
            'ice_name' => null,
            'ice_phone_number' => null,
            'privacy_mode' => fake()->boolean(),
            'display_userlist' => true,
            'accepted_terms' => null,
            'last_online' => null,
            'notify_push_admin' => fake()->boolean,
            'notify_push_news_added' => fake()->boolean,
            'notify_push_news_edited' => fake()->boolean,
            'notify_push_activity_added' => fake()->boolean,
            'notify_push_activity_edited' => fake()->boolean,
            'notify_push_activity_removed' => fake()->boolean,
            'notify_push_activity_reminder' => fake()->boolean,
            'notify_push_activity_reminder_minutes_before' => fake()->numberBetween(15, 300),
            'notify_push_subscription_added' => fake()->boolean,
            'notify_push_subscription_edited' => fake()->boolean,
            'notify_push_subscription_removed' => fake()->boolean,
            'notify_mail_admin' => fake()->boolean,
            'notify_mail_news_added' => fake()->boolean,
            'notify_mail_news_edited' => fake()->boolean,
            'notify_mail_activity_added' => fake()->boolean,
            'notify_mail_activity_edited' => fake()->boolean,
            'notify_mail_activity_removed' => fake()->boolean,
            'notify_mail_activity_reminder' => fake()->boolean,
            'notify_mail_activity_reminder_minutes_before' => fake()->numberBetween(15, 300),
            'notify_mail_subscription_added' => fake()->boolean,
            'notify_mail_subscription_edited' => fake()->boolean,
            'notify_mail_subscription_removed' => fake()->boolean,
            'created_by' => 1,
            'created_at' => $created_at,
            'deleted_at' => fake()->optional()->randomElement([$deleted_at])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Assign a Role to User
     *
     * @param RoleEnum $role
     * @return $this
     */
    public function withRole(RoleEnum $role): static
    {
        return $this->afterCreating(function (User $user) use ($role) {
            $user->assignRole($role);
        });
    }

}
