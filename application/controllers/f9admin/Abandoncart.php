<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Abandoncart extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }

           public function view_Abandon_cart()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   $this->db->select('user_id');
                   $this->db->distinct();
                   $this->db->where('user_id is NOT NULL', NULL, FALSE);
                   $cart_data = $this->db->get('tbl_cart');

                   $data['cart_data']= $cart_data;

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/abandoncart/view_Abandon_cart');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function view_add_percentage()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/abandoncart/view_add_percentage');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_percentage_data($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;
                       $this->form_validation->set_rules('percentage', 'percentage', 'required|xss_clean|trim');

                       if ($this->form_validation->run()== true) {
                           $percentage=$this->input->post('percentage');

                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");

                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           if ($typ==1) {
                               $data_insert = array('percentage'=>$percentage,
                               'ip' =>$ip,
                               'added_by' =>$addedby,
                               'is_active' =>1,
                               'date'=>$cur_date

                               );


                               $last_id=$this->base_model->insert_table("tbl_discount_percentage", $data_insert, 1) ;
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);

                               $data_insert = array('percentage'=>$percentage,
                               'ip' =>$ip,
                               'added_by' =>$addedby,
                               'is_active' =>1,
                               'date'=>$cur_date

                               );

                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_discount_percentage', $data_insert);
                           }


                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data inserted successfully');

                               redirect("dcadmin/Abandoncart/view_Abandon_cart", "refresh");
                           } else {
                               $this->session->set_flashdata('emessage', 'Sorry error occured');
                               redirect($_SERVER['HTTP_REFERER']);
                           }
                       } else {
                           $this->session->set_flashdata('emessage', validation_errors());
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   } else {
                       $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
                       redirect($_SERVER['HTTP_REFERER']);
                   }
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function view_cart_details($idd){
             if (!empty($this->session->userdata('admin_data'))) {
                $id=base64_decode($idd);
               $data['id']=$idd;

                           $this->db->select('*');
               $this->db->from('tbl_cart');
               $this->db->where('user_id',$id);
               $data['cart_data']= $this->db->get();

               $this->load->view('admin/common/header_view',$data);
               $this->load->view('admin/abandoncart/view_cart_details');
               $this->load->view('admin/common/footer_view');

           } else {
               redirect("login/admin_login", "refresh");
           }
           }
       }
