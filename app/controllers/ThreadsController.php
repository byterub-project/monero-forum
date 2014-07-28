<?php

class ThreadsController extends \BaseController {
	
	//Display of a thread needs to be calculated individually.
	
	public function index($forum_slug, $forum_id, $thread_slug, $thread_id)
	{
		$posts = Post::where('thread_id', '=', $thread_id)->whereNull('parent_id')->orderBy('decay', 'DESC')->paginate(5);

		return View::make('content.thread', array('posts' => $posts, 'forum_id' => $forum_id, 'forum_slug' => $forum_slug, 'thread_id' => $thread_id, 'thread_slug' => $thread_slug));
		
		//if user, check cache thread, if not cached, then cache it and calculate each post score individually.
	}

}
