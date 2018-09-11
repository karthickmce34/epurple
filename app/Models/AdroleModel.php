<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdroleModel extends Model {
    

    public $perPage = 3000;
    public $pageNo = 1;    
    

    public $table = 'ad_role';
    // 	id	name	address	created_by	status	create_date	update_date
    //protected $fillable = array('name', 'phone', 'country', 'city', 'address', 'email', 'type', 'type_id', 'source', 'unit_id', 'status', 'prop_val', 'loan_amt', 'message', 'remarks', 'utm_source', 'utm_medium', 'assigned_to', 'assigned_date', 'otp_num', 'verified_status', 'sopf_registration_location');
    protected $fillable = array('ad_role_id','ad_client_id','ad_org_id','isactive','created','createdby','updated','updatedby','name','description',
        'clientlist','orglist');
    protected $selectable = array('ad_role.ad_role_id','ad_role.ad_client_id','ad_role.ad_org_id','ad_role.isactive','ad_role.created','ad_role.createdby','ad_role.updated','ad_role.updatedby','ad_role.name','ad_role.description',
        'ad_role.clientlist','ad_role.orglist');
    
    
    public function __construct()
    {
        parent::__construct();

    }     
    
    
}


