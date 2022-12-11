<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
    	$sliderPosts = Post::where(['slider_post'=>1,'status'=>1])->get();
        return view('home.index')->with(['slider_posts'=>$sliderPosts]);
    }
}