<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Stock extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_stock(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_stock');
               //$this->db->where('id',$usr);
               $data['stock_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/stock/view_stock');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_stock(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/stock/add_stock');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_stock($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_stock');
                            $this->db->where('id',$id);
                            $data['stock_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/stock/update_stock');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_stock_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('title', 'title', 'required');
  $this->form_validation->set_rules('description', 'description', 'required');





               if($this->form_validation->run()== TRUE)
               {
  $title=$this->input->post('title');
  $description=$this->input->post('description');
  $this->load->library('upload');

$img1='image1';

            $file_check=($_FILES['image1']['error']);
            if($file_check!=4){
          	$image_upload_folder = FCPATH . "assets/uploads/stock/";
  						if (!file_exists($image_upload_folder))
  						{
  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
  						}
  						$new_file_name="stock".date("Ymdhms");
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

  						$file_info1 = $this->upload->data();
              // print_r(	$file_info1);

  							$videoNAmePath1 = "assets/uploads/stock/".$new_file_name.$file_info1['file_ext'];
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							$nnnn=$videoNAmePath1;
  							// echo json_encode($file_info);
  						}
            }
$img2='image2';

            $file_check=($_FILES['image2']['error']);
            if($file_check!=4){
          	$image_upload_folder = FCPATH . "assets/uploads/stock/";
  						if (!file_exists($image_upload_folder))
  						{
  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
  						}
  						$new_file_name1="stock1".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder,
  								'file_name' => $new_file_name1,
  								'allowed_types' =>'jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img2))
  						{
  							$upload_error = $this->upload->display_errors();
  							// echo json_encode($upload_error);
  							echo $upload_error;
  						}
  						else
  						{

  							$file_info = $this->upload->data();

  							$videoNAmePath1 = "assets/uploads/stock/".$new_file_name1.$file_info['file_ext'];
                // print_r(	$file_info);


  							$nnnn1=$videoNAmePath1;
  							// echo json_encode($file_info);
  						}
            }
// echo $nnnn;
// echo $nnnn1;    exit;
                     $ip = $this->input->ip_address();
                     date_default_timezone_set("Asia/Calcutta");
                     $cur_date=date("Y-m-d H:i:s");
                     $addedby=$this->session->userdata('admin_id');

                     $typ=base64_decode($t);
                     $last_id = 0;
                     if($typ==1){



           $data_insert = array(
                  'image'=>$nnnn,
                  'back_image'=>$nnnn1,
  'title'=>$title,
  'description'=>$description,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );
// print_r($data_insert);
// exit;

           $last_id=$this->base_model->insert_table("tbl_stock",$data_insert,1) ;

           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_stock');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();


if(!empty($nnnn)){
  $n1=$nnnn;
}else{
    $n1=$da->image;
}
if(!empty($nnnn1)){
  $n2=$nnnn1;
}else{
    $n2=$da->back_image;
}
           $data_insert = array(
                  'image'=>$n1,
                  'image'=>$n2,
  'title'=>$title,
  'description'=>$description,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_stock', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data inserted successfully');
                               redirect("dcadmin/stock/view_stock","refresh");
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

               public function updatestockStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_stock', $data_update);

                            if($zapak!=0){
                            redirect("dcadmin/stock/view_stock","refresh");
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
                         $zapak=$this->db->update('tbl_stock', $data_update);

                             if($zapak!=0){
                             redirect("dcadmin/stock/view_stock","refresh");
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



               public function delete_stock($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                     $this->db->from('tbl_stock');
                     $this->db->where('id',$id);
                     $dsa= $this->db->get();
                     $da=$dsa->row();
                     $img=$da->image;

 $zapak=$this->db->delete('tbl_stock', array('id' => $id));
 if($zapak!=0){
        $path = FCPATH .$img;
          unlink($path);
        redirect("dcadmin/stock/view_stock","refresh");
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
