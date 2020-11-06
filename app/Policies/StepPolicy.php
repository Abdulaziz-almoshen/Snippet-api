<?php

namespace App\Policies;

use App\Snippet;
use App\Step;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,Step $step)
    {
        return $step->snippet->user_id === $user->id;
    }
    public function destroy(User $user,Step $step)
    {
        return $step->snippet->user_id === $user->id;
    }

}
