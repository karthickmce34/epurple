<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduserModel extends Model {
    

    public $perPage = 3000;
    public $pageNo = 1;    
    

    public $table = 'ad_user';
    // 	id	name	address	created_by	status	create_date	update_date
    //protected $fillable = array('name', 'phone', 'country', 'city', 'address', 'email', 'type', 'type_id', 'source', 'unit_id', 'status', 'prop_val', 'loan_amt', 'message', 'remarks', 'utm_source', 'utm_medium', 'assigned_to', 'assigned_date', 'otp_num', 'verified_status', 'sopf_registration_location');
    protected $fillable = array('ad_user_id','ad_client_id','ad_org_id','isactive','created','createdby','updated','updatedby','name','description',
        'default_ad_client_id','default_ad_org_id','default_ad_role_id');
    protected $selectable = array('ad_user.ad_user_id','ad_user.ad_client_id','ad_user.ad_org_id','ad_user.isactive','ad_user.created','ad_user.createdby','ad_user.updated','ad_user.updatedby','ad_user.name','ad_user.description',
        'ad_user.default_ad_client_id','ad_user.default_ad_org_id','ad_user.default_ad_role_id');
    
    
    public function __construct()
    {
        parent::__construct();

    }     
    
    
}


