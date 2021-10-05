<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class product_type extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }
           public function view_type($idd){

                            if(!empty($this->session->userdata('admin_data'))){


                              $data['user_name']=$this->load->get_var('user_name');

                              // echo SITE_NAME;
                              // echo $this->session->userdata('image');
                              // echo $this->session->userdata('position');
                              // exit;
   $id=base64_decode($idd);
  $data['id']=$idd;
                    $this->db->select('*');
        $this->db->from('tbl_type');
        $this->db->where('id',$id);
        $data['type']= $this->db->get();

                              $this->load->view('admin/common/header_view',$data);
                              $this->load->view('admin/product_type/view_type');
                              $this->load->view('admin/common/footer_view');

                          }
                          else{

                             redirect("login/admin_login","refresh");
                          }

                          }
}
