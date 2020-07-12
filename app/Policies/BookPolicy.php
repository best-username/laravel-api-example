<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $board
     * @return mixed
     */
    public function update(User $user, Book $board)
    {
        return $user->id === $board->creator_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $board
     * @return mixed
     */
    public function delete(User $user, Book $board)
    {
        return $user->id === $board->creator_id;
    }

}
