<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Chair extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_chair(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_chair');
               //$this->db->where('id',$usr);
               $data['chair_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/chair/view_chair');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_chair(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/chair/add_chair');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_chair($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_chair');
                            $this->db->where('id',$id);
                            $data['chair_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/chair/update_chair');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_chair_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('name', 'name', 'required');





               if($this->form_validation->run()== TRUE)
               {
  $name=$this->input->post('name');


  $img1='image1';

              $file_check=($_FILES['image1']['error']);
              if($file_check!=4){
            	$image_upload_folder = FCPATH . "assets/uploads/chair/";
    						if (!file_exists($image_upload_folder))
    						{
    							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
    						}
    						$new_file_name="chair".date("Ymdhms");
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

    							$videoNAmePath = "assets/uploads/chair/".$new_file_name.$file_info['file_ext'];
    							$file_info['new_name']=$videoNAmePath;
    							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
    							$nnnn=$file_info['file_name'];
    							$nnnn1=$videoNAmePath;

    							// echo json_encode($file_info);
    						}
              }



    $img2='Image2';

                $file_check2=($_FILES['Image2']['error']);
                if($file_check2!=4){
              	$image_upload_folder2 = FCPATH . "assets/uploads/chair/";
      						if (!file_exists($image_upload_folder2))
      						{
      							mkdir($image_upload_folder2, DIR_WRITE_MODE, true);
      						}
      						$new_file_name2="chair2".date("Ymdhms");
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

      							$videoNAmePath2 = "assets/uploads/chair/".$new_file_name2.$file_info2['file_ext'];
      							$file_info2['new_name']=$videoNAmePath2;
      							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
      							$nnnn=$file_info2['file_name'];
      							$nnnn2=$videoNAmePath2;

      							// echo json_encode($file_info);
      						}
                }

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');




$typ=base64_decode($t);
$last_id = 0;
if($typ==1){



           $data_insert = array(
                  'name'=>$name,
  'image1'=>$nnnn1,
  'Image2'=>$nnnn2,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_chair",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_chair');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();

if(!empty($nnnn1)){
  $n1=$nnnn1;
}else{
  $n1=$da->image1;
}

if(!empty($nnnn2)){
  $n2=$nnnn2;
}else{
  $n2=$da->Image2;
}


           $data_insert = array(
                  'name'=>$name,
  'image1'=>$n1,
  'Image2'=>$n2,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_chair', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/chair/view_chair","refresh");
                              }
                               else
                                   {

                                    $this->session->set_flashdata('emessage','Sorry error occured');
                                    redirect($_SERVER['HTTP_REFERER']);
                                  }
               }
             else{

        $this->session->set_flashdata('emessage',validation_errors());
      redirect($_SERVER['HTTP_REFERER']);

             }

             }
           else{

 $this->session->set_flashdata('emessage','Please insert some data, No data available');
      redirect($_SERVER['HTTP_REFERER']);

           }
           }
           else{

       redirect("login/admin_login","refresh");


           }

           }

               public function updatechairStatus($idd,$t){

                        if(!empty($this->session->userdata('admin_data'))){


                          $data['user_name']=$this->load->get_var('user_name');

                          // echo SITE_NAME;
                          // echo $this->session->userdata('image');
                          // echo $this->session->userdata('position');
                          // exit;
                          $id=base64_decode($idd);

                          if($t=="active"){

                            $data_update = array(
                        'is_active'=>1

                        );

                        $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_chair', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/chair/view_chair","refresh");
                                    }
                                    else
                                    {
        $this->session->set_flashdata('emessage','Sorry error occured');
          redirect($_SERVER['HTTP_REFERER']);
                                    }
                          }
                          if($t=="inactive"){
                            $data_update = array(
                         'is_active'=>0

                         );

                         $this->db->where('id', $id);
                         $zapak=$this->db->update('tbl_chair', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/chair/view_chair","refresh");
                                     }
                                     else
                                     {

                $this->session->set_flashdata('emessage','Sorry error occured');
                  redirect($_SERVER['HTTP_REFERER']);
                                     }
                          }



                      }
                      else{

                         redirect("login/admin_login","refresh");

                      }

                      }



               public function delete_chair($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image1');
                     $this->db->from('tbl_chair');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image1;

 $zapak=$this->db->delete('tbl_chair', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/chair/view_chair","refresh");
                }
                else
                {
                   $this->session->set_flashdata('emessage','Sorry error occured');
                   redirect($_SERVER['HTTP_REFERER']);
                }
            }
            else{
             $this->session->set_flashdata('emessage','Sorry you not a super admin you dont have permission to delete anything');
               redirect($_SERVER['HTTP_REFERER']);
            }


                            }
                            else{

                        redirect("login/admin_login","refresh");

                            }

                            }
                      }

      ?>
