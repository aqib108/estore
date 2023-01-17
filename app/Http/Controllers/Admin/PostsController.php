<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Post;
use App\Models\Admin\Tag;
use App\Models\Admin\Category;
use App\Models\Admin\Language;
use App\Models\Admin\PostTag;
use App\Models\Admin\PostCategory;
use App\Models\Admin\PostFeatureImage;
use App\Models\Admin\PostThemeImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class PostsController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if(!have_right('Access-Posts'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        if($request->ajax())
        {
            $db_record = Post::orderBy('created_at','DESC')->get();

            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('status', function($row)
            {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1)
                {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->editColumn('title', function($row)
            {
                $title = (array)json_decode($row->title);
                return $title['en'];

            });
            $datatable = $datatable->addColumn('action', function($row) use($hashids)
            {
                $actions = '<span class="actions">';

                if(have_right('Access-Posts'))
                {
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/posts/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('Access-Posts'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/posts/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="'.csrf_token().'">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status','action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        return view('admin.posts.listing',$data);
    }

    public function create()
    {
        if(!have_right('Access-Posts'))
            access_denied();

        $data = [];
        $data['row'] = new Post();
        $category = new Category();
        $data['categories'] = $category->rootCategories();
        $data['tags'] = Tag::where('status',1)->get();
        $data['languages'] = Language::all();
        $data['action'] = 'add';
        return View('admin.posts.form',$data);
    }

    public function edit($id)
    {
        if(!have_right('Access-Posts'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Post::find($id);
        $category = new Category();
        $data['categories'] = $category->rootCategories();
        $data['tags'] = Tag::where('status',1)->get();
        $data['languages'] = Language::all();
        $data['action'] = 'edit';
        return View('admin.posts.form',$data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if($input['action'] == 'add')
        {
            if(!have_right('Access-Posts'))
                access_denied();

            $model = new Post();
            $model->title=json_encode($request->title);
            $model->short_description=json_encode($request->short_description);
            $model->description=json_encode($request->description);
            $model->url=$request->url;
            $model->meta_title=$request->meta_title;
            $model->meta_description=$request->meta_description;
            $model->meta_keywords=$request->meta_keywords;
            $model->slider_post=$request->slider_post;
            $model->feature=$request->feature;
            $model->status=$request->status;
            $model->admin_id = auth()->user()->id;
            $model->save();
            $id = $model->id;
            $msg = 'Data added Successfully';
        }
        else
        {
            if(!have_right('Access-Posts'))
                access_denied();

            $id = $input['id'];
            $hashids = new Hashids('',10);
            $id = $hashids->decode($id)[0];
            $model = Post::find($id);
            $model->title=json_encode($request->title);
            $model->short_description=json_encode($request->short_description);
            $model->description=json_encode($request->description);
            $model->url=$request->url;
            $model->meta_title=$request->meta_title;
            $model->meta_description=$request->meta_description;
            $model->meta_keywords=$request->meta_keywords;
            $model->slider_post=$request->slider_post;
            $model->feature=$request->feature;
            $model->status=$request->status;
            $model->admin_id = auth()->user()->id;
            $model->update();
            PostTag::where('post_id',$id)->delete();
            PostCategory::where('post_id',$id)->delete();
            $msg = 'Data updated Successfully';
        }

        if(isset($input['tags']))
        {
            foreach($input['tags'] as $tagId)
            {
                PostTag::create(['post_id' => $id,'tag_id'  => $tagId]);
            }
        }
        if(isset($input['categories']))
        {
            foreach($input['categories'] as $catId)
            {
                PostCategory::create(['post_id' => $id,'category_id'  => $catId]);
            }
        }
        
        if($request->hasFile('feature_image'))
        {
            $imageName = 'feature-'.time().'.'.$request->feature_image->extension();  
            if($request->feature_image->move(public_path('feature-images/'), $imageName))
            {
                if(!empty($model->featureImage))
                {
                    PostFeatureImage::where('post_id',$id)->update(['post_id' => $id,'image'  => $imageName]);
                }
                else
                {
                    PostFeatureImage::create(['post_id' => $id,'image'  => $imageName]);
                }
            }   
        }   

        if($request->hasFile('theme_image'))
        {
            $timageName = 'theme-'.time().'.'.$request->theme_image->extension();  
            if($request->theme_image->move(public_path('theme-images/'), $timageName))
            {
                if(!empty($model->themeImage))
                {
                    PostThemeImage::where('post_id',$id)->update(['post_id' => $id,'image'  => $timageName]);
                }
                else
                {
                    PostThemeImage::create(['post_id' => $id,'image'  => $timageName]);
                }
            }   
        }

        return redirect('admin/posts')->with('message',$msg);
    }

    public function destroy($id)
    {
        if(!have_right('Access-Posts'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Post::destroy($id);
        return redirect('admin/posts')->with('message','Data deleted Successfully');
    }

    public function uploadimage(Request $request)
    {
        $imageName = 'post'.time().'.'.$request->image->extension();  
        if($request->image->move(public_path('posts-images'), $imageName))
        {
            echo asset('posts-images/'.$imageName);exit();
        }
    }   
}