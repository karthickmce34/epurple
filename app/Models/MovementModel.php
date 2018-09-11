<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementModel extends Model {
    

    public $perPage = 3000;
    public $pageNo = 1;    
    

    public $table = 'm_movement';
    // 	id	name	address	created_by	status	create_date	update_date
    //protected $fillable = array('name', 'phone', 'country', 'city', 'address', 'email', 'type', 'type_id', 'source', 'unit_id', 'status', 'prop_val', 'loan_amt', 'message', 'remarks', 'utm_source', 'utm_medium', 'assigned_to', 'assigned_date', 'otp_num', 'verified_status', 'sopf_registration_location');
    protected $fillable = array('m_movement_id','ad_client_id','ad_org_id','isactive','created','createdby','updated','updatedby','name','description',
        'movementdate','posted','processed','processing','documentno');
    protected $selectable = array('m_movement.m_movement_id','m_movement.ad_client_id','m_movement.ad_org_id','m_movement.isactive','m_movement.created','m_movement.createdby','m_movement.updated','m_movement.updatedby','m_movement.name','m_movement.description',
        'm_movement.movementdate','m_movement.posted','m_movement.processed','m_movement.processing','m_movement.documentno');
    
    
    public function __construct()
    {
        parent::__construct();

    }     
    
    
}


