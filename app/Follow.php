<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['follow_id'];


    /**
     * Get the user that has the follow.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
