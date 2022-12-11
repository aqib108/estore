<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Admin\Tag;
use App\Models\Admin\LibraryType;
use App\Models\Admin\Library;
use App\Models\Admin\Slider;
use App\Models\Admin\Donation;
use App\Models\Admin\CeoMessage;
use App\Models\Admin\News;
use App\Models\Admin\Department;
use App\Models\Admin\Testimonial;
use App\Models\Admin\Setting;


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
        // dd(App::getLocale());
        $data['sliders'] =  Slider::wherestatus(1)->get();
        $data['ceo_message'] =  CeoMessage::wherestatus(1)->value('message');
        $data['donations'] = Donation::where(['is_featured'=>1,'status'=>1,'is_featured'=>1])->first();
        $data['libraryTypes'] = LibraryType::wherestatus(1)->get();
        $data['sliderPosts'] = Post::where(['slider_post'=>1,'status'=>1])->get();
        $data['news'] = News::wherestatus(1)->get();
        $data['departments'] = Department::wherestatus(1)->get();
        $data['Testimonials'] = Testimonial::wherestatus(1)->get();
        if (!session()->has('settings')) {
            $data['setting'] = Setting::all()->toArray();
            $data['setting'] = array_column($data['setting'],'option_value','option_name');
            session()->put('settings', $data['setting']);
            $data['setting'] = session()->get('settings');
        }else{
            $data['setting'] = session()->get('settings');
        }
        return view('home.index')->with($data);
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
        //redirect to anther page
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
    function setLocal(Request $request){
        $request->session()->put('locale',$request->set_language);
        return redirect('/');
    }

    public function librarySections()
    {
        $data = [];

        if (!isset($_GET['all'])) {
            $data['results'] = Library::where('type_id', $_GET['type'])->limit(8)->get();
        } else {
            $data['results'] = Library::where('type_id', $_GET['type'])->get();
        }
        $data['type'] = $_GET['type'];
        $data['libratype'] =  LibraryType::where('id', $data['type'])->first();
        $html = (string) View('home.partial.library-tabs-partial', $data);
        $response = [];
        $response['html'] = $html;
        echo json_encode($response);
        exit();
    }
}
