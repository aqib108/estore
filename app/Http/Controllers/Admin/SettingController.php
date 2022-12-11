<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Admin\Setting;

class SettingController extends Controller
{
    public function index()
    {
        if (!have_right('site-settings')) {
            access_denied();
        }

        $result = DB::table('settings')->get()->toArray();
        $row = [];
        foreach ($result as $value) {
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
        if ($validator->fails()) {
            return redirect('admin/site-setting')->with('error', $validator->messages());
        }
        if (session()->has('settings')) {
            session()->forget('settings');
        }
        $input = $request->all();
        unset($input['_token']);
        // $input['logo'] = 'adsfds0';
        // dd($input);
        if (isset($input['logo'])) {
            $imagePath = $this->uploadimage($request);
            $input['logo'] = $imagePath;
        }
        foreach ($input as $key => $value) {
            $result = DB::table('settings')->where('option_name', $key)->get();

            if ($result->isEmpty()) {
                DB::table('settings')->insert(['option_name' => $key, 'option_value' => $value]);
            } else {
                DB::table('settings')->where('option_name', $key)->update(['option_value' => $value]);
                $settingsdata = Setting::all()->toArray();
                $sortedArray = array_column($settingsdata, 'option_value', 'option_name');
                session()->put('settings', $sortedArray);

            }
        }
        Session::flash('flash_success', 'Site Settings has been updated successfully.');
        return redirect()->back();
    }

    /**
     * upload the image .
     *
     */
    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->logo) {
            $imageName = 'logo' . time() . '.' . $request->logo->extension();
            if ($request->logo->move(public_path('images/logo'), $imageName)) {
                $path = 'images/logo/' . $imageName;
            }
        }
        return $path;
    }

}
