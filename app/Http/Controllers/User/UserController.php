<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Followpage;
use App\Models\Page;
use App\Models\Pagepost;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $follow = Follow::where('person_id', Auth::id())->first();

        if ($follow == null) {
            $posts = Post::where('user_id', Auth::id())->paginate(1);
        } else {
            $posts = Post::where('user_id', Auth::id())
                ->orWhere('user_id', $follow->following_id)
                ->paginate(1);
        }

        $followpage = Followpage::where('person_id', Auth::id())->first();
        if ($followpage == null) {
            $pageposts = Pagepost::where('user_id', Auth::id())->paginate(1);
        } else {
            $pageposts = Pagepost::where('user_id', Auth::id())
                ->orWhere('page_id', $followpage->following_id)
                ->get();
        }
        return view('user.home', compact('posts', 'pageposts'));
    }

    public function createPage()
    {
        return view('user.page.create');
    }

    public function storePage(Request $request)
    {
        Page::insert([
            'page_name' => $request->page_name,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Page Created Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function attachPost()
    {
        return view('user.post.create');
    }

    public function storePost(Request $request)
    {
        Post::insert([
            'post_content' => $request->post_content,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Post Created Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    //page post
    public function pagePost($pageId)
    {
        return view('user.page.createPost', compact('pageId'));
    }

    public function pagePostStore(Request $request)
    {
        Pagepost::insert([
            'post_content' => $request->post_content,
            'page_id' => $request->page_id,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Post Created Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public  function followPerson(Request $request)
    {
        Follow::insert([
            'person_id' => Auth::id(),
            'following_id' => $request->following_id,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Followed Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public  function followPage(Request $request)
    {
        Followpage::insert([
            'person_id' => Auth::id(),
            'following_id' => $request->following_id,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Followed Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}