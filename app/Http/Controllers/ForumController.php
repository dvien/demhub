<?php namespace App\Http\Controllers;

/* Autogenerated Forum Controller */
/* Hook point of the Forum package inside your laravel application */
/* Feel free to override methods here to fit your requirements */
class ForumController extends \Riari\Forum\Controllers\BaseController
{
	public function postDiscussion(){
		if (Request::isMethod('post')){
			$title = Input::get('title');
			$description = Input::get('description');
			$category = Input::get('category');
			$discussion = new forum_threads;
			$discussion->author_id = Auth::user()->id;
			$discussion->parent_category = $divison;
			$discussion->title = $title;
			$discussion->hidden = false;
			$discussion->updated_at = app('currentDT');
			$discussion->created_at = app('currentDT');
			$discussion->save();

			return Redirect::route('discussion');

		}
		else {
			return Redirect::route('home');
		}
	}

	public function showDiscussion($id){
		$discussion = forum_threads::where('id', '=', $id)
									->first();
		if ($discussion){
			return View::make('discussion.view')
						->with('discussion', $discussion);
		}
		else {
			return Redirect::back();
		}
	}

	public function postReply($id){
		if (Request::isMethod('post')){
			$reply_create = new Reply;
			$reply_create->author_id = Auth::user()->id;
			$reply_create->forum_threads_id = $id;
			$reply_create->content = Input::get('reply');
			$reply_create->hidden = false;
			$reply_create->updated_at = app('currentDT');
			$reply_create->updated_at = app('currentDT');
			$reply_create->save();

			$forum_threads = forum_threads::where('id','=',$id)
										->update(array(
												'updated_at' => app('currentDT'),
												));
										
			return Redirect::back();
		}
		else {

		}	
	}

}
