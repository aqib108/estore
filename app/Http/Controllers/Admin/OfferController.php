<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Offer;
use App\Models\Admin\Category;
use App\Models\Admin\ProductImage;
use App\Models\Admin\OfferImage;
use App\Models\Admin\Vendor;
use App\Models\Posts\Post\Post;
use App\Models\Posts\PostFile\PostFile;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        if (!have_right('View-Offers'))
            access_denied();

        $data = [];
        if ($request->ajax()) {
            $db_record = Offer::all();

            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();

            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('featured', function ($row) {
                if ($row->is_feature == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                if (have_right('Featured-Products')) {

                    $featured = '<label class="switch"> <input type="checkbox" class="is_featured" id="chk_' . $row->id . '" name="is_featured" onclick="is_featured($(this),' . $row->id . ')" ' . $checked . ' > <span class="slider round"></span></label>';
                    return $featured;
                } else {
                    return '<span class=" badge badge-danger">No Permission</span>';
                }
            });

            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Edit-Products')) {
                    $actions .= '&nbsp;<a class="btn btn-primary" href="' . url("admin/offers/" . $row->id) . '/edit' . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Products')) {
                    $actions .= '<form method="POST" action="' . url("admin/offers/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status', 'action', 'featured']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        return view('admin.offers.listing', $data);
    }

    public function create()
    {
        if (!have_right('Delete-Products'))
            access_denied();

        $data = [];
        $data['row'] = new Offer();
        $data['action'] = 'add';
        return View('admin.offers.form', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'price' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if (isset($input['image'])) {
            $imagePathsarray = $this->uploadimageMultiple($request);
        }
        unset($input['image']);
    
        if ($input['action'] == 'add') {
            unset($input['action']);
            $model = new Offer();
            $input['sku'] = generateOfferSku();
            $model->fill($input);
            $model->save();
            if (isset($imagePathsarray)) {
                foreach ($imagePathsarray as $key => $val) {
                    $model_image = new OfferImage();
                    $model_image->file_name = $val['image_url'];
                    $model_image->file_type = $val['image_extention'];
                    $model->offerImages()->save($model_image);
                }
            }
            return redirect('admin/offers')->with('message', 'Data added Successfully');
        } else {

            // dd($request);
            if (!have_right('Edit-Products'))
                access_denied();
            if (isset($request->old_image_id)) {

                $del_rows = $request->old_image_id;
                $delete_image_row = DB::table('offer_images')->whereNotIn('id', $del_rows)->where('offer_id', $request->id)->get();
                foreach ($delete_image_row as $keyy => $vall) {
                    $image_name = $vall->file_name;
                    $this->deleteEditoImage($image_name);
                }
                DB::table('offer_images')->whereNotIn('id', $del_rows)->where('offer_id', $request->id)->delete();
            } else {

                $delete_image_row = DB::table('offer_images')->where('offer_id', $request->id)->get();
                foreach ($delete_image_row as $keyy => $vall) {
                    $image_name = $vall->file_name;
                    $this->deleteEditoImage($image_name);
                }
                // DB::enableQueryLog();
                DB::table('offer_images')->where('offer_id', $request->id)->delete();
                // dd(DB::getQueryLog());
            }


            unset($input['action']);
            if (isset($input['image'])) {
                $imagePathsarray = $this->uploadimageMultiple($request);
            } else {
                unset($input['image']);
            }

            unset($input['old_image_id']);
            $id = $input['id'];
            $model = Offer::find($id);
            $model->fill($input);
            $model->update();
            if (!empty($imagePathsarray)) {
                foreach ($imagePathsarray as $key => $val) {
                    $model_image = new OfferImage();
                    $model_image->file_name = $val['image_url'];
                    $model_image->file_type = $val['image_extention'];
                    $model->offerImages()->save($model_image);
                }
            }
            return redirect('admin/offers')->with('message', 'Data updated Successfully');
        }
    }

    public function edit($id)
    {
        if (!have_right('Edit-Products'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $data['row'] = Offer::find($id);
        $data['offer_images'] = $data['row']->offerImages;
        $data['categories'] = Category::where('status', 1)->get();
        $data['action'] = 'edit';
        return View('admin.offers.form', $data);
    }

    public function destroy($id)
    {
        if (!have_right('Delete-Products'))
            access_denied();

        $data = [];
        $data['row'] = Offer::destroy($id);
        return redirect('admin/offers')->with('message', 'Data deleted Successfully');
    }


    function uploadimageMultiple(Request $request)
    {
        $path = 'images/offer-images';
        $image_path_array = [];
        $counter = 0;
        foreach ($request->image as $key => $value) {
            $imageName = 'offer' . time() . uniqid() . '.' . $value->extension();
            $imageExtention = $value->extension();
            $value->move(public_path($path), $imageName);
            $image_path_array[$counter]['image_url'] =  $path . "/" . $imageName;
            $image_path_array[$counter]['image_extention'] = $imageExtention;
            $counter++;
        }
        return $image_path_array;
    }

    public function getProductDetails(Request $request)
    {
        $product = Product::with('productImages')->find($request->postID)->toArray();
        $response = [];


        $response['name']['english'] = $product['name_english'];
        $response['name']['urdu'] = $product['name_urdu'];
        $response['name']['arabic'] = $product['name_arabic'];
        $response['description']['english'] = $product['description_english'];
        $response['description']['urdu'] = $product['description_urdu'];
        $response['description']['arabic'] = $product['description_arabic'];
        $response['price'] = $product['price'];
        $response['id'] = $product['id'];
        $images = [];
        foreach ($product['product_images'] as $image) {
            $images[] = $image['file_name'];
        }
        $response['images'] = $images;



        $data = [];
        $data['names'] = $response['name'];
        $data['descriptions'] = $response['description'];
        $data['images'] = $response['images'];
        $data['price'] = $response['price'];
        $data['id'] = $response['id'];

        $html = View('admin.products.post-details-partial', $data);
        echo $html;
        exit();
    }

    public function deleteEditoImage($image)
    {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }

    public function setFeaturedOffer(Request $request , $id = null)
    {
        if (!have_right('Featured-Products'))
            access_denied();
        $update_offer = Offer::where('id', $id)->update(['is_feature' => $request->get('status')]);

        if ($update_offer) {

            echo true;
            exit();
        }
    }

    public function productPost(Request $request)
    {
        if (!have_right('Create-Post-Products'))
            access_denied();
        $data = $request->except('images');
        $data['post_type'] = 4;
        $data['product_id'] = $data['product_id'];
        $post = Post::create(Arr::add($data, 'admin_id', auth()->user()->id));
        foreach ($request->images as $image) {
            $image2 = Str::replace('/', '', $image);
            File::copy(public_path($image), public_path('post-images/' . $image2));
            PostFile::create(['file' => 'post-images/' . $image2, 'post_id' => $post->id]);
        }
        return redirect()->back()->with('message', 'Post Created Successfully');
    }
}
