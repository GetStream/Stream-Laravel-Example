<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use \GetStream\StreamLaravel\Eloquent\ActivityTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Stream: Add extra activity data - task name, and user's display name:
     */
    public function activityExtraData()
    {
        return array('name'=>$this->name, 'display_name' => $this->display_name);
    }


   /**
    * Stream: Change activity verb to 'created':
    */
    public function activityVerb()
    {
        return 'created';
    }

}
