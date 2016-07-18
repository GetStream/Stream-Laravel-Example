<?php

namespace App\Repositories;

use App\User;
use DB;

class UserRepository
{
    /**
     * Get all users, sorted by 'following', and 'not_following' - and follow information for a given user
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {

        // Following:
        $query = 'SELECT id, name, email FROM users WHERE id IN (SELECT follow_id FROM follows WHERE user_id = ?)';

        $following = DB::select($query, [$user->id]);

        foreach($following as $key => $value) {
            $query = 'SELECT id FROM follows WHERE user_id = ? AND follow_id = ? LIMIT 1';
            $following[$key]->follow_id = DB::select($query, [$user->id, $value->id])[0]->id;
        }

        // Not Following:
        $query = 'SELECT id, name, email FROM users WHERE id
        NOT IN (SELECT follow_id FROM follows WHERE user_id = ?)';
        $not_following = DB::select($query, [$user->id]);

        return [
            'following' => $following,
            'not_following' => $not_following
        ];
    }
}
