<?php

namespace App\Services;

use App\Formatting;
use App\Models\User;
use App\Notifications\NewUserEmailNotification;
use App\Notifications\NewUserSMSNotification;
use Exception;

class UsersService
{
    use Formatting;

    public function registerUser(string $name, string $email, int $countryId, string $phone): array
    {
        $user = false;
        try {
            $user = User::query()->create([
                'name'   => $name,
                'email'  => $email
            ]);

            $user->phoneBook()->create([
                'phone' => $this->modifyPhone($phone)
            ]);

            $user->country()->sync($countryId);

            $result = [
                'success' => true,
                'user' => $name
            ];

            $user->notify(new NewUserSMSNotification());
            $user->notify(new NewUserEmailNotification());

        } catch (Exception $exception) {
            if ($user) {
                $user->delete();
            }
            $result = [
                'success' => false,
                'error'   => str_replace("'",'',$exception->getMessage())
            ];
        }


        return $result;
    }
}
