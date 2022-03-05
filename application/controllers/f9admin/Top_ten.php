<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Top_ten extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }

           public function view_top_ten_categories()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   $this->db->where('is_active', 1);
                   $data['category_data']= $this->db->get();
                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/top_ten/view_top_ten_categories');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }


           public function view_top_ten_sub_categories($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $id=base64_decode($idd);
                   $data['id']=$idd;
                   $this->db->select('*');
                   $this->db->from('tbl_subcategory');
                   $this->db->where('category', $id);
                   $this->db->where('is_active', 1);
                   $data['sub_category_data']= $this->db->get();
                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/top_ten/view_top_ten_sub_categories');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function view_top_ten_products($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $id=base64_decode($idd);
                   // echo $id;
                   // exit;
                   $data['id']=$idd;
                   $this->db->select('*');
                   $this->db->from('tbl_products');
                   $this->db->like('subcategory', $id);
                   $this->db->order_by('id', 'desc');
                   $this->db->where('is_active', 1);
                   $data['products_data']= $this->db->get();
                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/top_ten/view_top_ten_products');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_top_ten($sub_id,$id)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['sub_id']=$sub_id;
                   $data['id']=$id;

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/top_ten/view_top_ten_seq');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_top_ten_data()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       $this->form_validation->set_rules('sub_id', 'sub_id', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('top_ten', 'top_ten', 'required|xss_clean|trim');


                       if ($this->form_validation->run()== true) {
                           $sub_id=base64_decode($this->input->post('sub_id'));
                           $id=base64_decode($this->input->post('id'));
                           $top_ten=$this->input->post('top_ten');

                           $data_update = array(
                         'top_ten'=>$top_ten,
                                   );
                           $this->db->where('id', $id);
                           $zapak=$this->db->update('tbl_products', $data_update);

                           if (!empty($zapak)) {
                               redirect("dcadmin/Top_ten/view_top_ten_products/".base64_encode($sub_id), "refresh");
                           } else {
                               $this->session->set_flashdata('emessage', 'Some error occured');
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

           public function remove_top_ten($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                  $id=base64_decode($idd);
                 $data['id']=$idd;
                   // $data_update = array(
                   //              'top_ten'=>"",
                   //                        );
                   $this->db->where('id', $id);
                   $zapak=$this->db->update('tbl_products' ,array('top_ten' => NULL));
                   // $zapak=$this->db->update('tbl_products', $data_update);

                   if (!empty($zapak)) {
                       $this->session->set_flashdata('smessage', 'Successfully Removed');
                       redirect($_SERVER['HTTP_REFERER']);
                   } else {
                       $this->session->set_flashdata('emessage', 'Some error occured');
                       redirect($_SERVER['HTTP_REFERER']);
                   }

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/dash');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
       }
