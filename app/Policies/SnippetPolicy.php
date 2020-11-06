<?php

namespace App\Policies;

use App\Snippet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
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

    public function show(?User $user,Snippet $snippet)
    {
        if ($snippet->isPublic()){
            return true;
        }
        return $snippet->user_id === $user->id;
    }

    public function update(User $user,Snippet $snippet)
    {
        return $snippet->user_id === $user->id;
    }

    public function createStep(User $user,Snippet $snippet)
    {
        return $snippet->user_id === $user->id;
    }
}
