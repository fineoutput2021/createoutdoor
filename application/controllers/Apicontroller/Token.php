<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Token extends CI_Controller{
function __construct()
{
parent::__construct();
$this->load->model("admin/login_model");
$this->load->model("admin/base_model");
}

public function random_strings($length_of_string)
{

// String of all alphanumeric character
$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Shufle the $str_result and returns substring
// of specified length
return substr(str_shuffle($str_result), 0, $length_of_string);
}


public function get_token(){


$txnid= $this->random_strings(30);

$this->db->select('*');
$this->db->from('tbl_token');
$this->db->where('token',$txnid);
$this->db->where('is_active',1);
$tt= $this->db->get()->row();


if(!empty($tt)){
$txnid= $this->random_strings(30);
}
else{
// echo "hi";
// exit;
$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$data_insert = array('token'=>$txnid,
      'ip' =>$ip,
      'is_active' =>1,
      'added_by' =>999,
      'date'=>$cur_date

      );





$last_id=$this->base_model->insert_table("tbl_token",$data_insert,1) ;

$token=$txnid;
}
header('Access-Control-Allow-Origin: *');

$res = array('message'=>"success",
'status'=>200,
'token'=>$token
);

echo json_encode($res);


}


public function add_user(){


  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {
    // print_r($this->input->post());
    // exit;
    $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');

    if($this->form_validation->run()== TRUE)
    {
      $name=$this->input->post('name');

        $ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $addedby=999;

$data_insert = array('name'=>$name,
          'address'=>$address,
          'ip' =>$ip,
          'is_active' =>1,
          'date'=>$cur_date

          );





$last_id=$this->base_model->insert_table("tbl_users",$data_insert,1) ;

if($last_id!=0){
  header('Access-Control-Allow-Origin: *');

$res = array('message'=>"success",
          'status'=>200
          );

  echo json_encode($res);

      }

      else

      {
        header('Access-Control-Allow-Origin: *');

        $res = array('message'=>"Sorry error occured",
              'status'=>201
              );

              echo json_encode($res);




      }


    }
  else{
    header('Access-Control-Allow-Origin: *');

    $res = array('message'=>validation_errors(),
          'status'=>201
          );

          echo json_encode($res);


  }

  }
else{
  header('Access-Control-Allow-Origin: *');

  $res = array('message'=>"Please insert some data, No data available",
        'status'=>201
        );

        echo json_encode($res);

}



}


}
