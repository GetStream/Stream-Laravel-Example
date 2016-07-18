<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Follow;
use App\Repositories\UserRepository;

class FollowController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }


    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'follow_id' => 'required|max:255',
        ]);

        $request->user()->follows()->create([
            'follow_id' => $request->follow_id,
        ]);

        \FeedManager::followUser($request->user()->id, $request->follow_id);

        return redirect('/users');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Follow $follow
     * @return Response
     */
    public function destroy(Request $request, Follow $follow)
    {

        $this->authorize('destroy', $follow);
        $follow->delete();

        \FeedManager::unfollowUser($request->user()->id, $follow->follow_id);

        return redirect('/users');
    }

    /**
     * Display a list of all users in system - divided by .
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('users.index', [
            'users' => $this->users->forUser($request->user()),
        ]);
    }
}
