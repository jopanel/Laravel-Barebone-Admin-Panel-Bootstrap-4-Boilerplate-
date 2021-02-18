<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Admin_model extends Model
{
    public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        protected function generateSalt() {
                $salt = "xiORG17N6ayoEn6X3";
                return $salt;
        }

        protected function generateVerificationKey() {
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
        }

        public function getUserIP() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
       }

        public function updateGroups($postData=null, $action=null) {
                if ($action == "add") {
                    $error = 0;
                    if (!isset($postData["name"]) || empty($postData["name"])) { $error = 2;} else { $name = strip_tags($postData["name"]);}
                    if ($error == 2) { return $error; }
                    $sql = "SELECT * FROM admin_groups WHERE name = ?";
                    $query = DB::select($sql, [$name]);
                    if (count($query) > 0) {
                        return 3;
                    } else {
                        $sql2 = "INSERT INTO admin_groups (name) VALUES (?)";
                        DB::insert($sql2, [$name]);
                        return TRUE;
                    }
                }
                if ($action == "edit") {
                    $error = 0;
                    if (!isset($postData["name"]) || empty($postData["name"])) { $error = 2;} else { $name = strip_tags($postData["name"]);}
                    if (!isset($postData["id"]) || empty($postData["id"])) { $error = 3;} else { $id = strip_tags($postData["id"]);}
                    if ($error == 2) { return $error; }
                    $sql = "SELECT * FROM admin_groups WHERE name = ?";
                    $query = DB::select($sql, [$name]);
                    if (count($query) > 0) {
                        return 4;
                    } else {
                        $sql2 = "UPDATE admin_groups SET name = ? WHERE id = ?";
                        DB::update($sql2, [$name, $id]);
                        return TRUE;
                    }
                }
                if ($action == "delete") {
                    $admin_group = strip_tags((int)$postData["id"]);
                    $sql = "SELECT * FROM admin WHERE admin_group = ?";
                    $query = DB::select($sql, [$admin_group]);
                    if (count($query) > 0) {
                        return FALSE;
                    } else {
                        $sql2 = "DELETE FROM admin_groups WHERE id = ?";
                        DB::delete($sql2, [$admin_group]);
                        return TRUE;
                    }
                }
        }
        
        public function getAdminGroups($additional="") {
            if ($additional !== "") { 
                $sql ="SELECT * FROM admin_groups WHERE id = ?"; 
                $query = DB::select($sql,[$additional]);
            } else {
                $sql = "SELECT * FROM admin_groups ";
                $query = DB::select($sql);
            } 
            if (count($query) > 0) {
                return json_decode(json_encode($query), true);
            } else {
                return array();
            }
        }

        public function getAdminInfo($adminid=null) {
            $sql = "SELECT * FROM admin WHERE id = ?";
            $query = DB::select($sql, [$adminid]);
            if (count($query) > 0) {
                return $query[0];
            } else {
                return array();
            }
        }

        public function getAdmins() {
                $sql = "SELECT a.id, a.username, ag.name as 'role', a.name as 'fullname' FROM admin a 
                LEFT JOIN admin_groups ag ON a.admin_group = ag.id";
                $query = DB::select($sql);
                if (count($query) > 0) {
                        return json_decode(json_encode($query), true);
                } else {
                        return array();
                }
        }

        public function updateAdmins($postData=null, $action=null) {
                if ($action == "add") {
                        $error = 0;
                        if (!isset($postData["username"]) || empty($postData["username"])) { $error = 2;} else { $username = strip_tags($postData["username"]);}
                        if (!isset($postData["password"]) || empty($postData["password"])) { $error = 3;} else { $password = strip_tags($postData["password"]);}
                        if (!isset($postData["password2"]) || empty($postData["password2"])) { $error = 4;} else { $password2 = strip_tags($postData["password2"]);}
                        if (!isset($postData["email"]) || empty($postData["email"])) { $error = 5;} else { $email = strip_tags($postData["email"]);}
                        if (!isset($postData["name"]) || empty($postData["name"])) { $error = 6;} else { $name = strip_tags($postData["name"]);}
                        if (!isset($postData["admin_group"]) || empty($postData["admin_group"])) { $error = 7;} else { $admin_group = strip_tags($postData["admin_group"]);} 
                        if (!isset($postData["address"]) || empty($postData["address"])) { $address = "''";} else { $address = strip_tags($postData["address"]);} 
                        if (!isset($postData["address2"]) || empty($postData["address2"])) { $address2 = "''";} else { $address2 = strip_tags($postData["address2"]);} 
                        if (!isset($postData["city"]) || empty($postData["city"])) { $city = "''";} else { $city = strip_tags($postData["city"]);} 
                        if (!isset($postData["state"]) || empty($postData["state"])) { $state = "''";} else { $state = strip_tags($postData["state"]);} 
                        if (!isset($postData["zip"]) || empty($postData["zip"])) { $zip = "''";} else { $zip = strip_tags($postData["zip"]);}   
                        $verification_key = $this->generateVerificationKey();
                        $salt = $this->generateSalt();
                        if ($password !== $password2) { $error = 8; } else { $password = md5($salt.$password); }
                        if ($error > 0) { return $error; }
                        $now = time();
                        $sql = "SELECT * FROM admin WHERE username = ?";
                        $query = DB::select($sql, [$username]);
                        if (count($query) > 0) {
                                return 9;
                        } else {
                                $sql2 = "INSERT INTO admin (username,password,email,created_date,verification_key,admin_group,name,address,address2,city,state,zip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                                DB::insert($sql2, [$username, $password, $email, $now, $verification_key, $admin_group, $name, $address, $address2, $city, $state, $zip]);
                                return TRUE;   
                        }
                        
                }
                if ($action == "edit") {
                        $error = 0; 
                        if (!isset($postData["username"]) || empty($postData["username"])) { $username = ""; } else { $username = strip_tags($postData["username"]);}
                        if (!isset($postData["password"]) || empty($postData["password"])) { $pass = 0; } else { $pass = 1; $password = strip_tags($postData["password"]);}
                        if (!isset($postData["password2"]) || empty($postData["password2"])) { $password2 = "";} else { $password2 = strip_tags($postData["password2"]);}
                        if (!isset($postData["email"]) || empty($postData["email"])) { $error = 5;} else { $email = strip_tags($postData["email"]);}
                        if (!isset($postData["name"]) || empty($postData["name"])) { $error = 6;} else { $name = strip_tags($postData["name"]);}
                        if (!isset($postData["admin_group"]) || empty($postData["admin_group"])) { $error = 7;} else { $admin_group = strip_tags($postData["admin_group"]);} 
                        if (!isset($postData["address"]) || empty($postData["address"])) { $address = "''";} else { $address = strip_tags($postData["address"]);} 
                        if (!isset($postData["address2"]) || empty($postData["address2"])) { $address2 = "''";} else { $address2 = strip_tags($postData["address2"]);} 
                        if (!isset($postData["city"]) || empty($postData["city"])) { $city = "''";} else { $city = strip_tags($postData["city"]);} 
                        if (!isset($postData["state"]) || empty($postData["state"])) { $state = "''";} else { $state = strip_tags($postData["state"]);} 
                        if (!isset($postData["zip"]) || empty($postData["zip"])) { $zip = "''";} else { $zip = strip_tags($postData["zip"]);}   
                        if ($error > 0) { return $error; }
                        $sql = "SELECT * FROM admin WHERE username = ?"; 
                        $query = DB::select($sql, [$username]);
                        if (count($query) > 0) {
                                if ($pass == 0) {
                                    $sql = "UPDATE admin SET email = ?, name = ?, admin_group = ?, address = ?, address2 = ?, city = ?, state = ?, zip = ? WHERE id = ?";
                                    DB::update($sql, [$email, $name, $admin_group, $address, $address2, $city, $state, $zip, $query[0]->id]);
                                    return TRUE;
                                } else {
                                    if ($password !== $password2) { return 8; }
                                    $salt = $this->generateSalt();
                                    $password = md5($salt.$password);
                                    $sql = "UPDATE admin SET email = ?, name = ?, admin_group = ?, address = ?, address2 = ?, city = ?, state = ?, zip = ?, password = ? WHERE id = ?";
                                    DB::update($sql, [$email, $name, $admin_group, $address, $address2, $city, $state, $zip, $password, $query[0]->id]);
                                    return TRUE;
                                }   
                        } else {
                                return 9;
                        }
                }
                if ($action == "delete") {
                        $admin_id = strip_tags((int)$postData["id"]);
                        if ((int)$postData["id"] == session("admin_id")) { 
                                return FALSE;
                        } else {
                           $sql = "DELETE FROM admin WHERE id = ?";
                           DB::delete($sql, [$admin_id]);
                           return TRUE;     
                        }
                        
                }
        }

        public function adminLogin($postData) {
            if (!isset($postData["username"])) { return 2; }
            if (!isset($postData["password"])) { return 2; }
            $salt = $this->generateSalt();
            $username = strip_tags($postData["username"]);
            $password = strip_tags(md5($salt.$postData["password"]));
            $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
            $query = DB::select($sql, [$username, $password]);
            if (count($query) > 0) {
                $q = $query[0];
                session(["username"=>$q->username]);
                session(["verification_key"=>$q->verification_key]);
                session(["admin_id"=> $q->id]);
                session(["loggedin"=>1]);
                $ip = $this->getUserIP();
                $sql2 = "UPDATE admin SET last_signin = ?, ip = ? WHERE id = ?";
                DB::update($sql2, [time(), $ip, $q->id]);
                return TRUE;
            } else {
                return 2;
            }
        }

        public function verifyUser() {
            if (session("username") && session("verification_key") && session("admin_id") && session("loggedin")) {
                $sql = "SELECT * FROM admin WHERE id = ? AND verification_key = ? AND username = ?";
                $query = DB::select($sql, [strip_tags((int)session("admin_id")), strip_tags(session("verification_key")), strip_tags(session("username"))]);
                if (count($query) > 0) {
                    return TRUE;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function logout() {
            session()->flush();
            return TRUE;
        }
}
