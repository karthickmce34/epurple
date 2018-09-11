<?php namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

use App\Models\MovementModel;
use App\Models\AduserModel;

class GoodsmovementController extends Controller {

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

        public $modelName = 'App\Models\MovementModel';
        public $aduserModel = 'App\Models\AduserModel';
        public $adroleModel = 'App\Models\AdroleModel';
        
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
           $session = array();
           $data['username'] = 'Guest';
           $session = DB::select("select * from ad_session where ad_session_id='".$id."'");
           //print_r($session);die;
           if($session[0]->session_active == 'Y')
            {
            $userid = $session[0]->createdby;
            $model = new $this->modelName();
            $modelData = $model->where('m_movement_id','=',$id)->get()->toArray();
           
            $usermodel = new $this->aduserModel();
            $user = $usermodel->where('ad_user_id','=',$userid)->get();
            $roleid = $user[0]->default_ad_role_id;
            $clientid = $user[0]->default_ad_client_id;

            //print_r($user[0]->default_ad_role_id);die;
            $user_role = DB::select("select * from ad_user_roles where ad_user_id='".$userid."'");


            $rolemodel = new $this->adroleModel();
            $role = $rolemodel->where('ad_role_id','=',$roleid)->get();
            //$role = DB::select("select * from ad_role where ad_role_id in ('".$roleid."')");

            $clientlist = $role[0]->clientlist;
            $orglist = $role[0]->orglist;
            $roleorg = DB::select("select * from ad_role_orgaccess where ad_role_id in ('".$roleid."')");

             $orglst = str_replace(",","','",$orglist);
             $org = DB::select("select ad_org_id,name from ad_org where isactive='Y' and ad_org_id in ('".$orglst."') and name not like '*' order by name ");
            $windowaccess = DB::select("select * from ad_window_access where ad_role_id in ('".$roleid."')");
            $window = DB::select("select * from ad_window where ad_window_id='".$userid."'");
            $documentno = DB::select("select * from ad_sequence where ad_client_id='".$clientid."' and name like 'DocumentNo_M_Movement'");

            $data['username'] = $user[0]->name;
            $data['orgs'] = $org;
            $data['user'] = $user[0];
            $data['documentno'] = $documentno[0];

            //print_r($documentno);die;
           }
           else {
               header("Location: http://192.168.0.48:8080/punetest/");
           }
           return view('goodsmovement',$data);
	}
        
}
