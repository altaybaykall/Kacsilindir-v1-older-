<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AuthPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user):bool
    {
        if (Auth::Check()) {
            return $user->type == 'admin';

        }
        return false;
    }
}
