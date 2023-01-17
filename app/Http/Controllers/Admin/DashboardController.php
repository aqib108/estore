<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Admin\Course;
use App\Models\Admin\Department;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        if(!have_right('Access-Dashboard'))
            access_denied();
        $users = User::count();
        $posts = Post::count();
        $departments = Department::count();
        $courses = Course::count();
        $data = [
            'departments'=>$departments,
            'posts'=>$posts,
            'users'=>$users,
            'courses'=>$courses
        ];
        return view('admin.dashboard')->with($data);
    }
}
