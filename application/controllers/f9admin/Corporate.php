<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Corporate extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }
           public function view_corporate()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $this->db->select('*');
                   $this->db->from('tbl_customorder');
                   $this->db->order_by('id', 'desc');
                   $data['detail_corporate']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/view_corporate');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function update_corporate($idd)
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
                   $this->db->from('tbl_corporate');
                   $this->db->where('id', $id);
                   $data['data_image']= $this->db->get()->row();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/update_corporate');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_data_corporate($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');


                   if ($this->input->post()) {
                       $this->form_validation->set_rules('firstname', 'firstname', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('lastname', 'lastname', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('businessname', 'businessname', 'required|xss_clean|trim');
                       $this->form_validation->set_rules('email', 'email', 'valid_email|xss_clean|trim');
                       $this->form_validation->set_rules('message', 'message', 'xss_clean|trim');

                       // print_r($this->input->post());
                       // exit;
                       if ($this->form_validation->run()== true) {
                           $firstname=$this->input->post('firstname');
                           $lastname=$this->input->post('lastname');
                           $businessname=$this->input->post('businessname');
                           $email=$this->input->post('email');
                           $message=$this->input->post('message');




                           $img1='image1';

                           $file_check=($_FILES['image1']['error']);
                           if ($file_check!=4) {
                               $image_upload_folder = FCPATH . "assets/uploads/corporate/";
                               if (!file_exists($image_upload_folder)) {
                                   mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                               }
                               $new_file_name="corporate".date("Ymdhms");
                               $this->upload_config = array(
                                                                  'upload_path'   => $image_upload_folder,
                                                                  'file_name' => $new_file_name,
                                                                  'allowed_types' =>'jpg|jpeg|png',
                                                                  'max_size'      => 25000
                                                          );
                               $this->upload->initialize($this->upload_config);
                               if (!$this->upload->do_upload($img1)) {
                                   $upload_error = $this->upload->display_errors();
                                   // echo json_encode($upload_error);
                                   $this->session->set_flashdata('emessage', $upload_error);
                                   redirect($_SERVER['HTTP_REFERER']);
                               } else {
                                   $file_info = $this->upload->data();

                                   $videoNAmePath = "assets/uploads/corporate/".$new_file_name.$file_info['file_ext'];
                                   $file_info['new_name']=$videoNAmePath;
                                   // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                   $nnnn=$file_info['file_name'];
                                   $nnnn2=$videoNAmePath;
                                   // echo json_encode($file_info);
                               }
                           }


                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");

                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           if ($typ==1) {
                               $data_insert = array(
                                            'firstname'=>$firstname,
                                            'lastname'=>$lastname,
                                            'businessname'=>$businessname,
                                            'email'=>$email,
                                            'message'=>$message,
                                                 'image1'=>$nnnn2,



                                                    );





                               $last_id=$this->base_model->insert_table("tbl_corporate", $data_insert, 1) ;
                               $this->session->set_flashdata('smessage', 'Data inserted successfully');
                               redirect("dcadmin/corporate/view_corporate", "refresh");
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);

                               $this->db->select('*');
                               $this->db->from('tbl_corporate');
                               $this->db->where('id', $idw);
                               $dsa= $this->db->get();
                               $da=$dsa->row();
                               if (!empty($nnnn2)) {
                                   $n1=$nnnn2;
                               } else {
                                   $n1=$da->image1;
                               }

                               $data_insert = array(
                                            'firstname'=>$firstname,
                                            'lastname'=>$lastname,
                                            'businessname'=>$businessname,
                                            'email'=>$email,
                                            'message'=>$message,
                                            'image1'=>$n1,

                                                    );




                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_corporate', $data_insert);
                           }


                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');
                               redirect("dcadmin/corporate/view_corporate", "refresh");
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

           public function delete_corporate($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);

                   if ($this->load->get_var('position')=="Super Admin") {
                       $this->db->select('image1');
                       $this->db->from('tbl_corporate');
                       $this->db->where('id', $id);
                       $dsa= $this->db->get();
                       $da=$dsa->row();
                       $img=$da->image1;

                       $zapak=$this->db->delete('tbl_corporate', array('id' => $id));
                       if ($zapak!=0) {
                           // $path = FCPATH . $img;
                           // unlink($path);
                           $this->session->set_flashdata('smessage', 'Corporate Data deleted successfully');
                           redirect("dcadmin/corporate/view_corporate", "refresh");
                       } else
                       {
                          $this->session->set_flashdata('emessage','Some unknown error occured');
                          redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
                   else{
                     $this->session->set_flashdata('emessage','Sorry you dont have permisssion to delete anything');
                     redirect($_SERVER['HTTP_REFERER']);
                   }
                 }
                   else{
                    $this->session->set_flashdata('emessage','Sorry you not a super admin you dont have permission to delete anything');
                      redirect($_SERVER['HTTP_REFERER']);
                   }
       }


           public function updatecorporateStatus($idd, $t)
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

                       $zapak=$this->db->update('tbl_corporate', $data_update);

                       if ($zapak!=0) {
                          $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/corporate/view_corporate", "refresh");
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
                       $zapak=$this->db->update('tbl_corporate', $data_update);

                       if ($zapak!=0) {
                         $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/corporate/view_corporate", "refresh");
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

           public function view_brochers()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $this->db->select('*');
                   $this->db->from('tbl_corporate_brochers');
                   //$this->db->where('_id',$id);
                   $data['view_brochers']= $this->db->get();


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/view_brochers');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_brochers()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/add_brochers');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_brochers_data($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;
                       $this->form_validation->set_rules('title', 'title', 'required|xss_clean|trim');


                       if ($this->form_validation->run()== true) {
                           $title=$this->input->post('title');


                           $file1='fileToUpload1';

                           $file_check=($_FILES['fileToUpload1']['error']);
                           if ($file_check!=4) {
                               $image_upload_folder = FCPATH . "assets/uploads/file/";
                               if (!file_exists($image_upload_folder)) {
                                   mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                               }
                               $new_file_name="file".date("Ymdhms");
                               $this->upload_config = array(
                                                                  'upload_path'   => $image_upload_folder,
                                                                  'file_name' => $new_file_name,
                                                                  'allowed_types' =>'pdf',
                                                                  'max_size'      => 25000
                                                          );
                               $this->upload->initialize($this->upload_config);
                               if (!$this->upload->do_upload($file1)) {
                                   $upload_error = $this->upload->display_errors();
                                   // echo json_encode($upload_error);
                                   echo $upload_error;
                               } else {
                                   $file_info = $this->upload->data();

                                   $videoNAmePath = "assets/uploads/file/".$new_file_name.$file_info['file_ext'];
                                   $file_info['new_name']=$videoNAmePath;
                                   // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                   $nnnn=$file_info['file_name'];
                                   $nnnn5=$videoNAmePath;

                                   // echo json_encode($file_info);
                               }
                           }

                           $img2='fileToUpload2';

                           $file_check2=($_FILES['fileToUpload2']['error']);
                           if ($file_check2!=4) {
                               $image_upload_folder2 = FCPATH . "assets/uploads/corporate_brochers_image/";
                               if (!file_exists($image_upload_folder2)) {
                                   mkdir($image_upload_folder2, DIR_WRITE_MODE, true);
                               }
                               $new_file_name2="corporate_brochers_image".date("Ymdhms");
                               $this->upload_config = array(
                                                                              'upload_path'   => $image_upload_folder2,
                                                                              'file_name' => $new_file_name2,
                                                                              'allowed_types' =>'jpg|jpeg|png',
                                                                              'max_size'      => 25000
                                                                      );
                               $this->upload->initialize($this->upload_config);
                               if (!$this->upload->do_upload($img2)) {
                                   $upload_error2 = $this->upload->display_errors();
                                   // echo json_encode($upload_error);
                                   echo $upload_error2;
                                   exit;
                               } else {
                                   $file_info2 = $this->upload->data();

                                   $videoNAmePath2 = "assets/uploads/corporate_brochers_image/".$new_file_name2.$file_info2['file_ext'];
                                   $file_info2['new_name']=$videoNAmePath2;
                                   // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                   //$nnnn=$file_info['file_name'];
                                   $nnnn2=$videoNAmePath2;
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
                                                      'file'=>$nnnn5,
                                                      'image'=>$nnnn2,
                                                        'ip' =>$ip,
                                                        'added_by' =>$addedby,
                                                        'is_active' =>1,
                                                        'date'=>$cur_date

                                                        );





                               $last_id=$this->base_model->insert_table("tbl_corporate_brochers", $data_insert, 1) ;
                               $this->session->set_flashdata('smessage', 'Data inserted successfully');
                                redirect("dcadmin/corporate/view_brochers", "refresh");
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

                               if (!empty($nnnn5)) {
                                   $n1=$nnnn5;
                               } else {
                                   $this->db->select('*');
                                   $this->db->from('tbl_corporate_brochers');
                                   $this->db->where('id', $idw);
                                   $dsa= $this->db->get()->row();
                                   $n1=$dsa->file;
                               }
                               if (!empty($nnnn2)) {
                                   $n2=$nnnn2;
                               } else {
                                   $this->db->select('*');
                                   $this->db->from('tbl_corporate_brochers');
                                   $this->db->where('id', $idw);
                                   $dsa= $this->db->get()->row();
                                   $n2=$dsa->image;
                               }

                               $data_insert = array('title'=>$title,
                                                  'file'=>$n1,
                                                  'image'=>$n2

                                                        );




                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_corporate_brochers', $data_insert);
                           }


                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');

                               redirect("dcadmin/corporate/view_brochers", "refresh");
                           } else{
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
           public function download_file($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);
                   $this->db->select('*');
                   $this->db->from('tbl_corporate_brochers');
                   $this->db->where('id', $id);
                   $dsa= $this->db->get();
                   $da=$dsa->row();

                   $file_url = base_url().$da->file ;

                   header('Content-Type: application/octet-stream');
                   header("Content-Transfer-Encoding: Binary");
                   header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
                   readfile($file_url);

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('dcadmin/corporate/view_corporate');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function delete_brochers($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);

                   if ($this->load->get_var('position')=="Super Admin") {
                       $this->db->select('file', 'image');
                       $this->db->from('tbl_corporate_brochers');
                       $this->db->where('id', $id);
                       $dsa= $this->db->get();
                       $da=$dsa->row();
                       $img=$da->file;

                       $zapak=$this->db->delete('tbl_corporate_brochers', array('id' => $id));
                       if ($zapak!=0) {
                           $path = FCPATH . $img;
                           unlink($path);
                           redirect("dcadmin/corporate/view_corporate", "refresh");
                       } else {
                           $this->session->set_flashdata('emessage','Some unknown error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    else{
                      $this->session->set_flashdata('emessage','Sorry you dont have permisssion to delete anything');
                      redirect($_SERVER['HTTP_REFERER']);
                    }
                  }
                    else{
                     $this->session->set_flashdata('emessage','Sorry you not a super admin you dont have permission to delete anything');
                       redirect($_SERVER['HTTP_REFERER']);
                    }
        }
           public function add_corporate()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/add_corporate');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function update_brochers($idd)
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
                   $this->db->from('tbl_corporate_brochers');
                   $this->db->where('id', $id);
                   $dsa= $this->db->get();
                   $data['brochers_data']=$dsa->row();




                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/corporate/update_brochers');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
       }
