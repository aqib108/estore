<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Admin\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance work.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliderPosts = Post::where(['slider_post'=>1,'status'=>1])->get();
        return view('home.index')->with(['slider_posts'=>$sliderPosts]);
    }

    public function page($slug)
    {
        $page = Page::where('url',$slug)->first();
        return view('home.cms-page',compact('page'));
    }

    public function post($slug)
    {   
        $post = Post::where('url',$slug)->first();
        return view('home.post',compact('post'));
    }
    public function category($slug)
    {   
        $category = Category::where('url',$slug)->first();
        return view('home.category.posts',compact('category'));
    }
    public function tag($slug)
    {   
        $slug = str_replace('-',' ',$slug);
        $tag = Tag::where('name',$slug)->first();
        return view('home.tag.posts',compact('tag'));
    }
    public function search()
    {   
        $posts = [];
        if( isset( $_GET['query']) && !empty($_GET['query']) )
        {
            $query = $_GET['query'];
            $posts = Post::where('title','LIKE','%'.$query.'%')
                            ->orWhere('short_description','LIKE',"%".$query."%")
                            ->orWhere('description','LIKE',"%".$query."%")
                            ->where('status',1)
                            ->get();
        }
        //redirect to anther page sds
        return view('home.search.posts',compact('posts'));
    }
    
    public function assigment(Request $request)
    {
    	echo  '<div id="video-player">';
        echo  '<video width="100%" controls>'; 
        echo  '<source src="'.asset('demo.mp4').'" type="video/mp4">'; 
        echo  'Your browser does not support the video tag.'; 
        echo  '</video>'; 
        echo  '</div>';
    }
}
