<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class customorder extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }
           public function view_customorder(){

                            if(!empty($this->session->userdata('admin_data'))){


                              $data['user_name']=$this->load->get_var('user_name');

                              // echo SITE_NAME;
                              // echo $this->session->userdata('image');
                              // echo $this->session->userdata('position');
                              // exit;
            $this->db->select('*');
$this->db->from('tbl_customorder');
//$this->db->where('id',$usr);
$data['detail_customorder']= $this->db->get();

                              $this->load->view('admin/common/header_view',$data);
                              $this->load->view('admin/customorder/view_customorder');
                              $this->load->view('admin/common/footer_view');

                          }
                          else{

                             redirect("login/admin_login","refresh");
                          }

                          }

          public function update_customorder($idd){

                           if(!empty($this->session->userdata('admin_data'))){


                             $data['user_name']=$this->load->get_var('user_name');

                             // echo SITE_NAME;
                             // echo $this->session->userdata('image');
                             // echo $this->session->userdata('position');
                             // exit;

                              $id=base64_decode($idd);
                             $data['id']=$idd;
$this->db->select('*');
            $this->db->from('tbl_customorder');
            $this->db->where('id',$id);
            $data['data_image']= $this->db->get()->row();

                             $this->load->view('admin/common/header_view',$data);
                             $this->load->view('admin/customorder/update_customorder');
                             $this->load->view('admin/common/footer_view');

                         }
                         else{

                            redirect("login/admin_login","refresh");
                         }

                         }

                            public function add_data_customorder($t,$iw="")

                              {

                                if(!empty($this->session->userdata('admin_data'))){


                            $this->load->helper(array('form', 'url'));
                            $this->load->library('form_validation');
                            $this->load->helper('security');

                              // print_r($this->input->post());
                              // exit;


                $img1='image1';

                            $file_check=($_FILES['image1']['error']);
                            if($file_check!=4){
                          	$image_upload_folder = FCPATH . "assets/uploads/customorder/";
                  						if (!file_exists($image_upload_folder))
                  						{
                  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                  						}
                  						$new_file_name="customorder".date("Ymdhms");
                  						$this->upload_config = array(
                  								'upload_path'   => $image_upload_folder,
                  								'file_name' => $new_file_name,
                  								'allowed_types' =>'jpg|jpeg|png',
                  								'max_size'      => 25000
                  						);
                  						$this->upload->initialize($this->upload_config);
                  						if (!$this->upload->do_upload($img1))
                  						{
                  							$upload_error = $this->upload->display_errors();
                  							// echo json_encode($upload_error);
                  							echo $upload_error;
                  						}
                  						else
                  						{

                  							$file_info = $this->upload->data();

                  							$videoNAmePath = "assets/uploads/customorder/".$new_file_name.$file_info['file_ext'];
                  							$file_info['new_name']=$videoNAmePath;
                  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                  							$nnnn=$file_info['file_name'];
                                $nnnn2=$videoNAmePath;
                  							// echo json_encode($file_info);
                  						}
                            }

              $img2='image2';

                          $file_check2=($_FILES['image2']['error']);
                          if($file_check2!=4){
                        	$image_upload_folder2 = FCPATH . "assets/uploads/customorder/";
                						if (!file_exists($image_upload_folder2))
                						{
                							mkdir($image_upload_folder2, DIR_WRITE_MODE, true);
                						}
                						$new_file_name2="customorder2".date("Ymdhms");
                						$this->upload_config = array(
                								'upload_path'   => $image_upload_folder2,
                								'file_name' => $new_file_name2,
                								'allowed_types' =>'jpg|jpeg|png',
                								'max_size'      => 25000
                						);
                						$this->upload->initialize($this->upload_config);
                						if (!$this->upload->do_upload($img2))
                						{
                							$upload_error2 = $this->upload->display_errors();
                							// echo json_encode($upload_error);
                							echo $upload_error2;
                						}
                						else
                						{

                							$file_info2 = $this->upload->data();

                							$videoNAmePath2 = "assets/uploads/customorder/".$new_file_name2.$file_info2['file_ext'];
                							$file_info2['new_name']=$videoNAmePath2;
                							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                							$nnnn=$file_info2['file_name'];
                							$nnnn3=$videoNAmePath2;

                							// echo json_encode($file_info);
                						}
                          }


          $img3='image3';

                      $file_check3=($_FILES['image3']['error']);
                      if($file_check3!=4){
                    	$image_upload_folder3 = FCPATH . "assets/uploads/customorder/";
            						if (!file_exists($image_upload_folder3))
            						{
            							mkdir($image_upload_folder3, DIR_WRITE_MODE, true);
            						}
            						$new_file_name3="customorder3".date("Ymdhms");
            						$this->upload_config = array(
            								'upload_path'   => $image_upload_folder3,
            								'file_name' => $new_file_name3,
            								'allowed_types' =>'jpg|jpeg|png',
            								'max_size'      => 25000
            						);
            						$this->upload->initialize($this->upload_config);
            						if (!$this->upload->do_upload($img3))
            						{
            							$upload_error3 = $this->upload->display_errors();
            							// echo json_encode($upload_error);
            							echo $upload_error3;
            						}
            						else
            						{

            							$file_info3 = $this->upload->data();

            							$videoNAmePath3 = "assets/uploads/customorder/".$new_file_name3.$file_info3['file_ext'];
            							$file_info3['new_name']=$videoNAmePath3;
            							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
            							$nnnn33=$file_info3['file_name'];
            							$nnnn4=$videoNAmePath3;

            							// echo json_encode($file_info);
            						}
                      }

              $img1='image4';

                          $file_check4=($_FILES['image4']['error']);
                          if($file_check4!=4){
                        	$image_upload_folder4 = FCPATH . "assets/uploads/customorder/";
                						if (!file_exists($image_upload_folder4))
                						{
                							mkdir($image_upload_folder4, DIR_WRITE_MODE, true);
                						}
                						$new_file_name4="customorder".date("Ymdhms");
                						$this->upload_config = array(
                								'upload_path'   => $image_upload_folder4,
                								'file_name' => $new_file_name4,
                								'allowed_types' =>'jpg|jpeg|png',
                								'max_size'      => 25000
                						);
                						$this->upload->initialize($this->upload_config);
                						if (!$this->upload->do_upload($img1))
                						{
                							$upload_error4 = $this->upload->display_errors();
                							// echo json_encode($upload_error);
                							echo $upload_error4;
                						}
                						else
                						{

                							$file_info4 = $this->upload->data();

                							$videoNAmePath4 = "assets/uploads/customorder/".$new_file_name4.$file_info4['file_ext'];
                							$file_info4['new_name']=$videoNAmePath4;
                							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                							$nnnn=$file_info4['file_name'];
                              $nnnn5=$videoNAmePath4;
                							// echo json_encode($file_info);
                						}
                          }

                                  $ip = $this->input->ip_address();
                          date_default_timezone_set("Asia/Calcutta");
                                  $cur_date=date("Y-m-d H:i:s");

                                  $addedby=$this->session->userdata('admin_id');

                          $typ=base64_decode($t);
                          if($typ==1){

                          $data_insert = array(
                                 'image1'=>$nnnn2,
                                 'image2'=>$nnnn3,
                                 'image3'=>$nnnn4,
                                 'image4'=>$nnnn5


                                    );





                          $last_id=$this->base_model->insert_table("tbl_customorder",$data_insert,1) ;

                          }
                          if($typ==2){

                   $idw=base64_decode($iw);

                $this->db->select('*');
                            $this->db->from('tbl_customorder');
                            $this->db->where('id',$idw);
                            $dsa= $this->db->get();
                            $da=$dsa->row();
        if(!empty($nnnn2)){
          $n1=$nnnn2;

        }else{
          $n1=$da->image1;

        }
        if(!empty($nnnn3)){
          $n2=$nnnn3;
        }else{
          $n2=$da->image2;
        }
        if(!empty($nnnn4)){
          $n3=$nnnn4;
        }else{
          $n3=$da->image3;
        }
        if(!empty($nnnn5)){
          $n4=$nnnn5;
        }else{
          $n4=$da->image4;
        }

                          $data_insert = array(
                            'image1'=>$n1,
                           'image2'=>$n2,
                           'image3'=>$n3,
                           'image4'=>$n4

                                    );




                            $this->db->where('id', $idw);
                            $last_id=$this->db->update('tbl_customorder', $data_insert);

                          }


                                              if($last_id!=0){

                                              $this->session->set_flashdata('smessage','Data inserted successfully');


                                          redirect("dcadmin/customorder/view_customorder","refresh");

                                                      }

                                                      else

                                                      {

                                                   $this->session->set_flashdata('emessage','Sorry error occured');
                                                     redirect($_SERVER['HTTP_REFERER']);


                                                      }





                          }
                          else{

                      redirect("login/admin_login","refresh");


                          }

                          }

              public function delete_customorder($idd){

                     if(!empty($this->session->userdata('admin_data'))){


                       $data['user_name']=$this->load->get_var('user_name');

                       // echo SITE_NAME;
                       // echo $this->session->userdata('image');
                       // echo $this->session->userdata('position');
                       // exit;
                               									 $id=base64_decode($idd);

                      if($this->load->get_var('position')=="Super Admin"){

                  	$this->db->select('image1');
                    $this->db->from('tbl_customorder');
                    $this->db->where('id',$id);
                    $dsa= $this->db->get();
                    $da=$dsa->row();
                    $img=$da->image;

                                       									 $zapak=$this->db->delete('tbl_customorder', array('id' => $id));
                                       									 if($zapak!=0){
                                 $path = FCPATH . "assets/public/slider/".$img;
                                       										 unlink($path);
                                       								 	redirect("dcadmin/customorder/view_customorder","refresh");
                                       								 					}
                                       								 					else
                                       								 					{
                                       								 						echo "Error";
                                       								 						exit;
                                       								 					}
                                     }
                                     else{
                                     $data['e']="Sorry You Don't Have Permission To Delete Anything.";
                                     	// exit;
                                     	$this->load->view('errors/error500admin',$data);
                                     }


                           }
                           else{

                               $this->load->view('admin/login/index');
                           }

                           }


}
?>
