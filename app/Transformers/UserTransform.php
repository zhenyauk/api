<?php

namespace App\Transformers;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransform extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'user_name' => $user->name,
            'user_lname' => $user->user_lname,
            'user_email' => $user->email,
            'user_phone' => $user->user_phone,
            'user_bill_number' => $user->user_billnumber,
        ];
    }
}
