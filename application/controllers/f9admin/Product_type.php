<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Product_type extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }
           public function view_type($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);
                   // echo $id;
                   // exit;
                   $data['id']=$idd;

                   $this->db->select('*');
                   $this->db->from('tbl_type');
                   $this->db->where('product_id', $id);
                   $data['type']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/product_type/view_type');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_type($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;




                   $data['id']=$idd;



                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/product_type/add_type');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_data_type($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;





                       $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('mrp', 'mrp', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('gst', 'gst', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('sellingprice', 'sellingprice', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('gstprice', 'gstprice', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('price', 'price', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('sample_price', 'sample_price', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('weight', 'weight', 'required|xss_clean|trim');

                       if ($this->form_validation->run()== true) {
                           $p_id=$this->input->post('p_id');


                           $name=$this->input->post('name');
                           $mrp=$this->input->post('mrp');
                           $gst=$this->input->post('gst');
                           $sellingprice=$this->input->post('sellingprice');
                           $gstprice=$this->input->post('gstprice');
                           $price=$this->input->post('price');
                           $sample_price=$this->input->post('sample_price');
                           $color=$this->input->post('color');

                           $weight=$this->input->post('weight');

                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");

                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           if ($typ==1) {
                               $data_insert = array('name'=>$name,
                              'mrp'=>$mrp,
                              'gst'=>$gst,
                              'sp'=>$sellingprice,
                              'gstprice'=>$gstprice,
                              'spgst'=>$price,
                              'color'=>$color,
                              'sample_price'=>$sample_price,

                              'weight'=>$weight,
                              'product_id'=>base64_decode($p_id),
                              'ip' =>$ip,
                              'added_by' =>$addedby,
                              'is_active' =>1,
                              'date'=>$cur_date

                              );

                               $last_id=$this->base_model->insert_table("tbl_type", $data_insert, 1) ;

                               $inventory_data = array(
                               'type_id'=> $last_id,
                               'quantity'=>100000,
                               'ip'=>$ip,
                               'date'=>$addedby,
                               'added_by'=>$cur_date

                             );





                               $last_id=$this->base_model->insert_table("tbl_inventory", $inventory_data, 1) ;

                               $product_id=base64_decode($p_id);
                               $this->db->select('*');
                               $this->db->from('tbl_products');
                               $this->db->where('id', $product_id);
                               $this->db->where('is_active', 0);
                               $product_data= $this->db->get()->row();

                               if (!empty($product_data)) {
                                   // echo "hi";
                                   // exit;
                                   $data_insert1 = array('is_active'=>1);

                                   $this->db->where('id', $product_id);
                                   $last_id1=$this->db->update('tbl_products', $data_insert1);

                                   $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                   redirect("dcadmin/product_type/view_type/$p_id", 'refresh');
                               }
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);

                               // $this->db->select('*');
                               //     $this->db->from('tbl_minor_category');
                               //    $this->db->where('name',$name);
                               //     $damm= $this->db->get();
                               //    foreach($damm->result() as $da) {
                               //      $uid=$da->id;
                               // if($uid==$idw)
                               // {
                               //
                               //  }
                               // else{
                               //    echo "Multiple Entry of Same Name";
                               //       exit;
                               //  }
                               //     }

                               $data_insert = array('name'=>$name,
                    'mrp'=>$mrp,
                    'gst'=>$gst,
                    'sp'=>$sellingprice,
                    'gstprice'=>$gstprice,
                    'spgst'=>$price,
                    'sample_price'=>$sample_price,
                      'color'=>$color,
                    'weight'=>$weight

                              );

                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_type', $data_insert);
                               $this->session->set_flashdata('smessage', 'Data updated successfully');
                               redirect("dcadmin/product_type/view_type/$p_id", 'refresh');
                           }
                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');
                               redirect("dcadmin/product_type/view_type/$p_id", 'refresh');
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
           public function update_type($idd, $id1)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;\
                   $id=base64_decode($idd);
                   $data['id']=$idd;

                   $id1=base64_decode($id1);
                   $data['id1']=$id1;


                   $this->db->select('*');
                   $this->db->from('tbl_type');
                   $this->db->where('id', $id);
                   $dsa= $this->db->get();
                   $data['u_data']=$dsa->row();


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/product_type/update_type');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function delete_type($idd, $id1)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $id=base64_decode($idd);



                   $id1=base64_decode($id1);
                   $data['id1']=$id1;


                   if ($this->load->get_var('position')=="Super Admin") {
                       $zapak=$this->db->delete('tbl_type', array('id' => $id));
                       if ($zapak!=0) {
                           $this->session->set_flashdata('smessage', 'Product Type deleted successfully');
                           redirect("dcadmin/product_type/view_type/".$id1, "refresh");
                       } else {
                           $this->session->set_flashdata('emessage', 'Some unknown error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   } else {
                       $this->session->set_flashdata('emessage', 'Sorry you dont have permisssion to delete anything');
                       redirect($_SERVER['HTTP_REFERER']);
                   }
               } else {
                   $this->session->set_flashdata('emessage', 'Sorry you not a super admin you dont have permission to delete anything');
                   redirect($_SERVER['HTTP_REFERER']);
               }
           }
           public function updatetypeStatus($idd, $t)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);

                   $this->db->select('*');
                   $this->db->from('tbl_type');
                   $this->db->where('id', $id);
                   $dsa= $this->db->get();
                   $type_data=$dsa->row();

                   $product_id  = $type_data->product_id;
                   $pro_id= base64_encode($product_id);

                   if ($t=="active") {
                       $data_update = array(
                         'is_active'=>1

                         );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_type', $data_update);

                       if ($zapak!=0) {
 $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/product_type/view_type/$pro_id", "refresh");
                       } else {
                           echo "Error";
                           exit;
                       }
                   }
                   if ($t=="inactive") {
                       $data_update = array(
                          'is_active'=>0

                          );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_type', $data_update);

                       if ($zapak!=0) {
                          $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/product_type/view_type/$pro_id", "refresh");
                       } else {
                           $data['e']="Error Occured";
                           // exit;
                           $this->load->view('errors/error500admin', $data);
                       }
                   }
               } else {
                   $this->load->view('admin/login/index');
               }
           }
       }
