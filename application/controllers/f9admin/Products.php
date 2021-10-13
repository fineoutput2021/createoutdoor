<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Products extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_products(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_products');
               //$this->db->where('id',$usr);
               $data['products_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/products/view_products');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

          public function add_products(){

                           if(!empty($this->session->userdata('admin_data'))){


                             $data['user_name']=$this->load->get_var('user_name');

                             // echo SITE_NAME;
                             // echo $this->session->userdata('image');
                             // echo $this->session->userdata('position');
$this->db->select('*');
$this->db->from('tbl_category');
//$this->db->where('id',$usr);
$data['pro']= $this->db->get();

            $this->db->select('*');
$this->db->from('tbl_subcategory');
//$this->db->where('id',$usr);
$data['s_data']= $this->db->get();

                             $this->load->view('admin/common/header_view',$data);
                             $this->load->view('admin/products/add_products');
                             $this->load->view('admin/common/footer_view');

                         }
                         else{

                            redirect("login/admin_login","refresh");
                         }

                         }

                public function update_products($idd){
                    if(!empty($this->session->userdata('admin_data'))){


                      $data['user_name']=$this->load->get_var('user_name');

                      // echo SITE_NAME;
                      // echo $this->session->userdata('image');
                      // echo $this->session->userdata('position');
                      // exit;

                       $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                             $this->db->from('tbl_products');
                             $this->db->where('id',$id);
                             $data['products_data']= $this->db->get()->row();



						            $this->db->select('*');
						$this->db->from('tbl_category');
						//$this->db->where('id',$usr);
						$data['category']= $this->db->get();

$this->db->select('*');
$this->db->from('tbl_subcategory');
//$this->db->where('id',$usr);
$data['subcategory']= $this->db->get();


                      $this->load->view('admin/common/header_view',$data);
                      $this->load->view('admin/products/update_products');
                      $this->load->view('admin/common/footer_view');

                  }
                  else{

                     redirect("login/admin_login","refresh");
                  }

                  }

              public function add_products_data($t,$iw="")

                {

                  if(!empty($this->session->userdata('admin_data'))){


              $this->load->helper(array('form', 'url'));
              $this->load->library('form_validation');
              $this->load->helper('security');
              if($this->input->post())
              {
                // print_r($this->input->post());
                // exit;
   $this->form_validation->set_rules('name', 'name', 'trim');
   $this->form_validation->set_rules('categoryname', 'categoryname', 'trim');
   $this->form_validation->set_rules('subcategoryname', 'subcategoryname', 'trim');
   $this->form_validation->set_rules('mrp', 'mrp', 'integer|trim');
   $this->form_validation->set_rules('productdescription', 'productdescription', 'trim');
   $this->form_validation->set_rules('colours', 'colours', 'trim');
   $this->form_validation->set_rules('inventory', 'inventory', 'integer|trim');






                if($this->form_validation->run()== TRUE)
                {
   $name=$this->input->post('name');
   $categoryname=$this->input->post('categoryname');
   $subcategoryname=$this->input->post('subcategoryname');
   $mrp=$this->input->post('mrp');
   $productdescription=$this->input->post('productdescription');
   $colours=$this->input->post('colours');
   $inventory=$this->input->post('inventory');


  




$this->load->library('upload');

//
 $img1='image';


            $file_check=($_FILES['image']['error']);
 if($file_check!=4){

          $image_upload_folder = FCPATH . "assets/uploads/products/";
                      if (!file_exists($image_upload_folder))
                      {
                          mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                      }
                      $new_file_name="products".date("Ymdhms");
                      $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                              'max_size'      => 25000
                      );
                      $this->upload->initialize($this->upload_config);
                      if (!$this->upload->do_upload($img1))
                      {                          $upload_error = $this->upload->display_errors();
                          // echo json_encode($upload_error);

           //$this->session->set_flashdata('emessage',$upload_error);
              //redirect($_SERVER['HTTP_REFERER']);
                      }
                      else
                      {

                          $file_info = $this->upload->data();

                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                          $file_info['new_name']=$videoNAmePath;
                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);                         $nnnn=$file_info['file_name'];
                         $nnnn1=$videoNAmePath;

                          // echo json_encode($file_info);
                      }
         }
//image end
//image1 -----
$img2='fileToUpload1';

            $file_check1=($_FILES['fileToUpload1']['error']);
            if($file_check1!=4){
          	$image_upload_folder1 = FCPATH . "assets/uploads/products/";
  						if (!file_exists($image_upload_folder1))
  						{
  							mkdir($image_upload_folder1, DIR_WRITE_MODE, true);
  						}
  						$new_file_name1="products1".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder1,
  								'file_name' => $new_file_name1,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img2))
  						{
  							$upload_error1 = $this->upload->display_errors();
  							// echo json_encode($upload_error);
  							echo $upload_error1;
  						}
  						else
  						{

  							$file_info1 = $this->upload->data();

  							$videoNAmePath1 = "assets/uploads/products/".$new_file_name1.$file_info1['file_ext'];
  							$file_info1['new_name']=$videoNAmePath1;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							$nnnn=$videoNAmePath1;
  							// echo json_encode($file_info);
  						}
            }
//image1 end code

//image2-------

$img3='fileToUpload2';

            $file_check2=($_FILES['fileToUpload2']['error']);
            if($file_check2!=4){
          	$image_upload_folder2 = FCPATH . "assets/uploads/products/";
  						if (!file_exists($image_upload_folder2))
  						{
  							mkdir($image_upload_folder2, DIR_WRITE_MODE, true);
  						}
  						$new_file_name2="products2".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder2,
  								'file_name' => $new_file_name2,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img3))
  						{
  							$upload_error2 = $this->upload->display_errors();
  							// echo json_encode($upload_error);
  							echo $upload_error2;
  						}
  						else
  						{

  							$file_info2 = $this->upload->data();

  							$videoNAmePath2 = "assets/uploads/products/".$new_file_name2.$file_info2['file_ext'];
  							$file_info2['new_name']=$videoNAmePath2;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							$nnnn2=$videoNAmePath2;
  							// echo json_encode($file_info);
  						}
            }
//image2 end-----


$img1='fileToUpload3';

            $file_check3=($_FILES['fileToUpload3']['error']);
            if($file_check3!=4){
          	$image_upload_folder3 = FCPATH . "assets/uploads/products/";
  						if (!file_exists($image_upload_folder3))
  						{
  							mkdir($image_upload_folder3, DIR_WRITE_MODE, true);
  						}
  						$new_file_name3="products3".date("Ymdhms");
  						$this->upload_config = array(
  								'upload_path'   => $image_upload_folder3,
  								'file_name' => $new_file_name3,
  								'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
  								'max_size'      => 25000
  						);
  						$this->upload->initialize($this->upload_config);
  						if (!$this->upload->do_upload($img1))
  						{
  							$upload_error3 = $this->upload->display_errors();
  							// echo json_encode($upload_error);
  							echo $upload_error3;
  						}
  						else
  						{

  							$file_info3 = $this->upload->data();

  							$videoNAmePath3 = "assets/uploads/products/".$new_file_name3.$file_info3['file_ext'];
  							$file_info3['new_name']=$videoNAmePath3;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							$nnnn3=$videoNAmePath3;
  							// echo json_encode($file_info);
  						}
            }

//image3 end


$img4='fileToUpload4';

            $file_check4=($_FILES['fileToUpload4']['error']);
            if($file_check4!=4){
          	$image_upload_folder4 = FCPATH . "assets/uploads/products/";
  						if (!file_exists($image_upload_folder4))
  						{
  							mkdir($image_upload_folder4, DIR_WRITE_MODE, true);
  						}
  						$new_file_name4="products4".date("Ymdhms");
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
  							// echo json_encode($upload_error);
  							echo $upload_error4;
  						}
  						else
  						{

  							$file_info4 = $this->upload->data();

  							$videoNAmePath4 = "assets/uploads/products/".$new_file_name4.$file_info4['file_ext'];
  							$file_info4['new_name']=$videoNAmePath4;
  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
  							$nnnn4=$videoNAmePath4;
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
                   'category_id'=>$categoryname,
                   'subcategory_id'=>$subcategoryname,

  'image'=>$nnnn1,
  'image1'=>$nnnn,
  'image2'=>$nnnn2,
  'image3'=>$nnnn3,
  'image4'=>$nnnn4,
   'mrp'=>$mrp,
  'productdescription'=>$productdescription,
   'colours'=>$colours,
   'inventry'=>$inventory,

                      'ip' =>$ip,
                     'added_by' =>$addedby,
                      'is_active' =>1,
                      'date'=>$cur_date
                      );


            $last_id=$this->base_model->insert_table("tbl_products",$data_insert,1) ;

           }
           if($typ==2){

     $idw=base64_decode($iw);

  if(!empty($nnnn1)){

    $n1=$nnnn1;

  }else{

    $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id',$idw);
                $dsa1= $this->db->get();
                $da=$dsa1->row();
              $n1=$da->image;


  }
  if(!empty($nnnn)){

    $n2=$nnnn;

  }else{

    $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id',$idw);
                $dsa1= $this->db->get();
                $da=$dsa1->row();
              $n2=$da->image1;


  }
  if(!empty($nnnn2)){

    $n3=$nnnn2;

  }else{

    $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id',$idw);
                $dsa1= $this->db->get();
                $da=$dsa1->row();
              $n3=$da->image2;


  }
  if(!empty($nnnn3)){

    $n4=$nnnn3;

  }else{

    $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id',$idw);
                $dsa1= $this->db->get();
                $da=$dsa1->row();
              $n4=$da->image3;


  }
  if(!empty($nnnn4)){

    $n5=$nnnn3;

  }else{

    $this->db->select('*');
                $this->db->from('tbl_products');
                $this->db->where('id',$idw);
                $dsa1= $this->db->get();
                $da=$dsa1->row();
              $n5=$da->image4;


  }

  $data_insert = array(
         'name'=>$name,
         'category_id'=>$categoryname,
         'subcategory_id'=>$subcategoryname,

'image'=>$n1,
'image1'=>$n2,
'image2'=>$n3,
'image3'=>$n4,
'image4'=>$n5,
'mrp'=>$mrp,
'productdescription'=>$productdescription,
'colours'=>$colours,
'inventry'=>$inventory,


            );





















              $this->db->where('id', $idw);
              $last_id=$this->db->update('tbl_products', $data_insert);
           }
                       if($last_id!=0){
                                $this->session->set_flashdata('smessage','Data inserted successfully');
                                redirect("dcadmin/products/view_products","refresh");
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

               public function updateproductsStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_products', $data_update);

                             if($zapak!=0){
                            redirect("dcadmin/products/view_products","refresh");
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
                          $zapak=$this->db->update('tbl_products', $data_update);

                            if($zapak!=0){
                              redirect("dcadmin/products/view_products","refresh");
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



                public function delete_products($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                         $data['user_name']=$this->load->get_var('user_name');

                         // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                         // echo $this->session->userdata('position');
                         // exit;
                         $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){

                     $this->db->select('image');
                      $this->db->from('tbl_products');
                      $this->db->where('id',$id);
                      $dsa= $this->db->get();
                     $da=$dsa->row();
                      $img=$da->image;

 $zapak=$this->db->delete('tbl_products', array('id' => $id));
  if($zapak!=0){
         $path = FCPATH .$img;
           unlink($path);
         redirect("dcadmin/products/view_products","refresh");
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

                             public function getSubcategory(){



                             			$id=$_GET['isl'];




                                   			$this->db->select('*');
                             $this->db->from('tbl_subcategory');
                             $this->db->where('category_id',$id);
                             $d2= $this->db->get();

                             $rees=[];
                             foreach($d2->result() as $data) {


                             $rees[] = array('sub_id' =>$data->id ,'sub_name' =>$data->name );


                             }

                             echo json_encode($rees);








                                            }




                      }
