<?php namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;

use JasperPHP\JasperPHP as JasperPHP;


class PaymentDueChartController extends Controller {

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
            //print_r($sat);die;
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
            return view('paymentduechart',$data);
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
            $ad_org_id= 1;//$inputs['ad_org_id'];
            if(date('w', strtotime('today')) == 1)
            {
                $currentdate =date( 'Y-m-d', strtotime( 'today -1 days'));
            }
            else
            {
                $currentdate = date('Y-m-d');
            }
            
            $comingsaturday = date( 'Y-m-d', strtotime( 'saturday' ) );
            $w1Sunday = date( 'Y-m-d', strtotime( 'next Sunday' ) );
            $w1Saturday = date( 'Y-m-d', strtotime( 'next Monday + 5 days'));
            $w2Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 7 days' ) );
            $w2Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 13 days' ) );
            $w3Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 14 days' ) );
            $w3Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 20 days' ) );
            $w4Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 21 days' ) );
            $w4Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 27 days' ) );
            $w5Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 28 days' ) );
            $w5Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 34 days' ) );
            $w6Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 35 days' ) );
            $w6Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 41 days' ) );
            $w7Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 42 days' ) );
            $w7Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 48 days' ) );
            
            
            
            $currentdetails=$this->chrtdata($currentdate, $comingsaturday, $client_id, $ad_org_id,'N');
            $w1details=$this->chrtdata($w1Sunday, $w1Saturday, $client_id, $ad_org_id,'N');
            $w2details=$this->chrtdata($w2Sunday, $w2Saturday, $client_id, $ad_org_id,'N');
            $w3details=$this->chrtdata($w3Sunday, $w3Saturday, $client_id, $ad_org_id,'N');
            $w4details=$this->chrtdata($w4Sunday, $w4Saturday, $client_id, $ad_org_id,'N');
            $w5details=$this->chrtdata($w5Sunday, $w5Saturday, $client_id, $ad_org_id,'N');
            $w6details=$this->chrtdata($w6Sunday, $w6Saturday, $client_id, $ad_org_id,'N');
            
            $scurrentdetails=$this->chrtdata($currentdate, $comingsaturday, $client_id, $ad_org_id,'Y');
            $sw1details=$this->chrtdata($w1Sunday, $w1Saturday, $client_id, $ad_org_id,'Y');
            $sw2details=$this->chrtdata($w2Sunday, $w2Saturday, $client_id, $ad_org_id,'Y');
            $sw3details=$this->chrtdata($w3Sunday, $w3Saturday, $client_id, $ad_org_id,'Y');
            $sw4details=$this->chrtdata($w4Sunday, $w4Saturday, $client_id, $ad_org_id,'Y');
            $sw5details=$this->chrtdata($w5Sunday, $w5Saturday, $client_id, $ad_org_id,'Y');
            $sw6details=$this->chrtdata($w6Sunday, $w6Saturday, $client_id, $ad_org_id,'Y');
            
            //current week
            $outstanding = array();
            $days = array();
            $outstanding[] = 'data1';
            $days[] = 'days';
            foreach($currentdetails as $currentdetail)
            {
                $outstanding[] = $currentdetail->outstandingamt;
                $days[] = $currentdetail->dueday;
            }
            
            $soutstanding = array();
            $sdays = array();
            $soutstanding[] = 'data8';
            $sdays[] = 'sdays';
            foreach($scurrentdetails as $scurrentdetail)
            {
                $soutstanding[] = $scurrentdetail->outstandingamt;
                $sdays[] = $scurrentdetail->dueday;
            }
            
            //week1
            $outstanding1 = array();
            $days1 = array();
            $outstanding1[] = 'data2';
            $days1[] = 'days';
            foreach($w1details as $w1detail)
            {
                $outstanding1[] = $w1detail->outstandingamt;
                $days1[] = $w1detail->dueday;
            }
            
            $soutstanding1 = array();
            $sdays1 = array();
            $soutstanding1[] = 'data9';
            $sdays1[] = 'sdays';
            foreach($sw1details as $sw1detail)
            {
                $soutstanding1[] = $sw1detail->outstandingamt;
                $sdays1[] = $sw1detail->dueday;
            }
            
            ////week2
            $outstanding2 = array();
            $days2 = array();
            $outstanding2[] = 'data3';
            $days2[] = 'days';
            foreach($w2details as $w2detail)
            {
                $outstanding2[] = $w2detail->outstandingamt;
                $days2[] = $w2detail->dueday;
            }
            
            $soutstanding2 = array();
            $sdays2 = array();
            $soutstanding2[] = 'data10';
            $sdays2[] = 'sdays';
            foreach($sw2details as $sw2detail)
            {
                $soutstanding2[] = $sw2detail->outstandingamt;
                $sdays2[] = $sw2detail->dueday;
            }
            
            ////week3
            $outstanding3 = array();
            $days3 = array();
            $outstanding3[] = 'data4';
            $days3[] = 'days';
            foreach($w3details as $w3detail)
            {
                $outstanding3[] = $w3detail->outstandingamt;
                $days3[] = $w3detail->dueday;
            }
            
            $soutstanding3 = array();
            $sdays3 = array();
            $soutstanding3[] = 'data11';
            $sdays3[] = 'sdays';
            foreach($sw3details as $sw3detail)
            {
                $soutstanding3[] = $sw3detail->outstandingamt;
                $sdays3[] = $sw3detail->dueday;
            }
            
            ////week4
            $outstanding4 = array();
            $days4 = array();
            $outstanding4[] = 'data5';
            $days4[] = 'days';
            foreach($w4details as $w4detail)
            {
                $outstanding4[] = $w4detail->outstandingamt;
                $days4[] = $w4detail->dueday;
            }
            
            $soutstanding4 = array();
            $sdays4 = array();
            $soutstanding4[] = 'data12';
            $sdays4[] = 'sdays';
            foreach($sw4details as $sw4detail)
            {
                $soutstanding4[] = $sw4detail->outstandingamt;
                $sdays4[] = $sw4detail->dueday;
            }
            
            ////week5
            $outstanding5 = array();
            $days5 = array();
            $outstanding5[] = 'data6';
            $days5[] = 'days';
            foreach($w5details as $w5detail)
            {
                $outstanding5[] = $w5detail->outstandingamt;
                $days5[] = $w5detail->dueday;
            }
            
            $soutstanding5 = array();
            $sdays5 = array();
            $soutstanding5[] = 'data13';
            $sdays5[] = 'sdays';
            foreach($sw5details as $sw5detail)
            {
                $soutstanding5[] = $sw5detail->outstandingamt;
                $sdays5[] = $sw5detail->dueday;
            }
            
            ////week6
            $outstanding6 = array();
            $days6 = array();
            $outstanding6[] = 'data7';
            $days6[] = 'days';
            foreach($w6details as $w6detail)
            {
                $outstanding6[] = $w6detail->outstandingamt;
                $days6[] = $w6detail->dueday;
            }
            
            $soutstanding6 = array();
            $sdays6 = array();
            $soutstanding6[] = 'data14';
            $sdays6[] = 'sdays';
            foreach($sw6details as $sw6detail)
            {
                $soutstanding6[] = $sw6detail->outstandingamt;
                $sdays6[] = $sw6detail->dueday;
            }
             
            $data['status']=1;
            
            $data['session_active'] = 'Y'; //$session[0]->session_active;  temperory
            $this->data['curoutstanding'] = $outstanding;
            $this->data['days'] = $days;
            $this->data['currentweek'] = $currentdate." to ".$comingsaturday;
            $this->data['scuroutstanding'] = $soutstanding;
            $this->data['sdays'] = $sdays;
            $this->data['week1'] = $w1Sunday." to ".$w1Saturday;
            $this->data['w1outstanding'] = $outstanding1;
            $this->data['w1days'] = $days1;
            $this->data['sw1outstanding'] = $soutstanding1;
            $this->data['sw1days'] = $sdays1;
            $this->data['week2'] = $w2Sunday." to ".$w2Saturday;
            $this->data['w2outstanding'] = $outstanding2;
            $this->data['w2days'] = $days2;
            $this->data['sw2outstanding'] = $soutstanding2;
            $this->data['sw2days'] = $sdays2;
            $this->data['week3'] = $w3Sunday." to ".$w3Saturday;
            $this->data['w3outstanding'] = $outstanding3;
            $this->data['w3days'] = $days3;
            $this->data['sw3outstanding'] = $soutstanding3;
            $this->data['sw3days'] = $sdays3;
            $this->data['week4'] = $w4Sunday." to ".$w4Saturday;
            $this->data['w4outstanding'] = $outstanding4;
            $this->data['w4days'] = $days4;
            $this->data['sw4outstanding'] = $soutstanding4;
            $this->data['sw4days'] = $sdays4;
            $this->data['week5'] = $w5Sunday." to ".$w5Saturday;
            $this->data['w5outstanding'] = $outstanding5;
            $this->data['w5days'] = $days5;
            $this->data['sw5outstanding'] = $soutstanding5;
            $this->data['sw5days'] = $sdays5;
            $this->data['week6'] = $w6Sunday." to ".$w6Saturday;
            $this->data['w6outstanding'] = $outstanding6;
            $this->data['w6days'] = $days6;
            $this->data['sw6outstanding'] = $soutstanding6;
            $this->data['sw6days'] = $sdays6;
            
            $this->data['status'] = $data['status'];
            $this->data['session_active'] = $data['session_active'];
            
            //print_r($this->data);die;
            return response()->json($this->data);
	}
        
        protected function chrtdata($fromdate,$todate,$clientid,$orgid,$issotrx) 
        {
            $currentdetails = DB::select("select ad_client.name as clientname,
                                            sum(fin_payment_schedule.outstandingamt) as outstandingamt,
                                            TO_CHAR( fin_payment_schedule.duedate, 'DAY') as dueday,
                                            fin_payment_schedule.duedate  as duedate,
                                            c_invoice.issotrx

                                            from c_invoice,fin_payment_schedule,ad_client,ad_org

                                            where 1=1
                                            and ad_client.ad_client_id = c_invoice.ad_client_id
                                            and ad_org.ad_org_id = c_invoice.ad_org_id
                                            and c_invoice.c_invoice_id = fin_payment_schedule.c_invoice_id
                                            and fin_payment_schedule.outstandingamt > 0
                                            and c_invoice.issotrx = '".$issotrx."'
                                            and c_invoice.ad_client_id = '".$clientid."'
                                            
                                            and fin_payment_schedule.duedate >= to_date('".$fromdate."','yyyy-mm-dd')
                                            and fin_payment_schedule.duedate <= to_date('".$todate."','yyyy-mm-dd')

                                            group by ad_client.name,duedate,c_invoice.issotrx

                                            order by ad_client.name,duedate");
            
            return $currentdetails;
        }
        
        protected function daydata($date,$clientid,$orgid,$issotrx) 
        {
            $daydetails = DB::select("select c_invoice.grandtotal as invoicetotal,
                                        c_invoice.dateacct as acctdate,
                                        c_bpartner.name as bpname,
                                        fin_payment_schedule.outstandingamt as outstandingamt,
                                        fin_payment_schedule.duedate  as duedate,
                                        c_order.documentno,
                                        c_invoice.issotrx

                                        from c_invoice,c_bpartner,fin_payment_schedule,ad_client,ad_org,c_order

                                        where 1=1
                                        and ad_client.ad_client_id = c_invoice.ad_client_id
                                        and ad_org.ad_org_id = c_invoice.ad_org_id
                                        and c_invoice.c_order_id = c_order.c_order_id
                                        and c_invoice.c_bpartner_id = c_bpartner.c_bpartner_id
                                        and c_invoice.c_invoice_id = fin_payment_schedule.c_invoice_id
                                        and fin_payment_schedule.outstandingamt > 0
                                        and c_invoice.issotrx = '".$issotrx."'
                                        and c_invoice.ad_client_id = '".$clientid."'
                                        and fin_payment_schedule.duedate = '".$date."'

                                        order by duedate");
            
            return $daydetails;
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
        
        public function postPendingdetail()
        {
            $inputs = Request::all();
            $index = $inputs['index'];
            $id = $inputs['id'];
            $client_id = $inputs['ad_client_id'];
            $ad_org_id = $inputs['ad_org_id'];
            
            if(date('w', strtotime('today')) == 1)
            {
                $currentdate = date( 'Y-m-d', strtotime( 'today -1 days'));
            }
            else
            {
                $currentdate = date('Y-m-d');
            }
            
            $comingsaturday = date( 'Y-m-d', strtotime( 'saturday' ) );
            $w1Sunday = date( 'Y-m-d', strtotime( 'next Sunday' ) );
            $w1Saturday = date( 'Y-m-d', strtotime( 'next Monday + 5 days'));
            $w2Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 7 days' ) );
            $w2Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 13 days' ) );
            $w3Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 14 days' ) );
            $w3Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 20 days' ) );
            $w4Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 21 days' ) );
            $w4Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 27 days' ) );
            $w5Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 28 days' ) );
            $w5Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 34 days' ) );
            $w6Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 35 days' ) );
            $w6Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 41 days' ) );
            $w7Sunday = date( 'Y-m-d', strtotime( 'next Sunday + 42 days' ) );
            $w7Saturday = date( 'Y-m-d', strtotime( 'next Sunday + 48 days' ) );
            
            if($id == 'data1' || $id == 'data8')
            {   if($id == 'data1')
                {
                    $t = 'N';
                }
                elseif($id == 'data8')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($currentdate, $comingsaturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data2' || $id == 'data9')
            {
                if($id == 'data2')
                {
                    $t = 'N';
                }
                elseif($id == 'data9')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w1Sunday, $w1Saturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data3' || $id == 'data10')
            {
                if($id == 'data3')
                {
                    $t = 'N';
                }
                elseif($id == 'data10')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w2Sunday, $w2Saturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data4' || $id == 'data11')
            {
                if($id == 'data4')
                {
                    $t = 'N';
                }
                elseif($id == 'data11')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w3Sunday, $w3Saturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data5' || $id == 'data12')
            {
                if($id == 'data5')
                {
                    $t = 'N';
                }
                elseif($id == 'data12')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w4Sunday, $w4Saturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data6' || $id == 'data13')
            {
                if($id == 'data6')
                {
                    $t = 'N';
                }
                elseif($id == 'data13')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w5Sunday, $w5Saturday, $client_id, $ad_org_id,$t);
            }
            elseif($id == 'data7' || $id == 'data14')
            {
                if($id == 'data7')
                {
                    $t = 'N';
                }
                elseif($id == 'data14')
                {
                    $t='Y';
                }
                $details=$this->chrtdata($w6Sunday, $w6Saturday, $client_id, $ad_org_id,$t);
            }
            
            
            $date = $details[$index]->duedate;
            $issotrx = $details[$index]->issotrx;
            $daydetails = $this->daydata($date,$client_id,$ad_org_id,$issotrx);
            $status = 1;
            $this->data['status'] = $status;
            $this->data['index'] = $index;
            $this->data['daydetails'] = $daydetails;
            //print_r($details);die;
            return response()->json($this->data);
        }
}
