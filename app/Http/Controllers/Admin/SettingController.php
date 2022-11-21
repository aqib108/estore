<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Session;
use DB;
use File;
use Storage;

class SettingController extends Controller
{
    public function index()
    {
        if(!have_right('site-settings'))
            access_denied();
        
        $result = DB::table('settings')->get()->toArray();
        $row = [];
        foreach ($result as $value) 
        {
            $row[$value->option_name] = $value->option_value;
        }
        $data['settings'] = $row;
        return view('admin.settings')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'email' => 'required|string|max:200',
            'phone' => 'required|string|max:200',
        ]);

        if ($validator->fails())
        {
            return redirect('admin/site-setting')->with('error',$validator->messages());
        }

        $input = $request->all();
        unset($input['_token']);

        foreach ($input as $key => $value)
        {
            $result = DB::table('settings')->where('option_name',$key)->get();

            if($result->isEmpty())
            {
                DB::table('settings')->insert(['option_name'=>$key,'option_value' => $value]);
            }
            else
            {
                DB::table('settings')->where('option_name',$key)->update(['option_value' => $value]);
            }
        }
        Session::flash('flash_success', 'Site Settings has been updated successfully.');
        return redirect()->back();
    }
}
