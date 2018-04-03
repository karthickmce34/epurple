<?php namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;


class TrialbalanceController extends Controller {

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
            return view('trailbalance',$data);
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
            $data['session_active'] = $session[0]->session_active;
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
        
        public function getAcctdata()
        {
            
            $inputs = Request::all();
            $client_id=$inputs['ad_client_id'];
            $acctschema_id=$inputs['c_acctschema_id'];
            $fromdate=$inputs['fromdate'];
            $todate=$inputs['todate'];
            $org_id=$inputs['org_id'];
            
            
            $data2 = DB::select("select  c.initialbalance as initialbalance,
                                c.AMTACCTDR as AMTACCTDR,
                                c.AMTACCTCR as AMTACCTCR,
                                ((c.initialbalance + c.AMTACCTDR)-c.AMTACCTCR) as closingbalance,
                                c.name as name,
                                c.value as value,
                                CASE WHEN c.elementlevel like 'S' then concat(concat(concat('subaccount_',to_char(c.node_id)),'_'),to_char(c.initialbalance)) else 'account' end as elementlevel,
                                c.node_id as node_id,
                                c.parent_id as parent_id

                        from ( select MFM_Initial_Balance(b.node_id,TO_DATE('".$fromdate."','YYYY-MM-DD'),'".$client_id."','".$org_id."') as initialbalance, 
                                b.AMTACCTDR,
                                b.AMTACCTCR,
                                b.name,
                                b.value,
                                b.elementlevel,
                                b.node_id,
                                b.parent_id 

                        from (select  SUM((CASE WHEN FACT_ACCT.FACTACCTTYPE in ('O') THEN 0 ELSE coalesce(FACT_ACCT.AMTACCTCR,0) END)) AS AMTACCTCR,
                                SUM((CASE WHEN FACT_ACCT.FACTACCTTYPE in ('O') THEN 0 ELSE coalesce(FACT_ACCT.AMTACCTDR,0) END)) AS AMTACCTDR,  
                                                        name,value,elementlevel,node_id,parent_id
                        from 
                          ad_treenode,
                          c_elementvalue 
                              left join FACT_ACCT 
                                on FACT_ACCT.ACCOUNT_ID = c_elementvalue.C_ELEMENTVALUE_ID
                                AND FACT_ACCT.DATEACCT >= TO_DATE('".$fromdate."','YYYY-MM-DD')
                                                        AND FACT_ACCT.DATEACCT <= TO_DATE('".$todate."','YYYY-MM-DD')
                                                        AND FACT_ACCT.C_ACCTSCHEMA_ID = '".$acctschema_id."'
                                                        AND FACT_ACCT.AD_ORG_ID = '".$org_id."'

                        where c_elementvalue.c_elementvalue_id = ad_treenode.node_id 
                              and ad_treenode.ad_client_id='".$client_id."'


                        group by 
                              value,name,elementlevel,node_id,parent_id 
                        order by 
                              elementlevel,value)B)C

                        where   ((elementlevel != 'S') or (c.initialbalance <> 0
                                or c.AMTACCTDR <> 0
                                or c.AMTACCTCR <> 0)) ");
            $sub_data= array();
            foreach($data2 as $row)
            {
                //echo"<pre>";print_r($row);
                $sub_data["id"] = $row->node_id;
                $sub_data["number"] = $row->value;
                $sub_data["name"] = utf8_encode($row->name);
                $sub_data["text"] = utf8_encode($row->name);//$row->value;
                $sub_data["amtacctdr"] =  $row->amtacctdr;
                $sub_data["amtacctcr"] =  $row->amtacctcr;
                $sub_data["initialbalance"] =  $row->initialbalance;
                $sub_data["closingbalance"] =  $row->closingbalance;
                $sub_data["elementlevel"] =  $row->elementlevel;
                $sub_data["parent_id"] = $row->parent_id;
                $data3[] = $sub_data;
            }
            foreach($data3 as $key => &$value)
            {
                $output[$value["id"]] = &$value;
            }
            foreach($data3 as $key => &$value)
            {
                if($value["parent_id"] && isset($output[$value["parent_id"]]))
                {
                    $output[$value["parent_id"]]["assets"][] = &$value;
                }
            }
            foreach($data3 as $key => &$value)
            {
                if($value["parent_id"] && isset($output[$value["parent_id"]]))
                {
                    unset($data3[$key]);
                }
            }
            
            return response()->json($data3);
        }
               
        public function getTransactiondata()
        {
            
            $inputs = Request::all();
            $account_id=$inputs['node_id'];
            $fromdate=$inputs['fromdate'];
            $todate=$inputs['todate'];
            $org_id=$inputs['org_id'];
            $client_id=$inputs['ad_client_id'];
            
            $status=0; 
            
            $data2 = DB::select("SELECT MFM_Initial_Balance('".$account_id."',TO_DATE('".$fromdate."','YYYY-MM-DD'),'".$client_id."','".$org_id."') as initialbalance,fact_acct_id,dateacct,amtacctdr,amtacctcr,acctdescription FROM fact_acct
                                    where FACT_ACCT.DATEACCT >= TO_DATE('".$fromdate."','YYYY-MM-DD')
                                        AND FACT_ACCT.DATEACCT <= TO_DATE('".$todate."','YYYY-MM-DD') 
                                        and account_id='".$account_id."' 
                                        AND FACT_ACCT.AD_ORG_ID = '".$org_id."'");
            
            $data['transdata']=$data2;
            if(count($data2) >0)
            {
             $status=1;   
            }
             $data['status']=$status;
            return response()->json($data);
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
            $data['session_active'] = $session[0]->session_active;
            $data['openbravoip'] = $openbravoip;
            $this->data['session_active'] = $data['session_active'];
            $this->data['openbravoip'] = $data['openbravoip'];
            return response()->json($this->data);
        }
}
