<?php

namespace App\Policies;

use App\User;
use App\Follow;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can unfollow the given user.
     *
     * @param  User  $user
     * @param  Follow  $follow
     * @return bool
     */
    public function destroy(User $user, Follow $follow)
    {
        return $user->id === $follow->user_id;
    }
}
