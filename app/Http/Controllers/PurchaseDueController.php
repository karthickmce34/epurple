<?php namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;

use JasperPHP\JasperPHP as JasperPHP;


class PurchaseDueController extends Controller {

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
            $id = $_SESSION['id'];
            $data['username'] = 'Guest';
            $logchk = $this->chklogin($id);
            $sat = date("Y-m-d H:i:s", strtotime('Saturday'));
            if($logchk['active'] == 'Y')
            {
            $userid = $logchk['createdby'];
            $user = DB::select("select * from ad_user where ad_user_id='".$userid."'");
            $data['username'] = $user[0]->name;
            $user_role = DB::select("select * from ad_user_roles where ad_user_id='".$userid."'");
            $roleid = $user_role[0]->ad_role_id;
            $role = DB::select("select * from ad_role where ad_role_id in ('".$roleid."')");
            $data['roleid'] = $roleid;
            $data['sessionid'] = $id;
            $clientlist[] = $role[0]->clientlist;
            $data['clientlist'] = $clientlist;
            $orglist = $role[0]->orglist;
            $roleorg = DB::select("select * from ad_role_orgaccess where ad_role_id in ('".$roleid."')");
            $windowaccess = DB::select("select * from ad_window_access where ad_role_id in ('".$roleid."')");
            $window = DB::select("select * from ad_window where ad_window_id='".$userid."'");
            $client = DB::select("select * from ad_client where c_currency_id='304'"); 
            
            $data['clients'] = $client;
            $data['data3'] = "";
            $data['home'] = "Testing set";
            return view('purchasedue',$data);
           }
           else {
               $openbravoip   = Config::get('constant.OPENBRAVOIP');
               header("Location: ".$openbravoip);
           }
            
            
            
	}
        public function postOrg()
	{
            $inputs = Request::all();
            $client_id=$inputs['ad_client_id'];
            $roleid=$inputs['role_id'];
            $sessionid=$inputs['sessionid'];
            $openbravoip   = Config::get('constant.OPENBRAVOIP');
            $session = DB::select("select * from ad_session where ad_session_id='".$sessionid."'");
            
            $role = DB::select("select * from ad_role where ad_role_id in ('".$roleid."')");
            $orglist = $role[0]->orglist;
            $orglst = str_replace(",","','",$orglist);
            $org = DB::select("select ad_org_id,name from ad_org where isactive='Y' and ad_org_id in ('".$orglst."') and name not like '*' order by name ");
            $acctschema = DB::select("select c_acctschema_id,name from c_acctschema where isactive='Y' and ad_client_id='".$client_id."'");
            
            $data['status']=0;
            $data['orgs'] = $org;
            $data['acctschema'] = $acctschema;
            $data['session_active'] = 'Y'; //$session[0]->session_active;  temperory
            $data['openbravoip'] = $openbravoip;
            if(count($org)>0)
            {
                $data['status']=1;
            }
            $this->data['orgs'] = $data['orgs'];
            $this->data['acctschema'] = $data['acctschema'];
            $this->data['status'] = $data['status'];
            $this->data['session_active'] = $data['session_active'];
            $this->data['openbravoip'] = $data['openbravoip'];
            return response()->json($this->data);
	}
        
        public function postChartdata()
	{
            $inputs = Request::all();
            $client_id=$inputs['ad_client_id'];
            $ad_org_id=$inputs['ad_org_id'];
            if(date('D', strtotime('today')) == 1)
            {
                date( 'Y-m-d', strtotime( 'today -1 days'));
            }
            else
            {
                $currentdate = date('Y-m-d');
            }
            
            $comingsaturday = date( 'Y-m-d', strtotime( 'saturday' ) );
            $nxtMonday = date( 'Y-m-d', strtotime( 'next Sunday' ) );
            $nxtSaturday = date( 'Y-m-d', strtotime( 'next Monday + 5 days'));
            
            //print_r(date( 'Y-m-d', strtotime( 'today -1 days')));die;
            
            $currentdetails=$this->chrtdata($currentdate, $comingsaturday, $client_id, $ad_org_id);
            $nxtweekdetails=$this->chrtdata($nxtMonday, $nxtSaturday, $client_id, $ad_org_id);
            
            //current week
            $outstanding = array();
            $days = array();
            $outstanding[] = 'Pending Payments';
            $days[] = 'days';
            foreach($currentdetails as $currentdetail)
            {
                $outstanding[] = $currentdetail->outstandingamt;
                $days[] = $currentdetail->dueday;
            }
            
            //next week
            
            $outstanding2 = array();
            $days2 = array();
            $outstanding2[] = 'Pending Payments';
            $days2[] = 'days';
            foreach($nxtweekdetails as $nxtweekdetail)
            {
                $outstanding2[] = $nxtweekdetail->outstandingamt;
                $days2[] = $nxtweekdetail->dueday;
            }
             
            $data['status']=1;
            
            $data['session_active'] = 'Y'; //$session[0]->session_active;  temperory
            $this->data['curoutstanding'] = $outstanding;
            $this->data['days'] = $days;
            $this->data['nxtoutstanding'] = $outstanding2;
            $this->data['nxtweekdays'] = $days2;
            $this->data['status'] = $data['status'];
            $this->data['session_active'] = $data['session_active'];
            return response()->json($this->data);
	}
        
        protected function chrtdata($fromdate,$todate,$clientid,$orgid) {
            
            $currentdetails = DB::select("select ad_client.name as clientname,
                                            ad_org.name as orgname,
                                            sum(fin_payment_schedule.outstandingamt) as outstandingamt,
                                            TO_CHAR( fin_payment_schedule.duedate, 'DAY') as dueday,
                                            fin_payment_schedule.duedate  as duedate

                                            from c_invoice,fin_payment_schedule,ad_client,ad_org

                                            where 1=1
                                            and ad_client.ad_client_id = c_invoice.ad_client_id
                                            and ad_org.ad_org_id = c_invoice.ad_org_id
                                            and c_invoice.c_invoice_id = fin_payment_schedule.c_invoice_id
                                            and fin_payment_schedule.outstandingamt > 0
                                            and c_invoice.issotrx = 'N'
                                            and c_invoice.ad_client_id = '".$clientid."'
                                            and c_invoice.ad_org_id = '".$orgid."'
                                            and fin_payment_schedule.duedate >= to_date('".$fromdate."','yyyy-mm-dd')
                                            and fin_payment_schedule.duedate <= to_date('".$todate."','yyyy-mm-dd')

                                            group by ad_client.name,ad_org.name,duedate

                                            order by ad_client.name,ad_org.name,duedate");
            
            return $currentdetails;
        }
        
        public function getPurdata()
        {
            
            $inputs = Request::all();
            $status = 1;

            $UPLOAD_PATH_REPORT_URL   = 'static/report/sourcefile';
            $UPLOAD_PATH_RESULT_URL   = 'static/report/result';
            
            $ad_client_id = $inputs['ad_client_id'];
            $org_id = $inputs['org_id'];
            $fromdate = $inputs['fromdate'];
            $todate = $inputs['todate'];

            $order_id = ['1811365','1811429','1811270','1810945_5','1811305','1811157','1811266','1811283_1','1811499','1811127_1','1811281','1910001','1811500_1','1811298','1811526','1811227_1','1811102','1811420','1810995_2','1811403_1','1811230','1811322',
                        '1810917_2','1811128_1','1811342','1811341','1910133','1811172_1','1811318','1811609','1910082_1','1811312','1811264_1','1811564','1910132','1811400_1','1910309_2','1910305','1811215','1811167_1','1811654_1','1811616','1811240_1','1811192',
                        '1910089','1811350','1811345','1811330_1','1810987_1','1811300','1811241','1811121','1811340','1811224','1811310','1811655_1','1811267','1910120','1811379_1','1811414','1811653','1811504_1','1811190','1811520_1','1811397','1811680','1811247','1811093','1811411','1811287',
                        '1811638','1811091_1'];
            $orderid=implode( "','", $order_id );
            $data2 = DB::select("select c_order_id from c_order where documentno in ('".$orderid."')");
            $c_order_id = array();
            foreach($data2 as $data21)
            {
             array_push($c_order_id,$data21->c_order_id);
            } 
            $corderid = '\''.implode("','",$c_order_id).'\'';
             
            $fileexport = array();
            $cckey = array();

            $connection =     array(
                    'driver' => 'oracle',
                    'username' => env('DB_USERNAME'),
                    'host' => env('DB_HOST'),
                    'password' => env('DB_PASSWORD'),
                    'database' => env('DB_DATABASE'),
                    'port' => env('DB_PORT'),
                    'db_sid' => 'MWERP'
                  );


            $jaspername = "purchase_due_grid_railway";
                    $parameter = array(
                        'fromdate'=>$fromdate,
                        'todate'=>$todate,
                        'org_id'=>$org_id,
                        'client_id'=>$ad_client_id,
                        'c_order_id'=>$corderid,
                    );
            //$UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
           //echo "<pre>";print_r($connection);//die;

            //echo "<pre>";print_r($parameter);//die;
            ////**********download in  server starts *******************/////
            $jasper = new JasperPHP;
            $filetype = 'pdf';
            $jasper1= $jasper->process(
                public_path($UPLOAD_PATH_REPORT_URL).'/'.$jaspername.'.jasper',
                public_path($UPLOAD_PATH_RESULT_URL).'/'.$jaspername,
                array($filetype),
                $parameter,
                $connection
            )->execute();
            $data['name'] = 'purchase_due_grid';
            $data['ext'] = $filetype;
            $data['path'] = $UPLOAD_PATH_RESULT_URL;
            ////**********download in  server ends *******************/////
            //print_r($jasper1);die;
            $filepath = url($UPLOAD_PATH_RESULT_URL).'/'.$jaspername.'.'.$filetype;
            $filename = public_path($UPLOAD_PATH_RESULT_URL).'/'.$jaspername.'.'.$filetype;

            //$filename= $filename;
            $file_headers = $this->UR_exists($filepath);
            if ($file_headers == 0) 
            {
                $status=1;
            }


            $this->data['status'] = $status;
            $this->data['filepath'] = $filepath;
            $this->data['filetype'] = $filetype;
            $headers = header("Content-Type: application/pdf");
            //echo "<pre>";print_r($this->data);
            return response()->json($this->data);

        }
        public function UR_exists($url)
        {
            $headers=get_headers($url);
            return stripos($headers[0],"200 OK")? 0 :1;
         }
               
        
        
        public function chklogin($id)
        {
            $session = DB::select("select * from ad_session where ad_session_id='".$id."'");
            
            if($session[0]->session_active == 'Y')
            {
                $sessactive['active'] = $session[0]->session_active;
                $sessactive['createdby'] = $session[0]->createdby;
                return $sessactive;
            }
            else 
            {
               print_r($id);
               $openbravoip   = Config::get('constant.OPENBRAVOIP');
               header("Location: ".$openbravoip);
               exit;
               
            }
        }
        
        public function getActivedata()
        {
            $inputs = Request::all();
            $sessionid=$inputs['sessionid'];
            $openbravoip   = Config::get('constant.OPENBRAVOIP');
            $session = DB::select("select * from ad_session where ad_session_id='".$sessionid."'");
            $session[0]->session_active = 'Y'; 
            $data['session_active'] = $session[0]->session_active;
            $data['openbravoip'] = $openbravoip;
            $this->data['session_active'] = $data['session_active'];
            $this->data['openbravoip'] = $data['openbravoip'];
            return response()->json($this->data);
        }
}
