<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Neworder extends CI_finecontrol{
function __construct()
{
parent::__construct();
$this->load->model("login_model");
$this->load->model("admin/base_model");
$this->load->library('user_agent');
$this->load->library('upload');
}

public function view_order(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where("order_status",1);
$this->db->order_by("id", "desc");


$data['order_data']= $this->db->get();

$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/order/view_order');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

public function view_accept_order(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where('order_status',2);
$this->db->order_by("id", "desc");
$data['order_data']= $this->db->get();


$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/order/view_accept_order');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
public function update_order_status($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);

if($t=="accept"){

$data_update = array(
'order_status'=>2

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_order1', $data_update);

if($zapak!=0){
  $this->session->set_flashdata('smessage', 'order Status updated successfully');
redirect("dcadmin/Neworder/view_accept_order","refresh");
}
else
{
echo "Error";
exit;
}
}
}
else{

$this->load->view('admin/login/index');
}

}
public function update_cancel_status($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);

if($t=="Cancel"){

$data_update = array(
'order_status'=>5

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_order1', $data_update);

//inventory_update
$this->db->select('*');
            $this->db->from('tbl_order2');
            $this->db->where('main_id',$id);
            $data_order2= $this->db->get();
 foreach($data_order2->result() as $data) {

   $this->db->select('*');
      $this->db->from('tbl_inventory');
      $this->db->where('type_id',$data->type_id);
      $data_inventory= $this->db->get()->row();

    $total_quantity=$data->quantity + $data_inventory->quantity;



    $data_update=array(
             'quantity'=>$total_quantity
    );
    $this->db->where('id', $data_inventory->id);
    $last_id2=$this->db->update('tbl_inventory', $data_update);
}
//---------------------

if($zapak!=0){
  $this->session->set_flashdata('smessage', 'order Status Cancelled successfully');
redirect("dcadmin/Neworder/view_cancel_orders","refresh");
}
else
{
echo "Error";
exit;
}
}




}
else{

$this->load->view('admin/login/index');
}

}

public function update_dispatch_status($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);

if($t=="dispatch"){

$data_update = array(
'order_status'=>3

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_order1', $data_update);

if($zapak!=0){
  $this->session->set_flashdata('smessage', 'order Status updated successfully');
redirect("dcadmin/Neworder/view_dispatched_orders","refresh");
}
else
{
echo "Error";
exit;
}
}




}
else{

$this->load->view('admin/login/index');
}

}

public function update_completed_status($idd,$t){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);

if($t=="completed"){

$data_update = array(
'order_status'=>4

);

$this->db->where('id', $id);
$zapak=$this->db->update('tbl_order1', $data_update);

if($zapak!=0){
  $this->session->set_flashdata('smessage', 'order Status updated successfully');
redirect("dcadmin/Neworder/view_completed_orders","refresh");
}
else
{
echo "Error";
exit;
}
}

}
else{

$this->load->view('admin/login/index');
}

}



public function view_product_status($idd){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$id=base64_decode($idd);



$this->db->select('*');
$this->db->from('tbl_order2');
$this->db->where('main_id',$id);
$data['status_product']= $this->db->get();

$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where('id',$id);
$data['order_data']= $this->db->get()->row();


$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/order/view_product_status');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
public function view_completed_orders(){

if(!empty($this->session->userdata('admin_data'))){


$data['user_name']=$this->load->get_var('user_name');

// echo SITE_NAME;
// echo $this->session->userdata('image');
// echo $this->session->userdata('position');
// exit;
$this->db->select('*');
      $this->db->from('tbl_order1');
      $this->db->where('order_status',4);

      $data['order_data']= $this->db->get();


$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/order/view_completed_orders');
$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
public function view_dispatched_orders(){

if(!empty($this->session->userdata('admin_data'))){


 $data['user_name']=$this->load->get_var('user_name');

 // echo SITE_NAME;
 // echo $this->session->userdata('image');
 // echo $this->session->userdata('position');
 // exit;
 $this->db->select('*');
             $this->db->from('tbl_order1');
             $this->db->where('order_status',3);
                    $this->db->order_by("id", "desc");
             $data['order_data']= $this->db->get();

 $this->load->view('admin/common/header_view',$data);
 $this->load->view('admin/order/view_dispatched_orders');
 $this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}
public function view_cancel_orders(){

              if(!empty($this->session->userdata('admin_data'))){


                $data['user_name']=$this->load->get_var('user_name');

                // echo SITE_NAME;
                // echo $this->session->userdata('image');
                // echo $this->session->userdata('position');
                // exit;
                $this->db->select('*');
                            $this->db->from('tbl_order1');
                            $this->db->where('order_status',5);
                            $this->db->order_by("id", "desc");
                            $data['order_data']= $this->db->get();

                $this->load->view('admin/common/header_view',$data);
                $this->load->view('admin/order/view_cancel_order');
                $this->load->view('admin/common/footer_view');

            }
            else{

               redirect("login/admin_login","refresh");
            }

            }

public function view_order_bill($main_id){

if(!empty($this->session->userdata('admin_data'))){


$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where('id',base64_decode($main_id));
$data['order1_data']= $this->db->get()->row();

$this->db->select('*');
$this->db->from('tbl_order2');
$this->db->where('main_id',base64_decode($main_id));
$data['order2_data']= $this->db->get();

//$this->load->view('admin/common/header_view',$data);
$this->load->view('admin/order/order_bill',$data);
//$this->load->view('admin/common/footer_view');

}
else{

redirect("login/admin_login","refresh");
}

}

}
