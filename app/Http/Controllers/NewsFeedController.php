<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsFeedController extends Controller
{
    /**
     * Construct a new NewsFeedController instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display news feed.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        // Get your timeline:
        $feed = \FeedManager::getNewsFeeds($request->user()->id)['timeline'];

        // Get your timeline activities from Stream:
        $activities = $feed->getActivities(0,25)['results'];

        return view('news_feed.index', [
            'activities' => $activities,
        ]);
    }
}
