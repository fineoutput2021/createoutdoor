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
   $this->form_validation->set_rules('name', 'name', 'required|trim');
   $this->form_validation->set_rules('categoryname', 'categoryname', 'required|trim');
   $this->form_validation->set_rules('subcategoryname', 'subcategoryname', 'required|trim');
   $this->form_validation->set_rules('mrp', 'mrp', 'required|trim');
   $this->form_validation->set_rules('productdescription', 'productdescription', 'required|trim');
   $this->form_validation->set_rules('colours', 'colours', 'required|trim');
   $this->form_validation->set_rules('inventory', 'inventory', 'required|trim');





                if($this->form_validation->run()== TRUE)
                {
   $name=$this->input->post('name');
   $categoryname=$this->input->post('categoryname');
   $subcategoryname=$this->input->post('subcategoryname');
   $mrp=$this->input->post('mrp');
   $productdescription=$this->input->post('productdescription');
   $colours=$this->input->post('colours');
   $inventory=$this->input->post('inventory');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $addedby=$this->session->userdata('admin_id');

            $typ=base64_decode($t);
            $last_id = 0;
            if($typ==1){


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



            $data_insert = array(
                   'name'=>$name,
                   'category_id'=>$categoryname,
                   'subcategory_id'=>$subcategoryname,

  'image'=>$nnnn1,
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


  $this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->where('id',$idw);
  $dsa=$this->db->get();
  $da=$dsa->row();



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
                      {
                          $upload_error = $this->upload->display_errors();
                          // echo json_encode($upload_error);

            //$this->session->set_flashdata('emessage',$upload_error);
              //redirect($_SERVER['HTTP_REFERER']);
                      }
                      else
                      {

                          $file_info = $this->upload->data();

                          $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                          $file_info['new_name']=$videoNAmePath;
                          // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                          $nnnn=$file_info['file_name'];
                          $nnnn1=$videoNAmePath;

                          // echo json_encode($file_info);
                      }
         }



 if(!empty($da)){ $img = $da ->image;
 if(!empty($img)) { if(empty($nnnn1)){ $nnnn1 = $img; } }else{ if(empty($nnnn1)){ $nnnn1= ""; } } }

            $data_insert = array(
                   'name'=>$name,
                   'category_id'=>$categoryname,
                   'subcategory_id'=>$subcategoryname,
   'image'=>$nnnn1,
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
                      }
