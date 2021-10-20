<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'core/CI_finecontrol.php');
class Banners extends CI_finecontrol{
function __construct()
		{
			parent::__construct();
			$this->load->model("login_model");
			$this->load->model("admin/base_model");
			$this->load->library('user_agent');
		}


    public function view_banners(){

                     if(!empty($this->session->userdata('admin_data'))){


                       $data['user_name']=$this->load->get_var('user_name');

                       // echo SITE_NAME;
                       // echo $this->session->userdata('image');
                       // echo $this->session->userdata('position');
                       // exit;

											       			$this->db->select('*');
											 $this->db->from('tbl_bannerimages');
											 //$this->db->where('id',$usr);
											 $data['banner_data']= $this->db->get();


                       $this->load->view('admin/common/header_view',$data);
                       $this->load->view('admin/banners/view_banners');
                       $this->load->view('admin/common/footer_view');

                   }
                   else{

                      redirect("login/admin_login","refresh");
                   }

                   }

public function add_banners(){

                 if(!empty($this->session->userdata('admin_data'))){


                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $this->load->view('admin/common/header_view',$data);
                   $this->load->view('admin/banners/add_banners');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

      			public function add_banner_data($t,$iw="")

              {

                if(!empty($this->session->userdata('admin_data'))){


          	$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if($this->input->post())
            {

              $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
              $this->form_validation->set_rules('url', 'url', 'required|xss_clean|trim');

              if($this->form_validation->run()== TRUE)
              {
                $url=$this->input->post('url');
                $name=$this->input->post('name');


								// Load library
								$this->load->library('upload');
								//image 1

								$img1='banner_image';

								            $file_check=($_FILES['banner_image']['error']);
								            if($file_check!=4){
								          	$image_upload_folder = FCPATH . "assets/uploads/banner/";
								  						if (!file_exists($image_upload_folder))
								  						{
								  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
								  						}
								  						$new_file_name="banner".date("Ymdhms");
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

								  							echo json_encode($upload_error);
																$this->session->set_flashdata('emessage',$upload_error);
																	redirect($_SERVER['HTTP_REFERER']);
								  						}
								  						else
								  						{

								  							$file_info = $this->upload->data();

								  							$image = "assets/uploads/banner/".$new_file_name.$file_info['file_ext'];
								  							// $file_info['new_name']=$videoNAmePath;
								  							// // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
								  							// $nn=$file_info['file_name'];
								  							// echo json_encode($file_info);
								  						}
								            }

                  // $banner = time() . '_' . $_FILES["banner_image"]["name"];
					        // $liciense_tmp_name = $_FILES["banner_image"]["tmp_name"];
					        // $error = $_FILES["banner_image"]["error"];
					        // $liciense_path = 'assets/admin/banner/' . $banner;
					        // move_uploaded_file($liciense_tmp_name, $liciense_path);
					        // $image = $liciense_path;

//image 2
$img2='image2';

            $file_check2=($_FILES['image2']['error']);
            if($file_check2!=4){
          	$image_upload_folder2 = FCPATH . "assets/uploads/banner/";
  						if (!file_exists($image_upload_folder2))
  						{
  							mkdir($image_upload_folder2, DIR_WRITE_MODE, true);
  						}
  						$new_file_name2="banner2".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder2,
  								'file_name' => $new_file_name2,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png|psd',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img2))
  						{
  							$upload_error2 = $this->upload->display_errors();
  							echo json_encode($upload_error);
								$this->session->set_flashdata('emessage',$upload_error);
									redirect($_SERVER['HTTP_REFERER']);

  						}
  						else
  						{

  							$file_info2 = $this->upload->data();

  							$videoNAmePath = "assets/uploads/banner/".$new_file_name2.$file_info2['file_ext'];
  							$file_info2['new_name']=$videoNAmePath;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							//$nnnn=$file_info['file_name'];
								$nnnn2=$videoNAmePath;
  							// echo json_encode($file_info);
  						}
            }


		//image3----------------

		$img3='image3';

		            $file_check3=($_FILES['image3']['error']);
		            if($file_check3!=4){
		          	$image_upload_folder3 = FCPATH . "assets/uploads/banner/";
		  						if (!file_exists($image_upload_folder3))
		  						{
		  							mkdir($image_upload_folder3, DIR_WRITE_MODE, true);
		  						}
		  						$new_file_name3="banner3".date("Ymdhms");
		  						$this->upload_config = array(
		  								'upload_path'   => $image_upload_folder3,
		  								'file_name' => $new_file_name3,
		  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
		  								'max_size'      => 25000
		  						);
		  						$this->upload->initialize($this->upload_config);
		  						if (!$this->upload->do_upload($img3))
		  						{
		  							$upload_error3 = $this->upload->display_errors();
		  							 echo json_encode($upload_error);
										 $this->session->set_flashdata('emessage',$upload_error);
											 redirect($_SERVER['HTTP_REFERER']);

		  						}
		  						else
		  						{

		  							$file_info3 = $this->upload->data();

		  							$videoNAmePath3 = "assets/uploads/banner/".$new_file_name3.$file_info3['file_ext'];
		  							$file_info['new_name']=$videoNAmePath3;
		  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
		  							$nnnn=$file_info3['file_name'];
										$nnnn3=$videoNAmePath3;
		  							// echo json_encode($file_info);
		  						}
		            }


//image4-------------
$img4='image4';

            $file_check4=($_FILES['image4']['error']);
            if($file_check4!=4){
          	$image_upload_folder4 = FCPATH . "assets/uploads/banner/";
  						if (!file_exists($image_upload_folder4))
  						{
  							mkdir($image_upload_folder4, DIR_WRITE_MODE, true);
  						}
  						$new_file_name4="banner4".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder4,
  								'file_name' => $new_file_name4,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img4))
  						{
  							$upload_error4 = $this->upload->display_errors();
  							 echo json_encode($upload_error);
								 $this->session->set_flashdata('emessage',$upload_error);
									 redirect($_SERVER['HTTP_REFERER']);

  						}
  						else
  						{

  							$file_info4 = $this->upload->data();

  							$videoNAmePath4 = "assets/uploads/banner/".$new_file_name4.$file_info4['file_ext'];
  							$file_info4['new_name']=$videoNAmePath4;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							//	$nnnn4=$file_info4['file_name'];
								$nnnn5=$videoNAmePath4;
  							// echo json_encode($file_info);
  						}
            }
//image5-------------------

$img5='image5';

            $file_check5=($_FILES['image5']['error']);
            if($file_check5!=4){
          	$image_upload_folder5 = FCPATH . "assets/uploads/banner/";
  						if (!file_exists($image_upload_folder5))
  						{
  							mkdir($image_upload_folder5, DIR_WRITE_MODE, true);
  						}
  						$new_file_name5="banner5".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder5,
  								'file_name' => $new_file_name5,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img5))
  						{
  							$upload_error5 = $this->upload->display_errors();
  						 echo json_encode($upload_error);
							 $this->session->set_flashdata('emessage',$upload_error);
								 redirect($_SERVER['HTTP_REFERER']);

  						}
  						else
  						{

  							$file_info5 = $this->upload->data();

  							$videoNAmePath5 = "assets/uploads/banner/".$new_file_name5.$file_info5['file_ext'];
  							$file_info5['new_name']=$videoNAmePath5;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							//$nnnn=$file_info5['file_name'];
  							// echo json_encode($file_info);
								$nnnn6=$videoNAmePath5;
  						}
            }


                  $ip = $this->input->ip_address();
          date_default_timezone_set("Asia/Calcutta");
                  $cur_date=date("Y-m-d H:i:s");

                  $addedby=$this->session->userdata('admin_id');

          $typ=base64_decode($t);
          if($typ==1){

          $data_insert = array(
                     'imagename'=>$name,
										 'url'=>$url,
                    'image1'=>$image,
                    'image2'=>$nnnn2,
                    'image3'=>$nnnn3,
                    'image4'=>$nnnn5,
										'image5'=>$nnnn6,


                    'added_by' =>$addedby,
										'ip'=> $ip,
                    'is_active' =>1,
                    'date'=>$cur_date
                    );





          $last_id=$this->base_model->insert_table("tbl_bannerimages",$data_insert,1) ;

          }
          if($typ==2){

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


if(!empty($image)){
	$n1=$image;

}else{
	$this->db->select('*');
	            $this->db->from('tbl_bannerimages');
	            $this->db->where('id',$idw);
	            $i1= $this->db->get();
	            $d1=$i1->row();
	            $n1=$d1->image1;

}


if(!empty($nnnn2)){
	$n2=$nnnn2;

}else{
	$this->db->select('*');
	            $this->db->from('tbl_bannerimages');
	            $this->db->where('id',$idw);
	            $i1= $this->db->get();
	            $d1=$i1->row();
	            $n2=$d1->image2;

}


if(!empty($nnnn3)){
	$n3=$nnnn3;

}else{
	$this->db->select('*');
	            $this->db->from('tbl_bannerimages');
	            $this->db->where('id',$idw);
	            $i1= $this->db->get();
	            $d1=$i1->row();
	            $n3=$d1->image3;

}


if(!empty($nnnn5)){
	$n4=$nnnn5;

}else{
	$this->db->select('*');
	            $this->db->from('tbl_bannerimages');
	            $this->db->where('id',$idw);
	            $i1= $this->db->get();
	            $d1=$i1->row();
	            $n4=$d1->image4;

}

if(!empty($nnnn6)){
	$n5=$nnnn6;

}else{
	$this->db->select('*');
	            $this->db->from('tbl_bannerimages');
	            $this->db->where('id',$idw);
	            $i1= $this->db->get();
	            $d1=$i1->row();
	            $n5=$d1->image5;

}

          $data_insert = array(

										'imagename'=>$name,
										'url'=>$url,
										'image1'=>$n1,
                    'image2'=>$n2,
                    'image3'=>$n3,
                    'image4'=>$n4,
										'image5'=>$n5,
                    );




          	$this->db->where('id', $idw);
            $last_id=$this->db->update('tbl_bannerimages', $data_insert);

          }


                              if($last_id!=0){

                              $this->session->set_flashdata('smessage','Data inserted successfully');

                              redirect("dcadmin/banners/view_banners","refresh");

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


					public function update_banners($idd){

					                 if(!empty($this->session->userdata('admin_data'))){


					                   $data['user_name']=$this->load->get_var('user_name');

					                   // echo SITE_NAME;
					                   // echo $this->session->userdata('image');
					                   // echo $this->session->userdata('position');
					                   // exit;

														  $id=base64_decode($idd);
														 $data['id']=$idd;

														 $this->db->select('*');
														             $this->db->from('tbl_bannerimages');
														             $this->db->where('id',$id);
														             $dsa= $this->db->get();
														             $data['banner']=$dsa->row();


					                   $this->load->view('admin/common/header_view',$data);
					                   $this->load->view('admin/banners/update_banners');
					                   $this->load->view('admin/common/footer_view');

					               }
					               else{

					                  redirect("login/admin_login","refresh");
					               }

					               }

public function delete_banners($idd){

       if(!empty($this->session->userdata('admin_data'))){


         $data['user_name']=$this->load->get_var('user_name');

         // echo SITE_NAME;
         // echo $this->session->userdata('image');
         // echo $this->session->userdata('position');
         // exit;
                 									 $id=base64_decode($idd);

        if($this->load->get_var('position')=="Super Admin"){



                         									 $zapak=$this->db->delete('tbl_bannerimages', array('id' => $id));
                         									 if($zapak!=0){

                         								 	redirect("dcadmin/banners/view_banners","refresh");
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


public function updatebannersStatus($idd,$t){

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
        $zapak=$this->db->update('tbl_bannerimages', $data_update);

             if($zapak!=0){
             redirect("dcadmin/banners/view_banners","refresh");
                     }
                     else
                     {
                       echo "Error";
                       exit;
                     }
           }
           if($t=="inactive"){
             $data_update = array(
          'is_active'=>0

          );

          $this->db->where('id', $id);
          $zapak=$this->db->update('tbl_bannerimages', $data_update);

              if($zapak!=0){
              redirect("dcadmin/banners/view_banners","refresh");
                      }
                      else
                      {

          $data['e']="Error Occured";
                          	// exit;
        	$this->load->view('errors/error500admin',$data);
                      }
           }



       }
       else{

           $this->load->view('admin/login/index');
       }

       }



}
