<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Admin_model;

class Start extends Controller
{
    protected $Admin_model;
    public function __construct()
    {
        $this->Admin_model = new Admin_model();
    }

    public function login(Request $request)
    {   
        if ($this->Admin_model->verifyUser()) {
            return $this->loggedIn();
        } 
        /*
        Error List:
        0 - No Error
        1 - Too Many Login Attempts
        2 - Bad Credentials
        */
        $data["error"] = 0;
        if ($request->post()){ 
            if (session("loginattempts")) {
                echo "2";
                $postData = $request->post();
                $loginattempts = session("loginattempts");
                if ($loginattempts > 4) { 
                    $data["error"] = 1;
                    return view('login', $data);
                 } else {
                    $auth = $this->Admin_model->adminLogin($postData);
                    if ($auth == true) {
                        return redirect(url('/'));
                    } else {
                        $data["error"] = 2;
                        return view('login', $data);
                    }
                 } 
            } else { 
                session(["loginattempts"=> 0]);
                $postData = $request->post();
                $auth = $this->Admin_model->adminLogin($postData);
                if ($auth == true) {
                    return redirect(url('/') . '/main/');
                } else {
                    $data["error"] = 2;
                    return view('login', $data);
                }
            } 
        } else {
            return view('login', $data);
        }
    }

    public function loggedIn() {
        return view('header') . view('welcome_message') . view('footer');
    }

    public function logout()
    { 
        $this->Admin_model->logout();
        return redirect(url('/'));
        
    }
}