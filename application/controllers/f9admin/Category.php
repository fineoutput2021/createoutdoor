<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Category extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }


    public function view_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->order_by('seq','asc');
            $data['category_data']= $this->db->get();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/view_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }







    public function add_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/add_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    public function add_category_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('title', 'title', 'required|xss_clean|trim');
                $this->form_validation->set_rules('text', 'text', 'required|xss_clean|trim');
                $this->form_validation->set_rules('seq', 'seq', 'required|xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    $title=$this->input->post('title');
                    $text=$this->input->post('text');
                    $seq=$this->input->post('seq');

                    // Load library
                    $this->load->library('upload');

                    $img2='image';

                    $file_check=($_FILES['image']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/category/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="team".date("Ymdhms");
                        $this->upload_config = array(
                                                                'upload_path'   => $image_upload_folder,
                                                                'file_name' => $new_file_name,
                                                                'allowed_types' =>'jpg|jpeg|png',
                                                                'max_size'      => 25000
                                                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img2)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $image = "assets/uploads/category/".$new_file_name.$file_info['file_ext'];
                            $file_info['new_name']=$image;
                            // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                            $nnn=$file_info['file_name'];
                            // echo json_encode($file_info);
                        }
                    }



                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('title'=>$title,
                    'image'=>$image,
                                        'text'=>$text,
                                        'seq'=>$seq,
                    'added_by' =>$addedby,
                    'is_active' =>1,
                    'date'=>$cur_date
                    );





                        $last_id=$this->base_model->insert_table("tbl_category", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Category/view_category", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occured');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }

                    if ($typ==2) {
                        $idw=base64_decode($iw);


                        if (!empty($image)) {
                            $n1=$image;
                        } else {
                            $this->db->select('*');
                            $this->db->from('tbl_category');
                            $this->db->where('id', $idw);
                            $dsa1= $this->db->get();
                            $da1=$dsa1->row();
                            $n1=$da1->image;
                        }

                        $data_insert = array('Title'=>$title,
                    'image'=>$n1,
                                        'text'=>$text,
                                        'seq'=>$seq

                    );

                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_category', $data_insert);

                    }
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data updated successfully');

                        redirect("dcadmin/Category/view_category", "refresh");
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



    public function update_category($idd)
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
            $this->db->from('tbl_category');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['category']=$dsa->row();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/update_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    public function delete_category($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_category', array('id' => $id));
                    $this->db->select('*');
                    $this->db->from('tbl_subcategory');
                    $this->db->like('category', $id);
                    $sub_data= $this->db->get();

                    foreach ($sub_data->result() as $subcat) {
                        $sub_delete=$this->db->delete('tbl_subcategory', array('id' => $subcat->id));
                        $this->db->select('*');
                        $this->db->from('tbl_products');
                        $this->db->like('subcategory', $subcat->id);
                        $product_data= $this->db->get();
                        foreach ($product_data->result() as $pro) {
                            $sub = json_decode($pro->subcategory);
                            $i=0;
                            foreach ($sub as $value) {
                                if ($value==$id) {
                                    $i=1;
                                }
                            }
                            if ($i==1) {
                                if (count($sub)==1) {
                                    $delete=$this->db->delete('tbl_products', array('id' => $pro->id));
                                    $delete2=$this->db->delete('tbl_type', array('product_id' => $pro->id));
                                } else {
                                    if (($key = array_search($id, $sub)) !== false) {
                                        unset($sub[$key]);
                                        $data_update = array('subcategory'=>json_encode($sub));
                                        $this->db->where('id', $pro->id);
                                        $zapak=$this->db->update('tbl_products', $data_update);
                                    }
                                }
                            }
                        }
                    }

                if ($zapak!=0) {
                $this->session->set_flashdata('smessage', 'Category deleted successfully');
                    redirect("dcadmin/Category/view_category", "refresh");
                } else {
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

// die();
//         $data['user_name']=$this->load->get_var('user_name');
//
//         // echo SITE_NAME;
//         // echo $this->session->userdata('image');
//         // echo $this->session->userdata('position');
//         // exit;
//         $id=base64_decode($idd);
//
//         if ($t=="active") {
//             $data_update = array(
//          'is_active'=>1
//
//          );
//
//             $this->db->where('id', $id);
//             $zapak=$this->db->update('tbl_category', $data_update);
//
//             if ($zapak!=0) {
//               $this->session->set_flashdata('smessage', 'status updated successfully');
//                 redirect("dcadmin/Category/view_category", "refresh");
//             } else {
//                 echo "Error";
//                 exit;
//             }
//         }
//         if ($t=="inactive") {
//             $data_update = array(
//           'is_active'=>0
//
//           );
//
//             $this->db->where('id', $id);
//             $zapak=$this->db->update('tbl_category', $data_update);
//
//             if ($zapak!=0) {
//               // $this->session->set_flashdata('smessage', 'Data updated successfully');
//                 redirect("dcadmin/Category/view_category", "refresh");
//             } else {
//                 $data['e']="Error Occured";
//                 // exit;
//                 $this->load->view('errors/error500admin', $data);
//             }
//         } else {
//             $this->load->view('admin/login/index');
//         }
    }

    public function updatecategoryStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                      'is_active'=>1

                      );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_category', $data_update);

                if ($zapak!=0) {
                  $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect("dcadmin/Category/view_category", "refresh");
                } else {
                    $data['e']="Error Occured";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
            if ($t=="inactive") {
                $data_update = array(
                      'is_active'=>0

                      );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_category', $data_update);

                if ($zapak!=0) {
                  $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect("dcadmin/Category/view_category", "refresh");
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
