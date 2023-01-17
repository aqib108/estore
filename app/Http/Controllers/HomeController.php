<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Admin\Tag;
use App\Models\Admin\Slider;
use App\Models\Admin\LibraryType;
use App\Models\Admin\Library;
use App\Models\Admin\Donation;
use App\Models\Admin\Magazine;
use App\Models\Admin\MagazineCategory;
use App\Models\Admin\Classes;
use App\Models\Admin\CeoMessage;
use App\Models\Admin\News;
use App\Models\Admin\Department;
use App\Models\Admin\Course;
use App\Models\Admin\Testimonial;
use App\Models\Admin\Setting;
use App\Models\Admin\OurAims;
use App\Models\Admin\DocumentUploader as DocumentModel;
use App\Models\Subscription\NewSubscription;
use App\Models\ContactForm\ContactRecord;
use Response;
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
        if (!session()->has('settings')) {
            $settingsdata = Setting::all()->toArray();
            $sortedArray = array_column($settingsdata, 'option_value', 'option_name');
            session()->put('settings', $sortedArray);
        }
        $data['sliders'] =  Slider::wherestatus(1)->get();
        $data['ceo_message'] =  CeoMessage::wherestatus(1)->value('message');
        $data['donations'] = Donation::where(['is_featured'=>1,'status'=>1,'is_featured'=>1])->first();
        $data['libraryTypes'] = LibraryType::wherestatus(1)->get();
        $data['sliderPosts'] = Post::where(['slider_post'=>1,'status'=>1])->get();
        $data['news'] = News::wherestatus(1)->get();
        $data['departments'] = Department::wherestatus(1)->get();
        $data['aims'] = OurAims::get()->first();
        $data['department_count'] = Department::count();
        $data['course_count'] = Course::count();
        $data['Testimonials'] = Testimonial::wherestatus(1)->get();
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
        return back();
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
    function subscription(Request $request){
       $subscription = new NewSubscription();
       $subscription->email = $request->email;
       $subscription->status = 1;
       $subscription->save();
       return redirect('/')->with('msg','successfully subscripted');
    }
    function Contact_us(Request $request){
       $contact = new ContactRecord();
       $contact->name = $request->name;
       $contact->subject = $request->subject;
       $contact->message = $request->message;
       $contact->save();return redirect('/')->with('msg','successfully contact created'); return redirect()->with('msg','successfully contact created'); 
    }
    public function Blog(){
        $posts = App\Models\Admin\Post::wherestatus(1)->leftjoin('post_feature_images','post_id','posts.id')->orderBy('id', 'DESC')->paginate(8,['posts.title as title','posts.short_description as short_description','post_feature_images.image as image','posts.created_at as date','posts.id as id']);
        $recent_posts = App\Models\Admin\Post::wherestatus(1)->take(5)->orderBy('id', 'DESC')->get(['title','id']);
        return view('home.pages.blog',compact('posts','recent_posts'));
    }
    public function BlogDetail($id){
        $post = App\Models\Admin\Post::where('posts.id',$id)->leftjoin('post_feature_images','post_id','posts.id')->get(['posts.title as title','posts.description as description','post_feature_images.image as image','posts.created_at as date','posts.id as id'])->first();
        $recent_posts = App\Models\Admin\Post::wherestatus(1)->take(5)->orderBy('id', 'DESC')->get(['title','id']);
        return view('home.pages.blog-detail',compact('post','recent_posts'));
    }
    public function News(){
        $news =   News::wherestatus(1)->paginate(8);
        $recent_news =   News::wherestatus(1)->latest()->take(5)->orderBy('id', 'DESC')->paginate(8);
        return view('home.pages.news',compact('news','recent_news'));
    }
    public function NewsDetail($id){
        $news =   News::where('id',$id)->first();
        $recent_news =   News::wherestatus(1)->latest()->take(5)->orderBy('id', 'DESC')->paginate(8);
        return view('home.pages.news-detail',compact('news','recent_news'));
    }
    public function LibraryDetail($id){
        $libraries =   Library::wheretype_id($id)->wherestatus(1)->paginate(8);
        $libraryType=LibraryType::where('id',$id)->first();
        return view('home.pages.library-detail',compact('libraries','libraryType'));
    }
    public function MagzineCategories(){
        $magCategories =   MagazineCategory::wherestatus(1)->paginate(8);
        // dd($magCategories);
        return view('home.pages.magzine-categories',['categories'=>$magCategories]);
    }
    function MagzineDetail($id){
        $magazines =   Magazine::wheremagazine_category_id($id)->wherestatus(1)->paginate(8);
        return view('home.pages.magzine-detail',['magazines'=>$magazines]);
    }
    public function courses(){
        $courses=Course::wherestatus(1)->orderBy('id', 'DESC')->get();
        return view('home.pages.home-courses',compact('courses'));
    }
    public function classes($id){
        $classes=Classes::where(['status'=>1,'course_id'=>$id])->orderBy('id', 'DESC')->get();
        return view('home.pages.home-classes',compact('classes'));
    }
   public function downloadFile($document_id){
    $file =  DocumentModel::where(['document_id'=>$document_id])->get()->first();
    if(isset($file)){
        if($file->status==0)
        {
            return 'Document Downloader is InActive From Admin';
        }
       if(isset($file->path))
        {
            // dd($file->path);
             $filepath = public_path().'/'.$file->path;
            if (file_exists($filepath)) {
                return Response::download($filepath);
            }
            else
            return 'File Not Exist on Server';
             
        }
        else{
         return '404 file Not Exist of Server';
        }
    }
    else{
        return '403 download link is expired';
    }
    
   }
}
