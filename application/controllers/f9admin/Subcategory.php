<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Subcategory extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }

           public function view_subcategory()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;

                   $this->db->select('*');
                   $this->db->from('tbl_subcategory');
                   //$this->db->where('id',$usr);
                   $data['subcategory_data']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/subcategory/view_subcategory');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_subcategory()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   //$this->db->where('id',$usr);
                   $data['category_data']= $this->db->get();


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/subcategory/add_subcategory');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function update_subcategory($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;

                   $id=base64_decode($idd);
                   $data['id']=$idd;

                   $this->db->select('*');
                   $this->db->from('tbl_subcategory');
                   $this->db->where('id', $id);
                   $data['subcategory_data']= $this->db->get()->row();

                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   //$this->db->where('id',$usr);
                   $data['category_data']= $this->db->get();


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/subcategory/update_subcategory');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_subcategory_data($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;
                       $this->form_validation->set_rules('category', 'category', 'required|trim');
                       $this->form_validation->set_rules('subcategory', 'subcategory', 'required');
                       $this->form_validation->set_rules('text', 'text', 'trim');

                       if ($this->form_validation->run()== true) {
                           $category=$this->input->post('category');
                           $subcategory=$this->input->post('subcategory');
                           $text=$this->input->post('text');

                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");
                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           $last_id = 0;
                           if ($typ==1) {
                               $data_insert = array(
                  'category'=>$category,
  'subcategory'=>$subcategory,
  'text'=>$text,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


                               $last_id=$this->base_model->insert_table("tbl_subcategory", $data_insert, 1) ;
                                $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/subcategory/view_subcategory", "refresh");
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);


                               $this->db->select('*');
                               $this->db->from('tbl_subcategory');
                               $this->db->where('id', $idw);
                               $dsa=$this->db->get();
                               $da=$dsa->row();





                               $data_insert = array(
                  'category'=>$category,
  'subcategory'=>$subcategory,
  'text'=>$text


                     );
                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_subcategory', $data_insert);
                           }
                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');
                               redirect("dcadmin/subcategory/view_subcategory", "refresh");
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

           public function updatesubcategoryStatus($idd, $t)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   $id=base64_decode($idd);

                   if ($t=="active") {
                       $data_update = array(
                        'is_active'=>1

                        );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_subcategory', $data_update);

                       if ($zapak!=0) {
 $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/subcategory/view_subcategory", "refresh");
                       } else {
                           $this->session->set_flashdata('emessage', 'Sorry error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
                   if ($t=="inactive") {
                       $data_update = array(
                         'is_active'=>0

                         );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_subcategory', $data_update);

                       if ($zapak!=0) {
                          $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/subcategory/view_subcategory", "refresh");
                       } else {
                           $this->session->set_flashdata('emessage', 'Sorry error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }



           public function delete_subcategory($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);

                   if ($this->load->get_var('position')=="Super Admin") {
                       $this->db->select('*');
                       $this->db->from('tbl_subcategory');
                       $this->db->where('id', $id);
                       $dsa= $this->db->get();
                       $da=$dsa->row();


                       $zapak=$this->db->delete('tbl_subcategory', array('id' => $id));
                       if ($zapak!=0) {

                         $this->db->select('*');
                         $this->db->from('tbl_products');
                         $this->db->like('subcategory',$id);
                         $product_data= $this->db->get();
                          foreach($product_data->result() as $pro) {
                            $sub = json_decode($pro->subcategory);
                            $i=0;
                            foreach ($sub as $value) {
                              if($value==$id){
                                $i=1;
                              }
                            }
                            if($i==1){
                              if(count($sub)==1){
                              $delete=$this->db->delete('tbl_products', array('id' => $pro->id));
                              $delete2=$this->db->delete('tbl_type', array('product_id' => $pro->id));
                              }else{
                                if (($key = array_search($id, $sub)) !== false) {
                                    unset($sub[$key]);
                                    $data_update = array('subcategory'=>json_encode($sub));
                                                $this->db->where('id',$pro->id);
                                                $zapak=$this->db->update('tbl_products', $data_update);

                                  }
                              }
                            }
                          }
}

if ($zapak!=0) {
$this->session->set_flashdata('smessage', 'Subcategory deleted successfully');
    redirect("dcadmin/subcategory/view_subcategory", "refresh");
} else   {
   $this->session->set_flashdata('emessage', 'Some unknown error occured');
redirect($_SERVER['HTTP_REFERER']);
 }
} else {
$this->session->set_flashdata('emessage', 'Sorry You Dont Have Permission To Delete Anything');
redirect($_SERVER['HTTP_REFERER']);
}
} else {
$this->session->set_flashdata('emessage', 'Sorry you not a super admin you dont have permission to delete anything');
redirect($_SERVER['HTTP_REFERER']);
}
}
}
