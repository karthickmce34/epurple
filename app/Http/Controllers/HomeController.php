<?php namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
           session_start();
           if(isset($_GET['session_id']))
           {
               $id = $_GET['session_id'];
               $_SESSION['id'] = $id;
           }
           else 
           {
               $id = $_SESSION['id'];
           }
           
           $data['username'] = 'Guest';
           $session = DB::select("select * from ad_session where ad_session_id='".$id."'");
           //print_r($session);
           if($session[0]->session_active == 'Y')
           {
           $userid = $session[0]->createdby;
           $user = DB::select("select * from ad_user where ad_user_id='".$userid."'");
           $data['username'] = $user[0]->name;
           $user_role = DB::select("select * from ad_user_roles where ad_user_id='".$userid."'");
           $roleid = $user_role[0]->ad_role_id;
           $role = DB::select("select * from ad_role where ad_role_id in ('".$roleid."')");
           
           $clientlist = $role[0]->clientlist;
           $orglist = $role[0]->orglist;
           $roleorg = DB::select("select * from ad_role_orgaccess where ad_role_id in ('".$roleid."')");
           $windowaccess = DB::select("select * from ad_window_access where ad_role_id in ('".$roleid."')");
           $window = DB::select("select * from ad_window where ad_window_id='".$userid."'");
           
           print_r($orglist);
           }
           else {
               header("Location: http://192.168.0.48:8080/punetest/");
           }
           return view('home',$data);
	}
        
}
