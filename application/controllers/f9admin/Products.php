<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Products extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }

           public function view_products()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;

                   $this->db->select('*');
                   $this->db->from('tbl_products');
                   $this->db->order_by('id', 'desc');
                   $data['products_data']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/products/view_products');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_products()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   $this->db->where('is_active', 1);
                   $data['category_data']= $this->db->get();

                   $this->db->select('*');
                   $this->db->from('tbl_subcategory');
                   //$this->db->where('id',$usr);
                   $data['subcategory_data']= $this->db->get();
                   //filter

                   $this->db->select('*');
                   $this->db->from('tbl_leadtime');
                   //$this->db->where('id',$usr);
                   $data['leadtime_data']= $this->db->get();
                   //filter

                   $this->db->select('*');
                   $this->db->from('tbl_seating');
                   //$this->db->where('id',$usr);
                   $data['seating_data']= $this->db->get();
                   //filter

                   $this->db->select('*');
                   $this->db->from('tbl_tableshape');
                   //$this->db->where('id',$usr);
                   $data['shape_data']= $this->db->get();
                   //filter
                   $this->db->select('*');
                   $this->db->from('tbl_furnituretype');
                   //$this->db->where('id',$usr);
                   $data['furniture_type']= $this->db->get();
                   // filter

                   $this->db->select('*');
                   $this->db->from('tbl_table_feature');
                   //$this->db->where('id',$usr);
                   $data['feature_data']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/products/add_products');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function getSubcategory()
           {

                   // $data['user_name']=$this->load->get_var('user_name');

               // echo SITE_NAME;
               // echo $this->session->userdata('image');
               // echo $this->session->userdata('position');
               // exit;

               //$id=$_GET['isl'];
               $id=$_POST['ids'];
               $new_var=count($id);
//
               // $arrd=impload(',',$id.ids);
               // echo $arrd;

               $this->db->select('*');
               $this->db->from('tbl_subcategory');
               //$this->db->where('category',$id);
               $this->db->where('is_active', 1);
               foreach ($id as $value) {
                   $i=2;
                   if ($new_var > $i) {
                       $this->db->or_where('category', $value);
                   } else {
//       print_r($id);
                       // echo count($id);
                       $this->db->where('category', $value);

                       $this->db->or_where('category', $value);
                   }
               }

               $dat= $this->db->get();


               $i=1;
               foreach ($dat->result() as $data) {
                   $igt[] = array('sub_id' =>$data->id ,'sub_name'=>$data->subcategory);
               }

               echo json_encode($igt);
           }

           public function update_products($idd)
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
                   $this->db->from('tbl_products');
                   $this->db->where('id', $id);
                   $data['products_data']= $this->db->get()->row();


                   $this->db->select('*');
                   $this->db->from('tbl_category');
                   // $this->db->where('id',$id);
                   $data['category_data']= $this->db->get();

                   $this->db->select('*');
                   $this->db->from('tbl_subcategory');
                   //$this->db->where('id',$id);
                   $data['subcategory_data']= $this->db->get();



                   $this->db->select('*');
                   $this->db->from('tbl_leadtime');
                   //$this->db->where('id',$usr);
                   $data['leadtime_data']= $this->db->get();
                   //filter

                   $this->db->select('*');
                   $this->db->from('tbl_seating');
                   //$this->db->where('id',$usr);
                   $data['seating_data']= $this->db->get();
                   //filter

                   $this->db->select('*');
                   $this->db->from('tbl_tableshape');
                   //$this->db->where('id',$usr);
                   $data['shape_data']= $this->db->get();
                   //filter
                   $this->db->select('*');
                   $this->db->from('tbl_furnituretype');
                   //$this->db->where('id',$usr);
                   $data['furniture_type']= $this->db->get();
                   // filter

                   $this->db->select('*');
                   $this->db->from('tbl_table_feature');
                   //$this->db->where('id',$usr);
                   $data['feature_data']= $this->db->get();


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/products/update_products');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function add_products_data($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;
                       $this->form_validation->set_rules('productname', 'productname');
                       // $this->form_validation->set_rules('category', 'category');
                       $this->form_validation->set_rules('sub_category', 'sub_category');
                       $this->form_validation->set_rules('productdescription', 'productdescription');
                       $this->form_validation->set_rules('productspecification', 'productspecification');
                       $this->form_validation->set_rules('top', 'top');
                       // $this->form_validation->set_rules('leadtime', 'leadtime', 'required');
                       // $this->form_validation->set_rules('seating', 'seating', 'required');
                       // $this->form_validation->set_rules('shape', 'shape', 'required');
                       // $this->form_validation->set_rules('furniture', 'furniture', 'required');
                       // $this->form_validation->set_rules('feature', 'feature', 'required');

                       // $this->form_validation->set_rules('inventory', 'inventory', 'integer|required');

                       $this->form_validation->set_rules('modelno', 'modelno', 'required');

                       if ($this->form_validation->run()== true) {
                           $productname=$this->input->post('productname');
                           // $category=$this->input->post('category');


                           $subcategory=$this->input->post('sub_category');
                           $subcategory_data= json_encode($subcategory);
                           // $subcategory_data=implode(",",$subcategory);


                           //geting category
                           $this->db->select('*');
                           $this->db->from('tbl_subcategory');
                           $i=1;
                           foreach ($subcategory as $value) {
                               $this->db->or_where('id', $value);
                               $i++;
                           }


                           $data_subcategory= $this->db->get();
                           $category_data=[];
                           $i=1;
                           foreach ($data_subcategory->result() as $value1) {
                               if ($i>1) {
                                   foreach ($category_data as $value) {
                                       if ($value!=$value1->category) {
                                           $category_data[]=  $value1->category;
                                       }
                                   }
                               } else {
                                   $category_data[]=  $value1->category;
                               }
                               $i++;
                           }


                           $data_cat=json_encode($category_data);







                           $productdescription=$this->input->post('productdescription');
                           $productspecification=$this->input->post('productspecification');
                           $top=$this->input->post('top');
                           $leadtime=$this->input->post('leadtime');
                           $seating=$this->input->post('seating');
                           $shape=$this->input->post('shape');
                           $furniture=$this->input->post('furniture');
                           $feature=$this->input->post('feature');

                           $modelno=$this->input->post('modelno');
                           $nnnn2="";
                           $nnnn3="";
                           $nnnn4="";
                           $nnnn5="";

                           // echo $top;die();
                           $img2='image';

                           $file_check=($_FILES['image']['error']);
                           if($file_check!=4){
                               $image_upload_folder = FCPATH . "assets/uploads/products/";
                               if (!file_exists($image_upload_folder)) {
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
                               if (!$this->upload->do_upload($img2)) {
                                   $upload_error = $this->upload->display_errors();

                                   //               echo json_encode($upload_error);
                                   $this->session->set_flashdata('emessage', $upload_error);
                                   redirect($_SERVER['HTTP_REFERER']);
                               } else {
                                   $file_info = $this->upload->data();

                                   $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                                   $file_info['new_name']=$videoNAmePath;
                                   // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                   $nnnn=$file_info['file_name'];
                                   $nnnn2=$videoNAmePath;

                                   // echo json_encode($file_info);
                               }
                           }



                           $img3='image1';



                           $file_check=($_FILES['image1']['error']);
                              if($file_check!=4){
                           $image_upload_folder = FCPATH . "assets/uploads/products/";
                           if (!file_exists($image_upload_folder)) {
                               mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                           }
                           $new_file_name="products1".date("Ymdhms");
                           $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                           $this->upload->initialize($this->upload_config);
                           if (!$this->upload->do_upload($img3)) {
                               $upload_error = $this->upload->display_errors();

                           //               echo json_encode($upload_error);
           //
           // $this->session->set_flashdata('emessage',$upload_error);
           //   redirect($_SERVER['HTTP_REFERER']);
                           } else {
                               $file_info = $this->upload->data();

                               $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                               $file_info['new_name']=$videoNAmePath;
                               // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                               $nnnn=$file_info['file_name'];
                               $nnnn3=$videoNAmePath;

                               // echo json_encode($file_info);
                           }
}



                           $img4='image2';

                           $file_check=($_FILES['image2']['error']);
                              if($file_check!=4){
                           $image_upload_folder = FCPATH . "assets/uploads/products/";
                           if (!file_exists($image_upload_folder)) {
                               mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                           }
                           $new_file_name="products2".date("Ymdhms");
                           $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                           $this->upload->initialize($this->upload_config);
                           if (!$this->upload->do_upload($img4)) {
                               $upload_error = $this->upload->display_errors();

                           //               echo json_encode($upload_error);
           //
           // $this->session->set_flashdata('emessage',$upload_error);
           //   redirect($_SERVER['HTTP_REFERER']);
                           } else {
                               $file_info = $this->upload->data();

                               $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                               $file_info['new_name']=$videoNAmePath;
                               // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                               $nnnn=$file_info['file_name'];
                               $nnnn4=$videoNAmePath;

                               // echo json_encode($file_info);
                           }
}



                           $img5='image3';



                           $file_check=($_FILES['image3']['error']);
                            if($file_check!=4){
                           $image_upload_folder = FCPATH . "assets/uploads/products/";
                           if (!file_exists($image_upload_folder)) {
                               mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                           }
                           $new_file_name="products3".date("Ymdhms");
                           $this->upload_config = array(
                             'upload_path'   => $image_upload_folder,
                             'file_name' => $new_file_name,
                             'allowed_types' =>'xlsx|csv|xls|pdf|doc|docx|txt|jpg|jpeg|png',
                             'max_size'      => 25000
                     );
                           $this->upload->initialize($this->upload_config);
                           if (!$this->upload->do_upload($img5)) {
                               $upload_error = $this->upload->display_errors();

                           //               echo json_encode($upload_error);
           //
           // $this->session->set_flashdata('emessage',$upload_error);
           //   redirect($_SERVER['HTTP_REFERER']);
                           } else {
                               $file_info = $this->upload->data();

                               $videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                               $file_info['new_name']=$videoNAmePath;
                               // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                               $nnnn=$file_info['file_name'];
                               $nnnn5=$videoNAmePath;

                               // echo json_encode($file_info);
                           }
                         }

                         $img1='video';
                         $video = '';

                                     $file_check=($_FILES['video']['error']);
                                     if($file_check!=4){
                                   	$image_upload_folder = FCPATH . "assets/uploads/products/";
                           						if (!file_exists($image_upload_folder))
                           						{
                           							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                           						}
                           						$new_file_name="products4".date("Ymdhms");
                           						$this->upload_config = array(
                           								'upload_path'   => $image_upload_folder,
                           								'file_name' => $new_file_name,
                           								'allowed_types' =>'mp4|mov|webm|ogv',
                           								'max_size'      => 25000
                           						);
                           						$this->upload->initialize($this->upload_config);
                           						if (!$this->upload->do_upload($img1))
                           						{
                           							$upload_error = $this->upload->display_errors();
                                         $this->session->set_flashdata('emessage',$upload_error);
                                            redirect($_SERVER['HTTP_REFERER']);
                           							// echo json_encode($upload_error);
                           							// echo $upload_error;
                           						}
                           						else
                           						{

                           							$file_info = $this->upload->data();

                           							$videoNAmePath = "assets/uploads/products/".$new_file_name.$file_info['file_ext'];
                           							$video=$videoNAmePath;
                           							// echo json_encode($file_info);
                           						}
                                     }

                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");
                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           $last_id = 0;
                           if ($typ==1) {
                               $data_insert = array(
                  'productname'=>$productname,
                  'category'=>$data_cat,
  'subcategory'=>$subcategory_data,
  'image'=>$nnnn2,
  'image1'=>$nnnn3,
  'image2'=>$nnnn4,
  'image3'=>$nnnn5,
  'video'=>$video,
  'productdescription'=>$productdescription,
  'productspecification'=>$productspecification,
  'leadtime_id'=>$leadtime,
  'furniture_type_id'=>$furniture,
  'seating_id'=>$seating,
  'shape_id'=>$shape,
  'feature_id'=>$feature,
  'modelno'=>$modelno,
  'top'=>$top,
                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


                               $last_id=$this->base_model->insert_table("tbl_products", $data_insert, 1) ;
                               $this->session->set_flashdata('smessage', 'Data inserted successfully');
                               redirect("dcadmin/products/view_products", "refresh");

                               // $inventory_data = array(
          //   'product_id'=> $last_id,
          //   'quantity'=>0,
          //   'ip'=>$ip,
          //   'date'=>$addedby,
          //   'added_by'=>$cur_date
          //
          // );
          // $last_id2=$this->base_model->insert_table("tbl_inventory",$inventory_data,1) ;
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);



                               $this->db->select('*');
                               $this->db->from('tbl_products');
                               $this->db->where('id', $idw);
                               $dsa=$this->db->get();
                               $da=$dsa->row();

                               if (!empty($nnnn2)) {
                                   $n1=$nnnn2;
                               } else {
                                   $n1=$da->image;
                               }

                               if (!empty($nnnn3)) {
                                   $n2=$nnnn3;
                               } else {
                                   $n2=$da->image1;
                               }

                               if (!empty($nnnn4)) {
                                   $n3=$nnnn4;
                               } else {
                                   $n3=$da->image2;
                               }
                               if (!empty($nnnn5)) {
                                   $n4=$nnnn5;
                               } else {
                                   $n4=$da->image3;
                               }
                               if (!empty($video)) {
                                   $n5=$video;
                               } else {
                                   $n5=$da->video;
                               }



                               $data_insert = array(
                  'productname'=>$productname,
                  'category'=>$data_cat,
  'subcategory'=>$subcategory_data,
  'image'=>$n1,
  'image1'=>$n2,
  'image2'=>$n3,
  'image3'=>$n4,
  'video'=>$n5,
  'productdescription'=>$productdescription,
  'productspecification'=>$productspecification,
  'leadtime_id'=>$leadtime,
  'furniture_type_id'=>$furniture,
  'seating_id'=>$seating,
  'shape_id'=>$shape,
  'feature_id'=>$feature,
  'modelno'=>$modelno,
  'top'=>$top,

                     );
                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_products', $data_insert);
                           }
                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');
                               redirect("dcadmin/products/view_products", "refresh");
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

           public function updateproductsStatus($idd, $t)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $id=base64_decode($idd);
                   // echo $t;
                   // echo $id;
                   // exit;

                   if ($t=="active") {
                       $this->db->select('*');
                       $this->db->from('tbl_type');
                       $this->db->where('product_id', $id);
                       $this->db->where('is_active', 1);
                       $type_count= $this->db->count_all_results();

                       if (!empty($type_count)) {
                           $data_update = array(
                        'is_active'=>1

                        );

                           $this->db->where('id', $id);
                           $zapak=$this->db->update('tbl_products', $data_update);

                           if ($zapak!=0) {
                             $this->session->set_flashdata('smessage', 'Status updated successfully');
                               redirect("dcadmin/products/view_products", "refresh");
                           } else {
                               $this->session->set_flashdata('emessage', 'Sorry error occured');
                               redirect($_SERVER['HTTP_REFERER']);
                           }
                       } else {
                           $this->session->set_flashdata('emessage', 'Please make a type of this product for activating');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
                   if ($t=="inactive") {
                       $data_update = array(
                         'is_active'=>0

                         );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_products', $data_update);

                       if ($zapak!=0) {
                         $this->session->set_flashdata('smessage', 'Status updated successfully');
                           redirect("dcadmin/products/view_products", "refresh");
                       } else {
                           $this->session->set_flashdata('emessage', 'Sorry error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }



           public function delete_products($idd)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;
                   $id=base64_decode($idd);

                   if ($this->load->get_var('position')=="Super Admin") {
                       $this->db->select('image');
                       $this->db->from('tbl_products');
                       $this->db->where('id', $id);
                       $dsa= $this->db->get();
                       $da=$dsa->row();
                       $img=$da->image;

                       $zapak=$this->db->delete('tbl_products', array('id' => $id));
                       if ($zapak!=0) {
                           $path = FCPATH .$img;
                           unlink($path);
                           $this->session->set_flashdata('smessage','Products deleted successfully');
                           redirect("dcadmin/products/view_products", "refresh");
                       } else {
                           $this->session->set_flashdata('emessage', 'Sorry error occured');
                           redirect($_SERVER['HTTP_REFERER']);
                       }
                   } else {
                       $this->session->set_flashdata('emessage', 'Sorry you not a super admin you dont have permission to delete anything');
                       redirect($_SERVER['HTTP_REFERER']);
                   }
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function view_data_file()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   // echo SITE_NAME;
                   // echo $this->session->userdata('image');
                   // echo $this->session->userdata('position');
                   // exit;


                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/products/view_data_file');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }


           public function remove_img($idd, $t)
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   $id=base64_decode($idd);

                   if ($t=="image2") {
                       $data_update = array(
         'image2'=>""

         );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_products', $data_update);

                       if ($zapak!=0) {
                           $this->session->set_flashdata('smessage', 'Successfully Removed');
                           redirect($_SERVER['HTTP_REFERER']);
                       } else {
                         $this->session->set_flashdata('emessage', 'Sorry error occured');
                         redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
                   if ($t=="image3") {
                       $data_update = array(
          'image3'=>""

          );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_products', $data_update);

                       if ($zapak!=0) {
                           $this->session->set_flashdata('smessage', 'Successfully Removed');
                           redirect($_SERVER['HTTP_REFERER']);
                       } else {
                         $this->session->set_flashdata('emessage', 'Sorry error occured');
                         redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
                   if ($t=="video") {
                       $data_update = array(
         'video'=>""

         );

                       $this->db->where('id', $id);
                       $zapak=$this->db->update('tbl_products', $data_update);

                       if ($zapak!=0) {
                           $this->session->set_flashdata('smessage', 'Successfully Removed');
                           redirect($_SERVER['HTTP_REFERER']);
                       } else {
                         $this->session->set_flashdata('emessage', 'Sorry error occured');
                         redirect($_SERVER['HTTP_REFERER']);
                       }
                   }
               } else {
                   $this->load->view('admin/login/index');
               }
           }
       }
