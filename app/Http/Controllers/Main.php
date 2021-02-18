<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_model;

class Main extends Controller
{
	protected $Admin_model;
    public function __construct()
    {
        $this->Admin_model = new Admin_model();
    }

    public function index()
	{ 
		if ($this->Admin_model->verifyUser()) {
			return view('header') . view('welcome_message') . view('footer');
		} 
		
	}

    public function admins(Request $request, $page=null, $adminid=0) {
		if ($this->Admin_model->verifyUser()) {
			if ($request->post()){
				$postData = $request->post();
				$this->Admin_model->updateAdmins($postData, $postData["action"]);
			}
			if ($page == "add") {
				$data["admin_groups"] = $this->Admin_model->getAdminGroups();
				return view('header') . view('settings.admins_add', $data) . view('footer');
			} elseif ($page == "edit") {
				if ($adminid == null) { redirect(base_url(), 'auto'); }
				$data["admin_groups"] = $this->Admin_model->getAdminGroups();
				$data["result"] = $this->Admin_model->getAdminInfo($adminid);
				return view('header') . view('settings.admins_edit', $data) . view('footer');
			} else {
				$data["admins"] = $this->Admin_model->getAdmins();
				return view('header') . view('settings.admins', $data) . view('footer');
			} 	
		}
	}

	public function groups(Request $request, $page=null, $groupid=0) {
		if ($this->Admin_model->verifyUser()) {
			if ($request->post()){
				$postData = $request->post();
				$this->Admin_model->updateGroups($postData, $postData["action"]);
			}
			if ($page == "add") {
				return view('header') . view('settings.admingroups_add') . view('footer');
			} elseif ($page == "edit") {
				$data["result"] = $this->Admin_model->getAdminGroups($groupid);
				return view('header') . view('settings.admingroups_edit', $data) . view('footer');
			} else {
				$data["groups"] = $this->Admin_model->getAdminGroups();
				return view('header') . view('settings.groups', $data) . view('footer');
			} 
		}
	}
}