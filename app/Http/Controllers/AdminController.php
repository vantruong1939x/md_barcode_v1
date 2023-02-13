<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        return view('admincp.dashboard');
    }
    // public function dashboard(){
    //     echo "123456";
    // }
    public function dashboard(Request $request)
        {
            $admin_email = $request->admin_email;
            $admin_password = md5($request->admin_passwd);
            $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
            // echo'<pre>';
            // print_r($result);
            // echo "</pre>";
            if ($result) {
                // code...
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return view('admincp.dashboard');
            }
            else{
                Session::put('message','User hoặc pass không chính xác , vui lòng nhập lại');
                return Redirect::to('adminlogin');
            }
          
         
            // The blog post is valid...
        }
        public function logout(){
           Session::put('admin_name',null);
           Session::put('admin_id',null);
           return Redirect::to('adminlogin');
        }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
   
}