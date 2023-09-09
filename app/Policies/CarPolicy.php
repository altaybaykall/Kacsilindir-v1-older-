<?php

namespace App\Policies;

use App\Models\CarComments;
use App\Models\CarsComments;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CarsComments $carsComments): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CarComments $carsComments): bool
    {
        if ($user->type === 'admin') {
            return true;
        }
        return $user->id == $carsComments->user_id ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CarsComments $carsComments): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CarsComments $carsComments): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CarsComments $carsComments): bool
    {
        //
    }
}
