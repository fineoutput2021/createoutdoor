<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Topbar extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

         public function view_topbar(){

            if(!empty($this->session->userdata('admin_data'))){


              $data['user_name']=$this->load->get_var('user_name');

              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;

                           $this->db->select('*');
               $this->db->from('tbl_topbar');
               //$this->db->where('id',$usr);
               $data['topbar_data']= $this->db->get();

              $this->load->view('admin/common/header_view',$data);
              $this->load->view('admin/topbar/view_topbar');
              $this->load->view('admin/common/footer_view');

          }
          else{

             redirect("login/admin_login","refresh");
          }

          }

              public function add_topbar(){

                 if(!empty($this->session->userdata('admin_data'))){

                   $this->load->view('admin/common/header_view');
                   $this->load->view('admin/topbar/add_topbar');
                   $this->load->view('admin/common/footer_view');

               }
               else{

                  redirect("login/admin_login","refresh");
               }

               }

               public function update_topbar($idd){

                   if(!empty($this->session->userdata('admin_data'))){


                     $data['user_name']=$this->load->get_var('user_name');

                     // echo SITE_NAME;
                     // echo $this->session->userdata('image');
                     // echo $this->session->userdata('position');
                     // exit;

                      $id=base64_decode($idd);
                     $data['id']=$idd;

                            $this->db->select('*');
                            $this->db->from('tbl_topbar');
                            $this->db->where('id',$id);
                            $data['topbar_data']= $this->db->get()->row();


                     $this->load->view('admin/common/header_view',$data);
                     $this->load->view('admin/topbar/update_topbar');
                     $this->load->view('admin/common/footer_view');

                 }
                 else{

                    redirect("login/admin_login","refresh");
                 }

                 }

             public function add_topbar_data($t,$iw="")

               {

                 if(!empty($this->session->userdata('admin_data'))){


             $this->load->helper(array('form', 'url'));
             $this->load->library('form_validation');
             $this->load->helper('security');
             if($this->input->post())
             {
               // print_r($this->input->post());
               // exit;
  $this->form_validation->set_rules('Name', 'Name', '');
  $this->form_validation->set_rules('link', 'link', 'required');





               if($this->form_validation->run()== TRUE)
               {
  $Name=$this->input->post('Name');
  $link=$this->input->post('link');

                   $ip = $this->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
                   $addedby=$this->session->userdata('admin_id');

           $typ=base64_decode($t);
           $last_id = 0;
           if($typ==1){



           $data_insert = array(
                  'Name'=>$Name,
  'link'=>$link,

                     'ip' =>$ip,
                     'added_by' =>$addedby,
                     'is_active' =>1,
                     'date'=>$cur_date
                     );


           $last_id=$this->base_model->insert_table("tbl_topbar",$data_insert,1) ;
           $this->session->set_flashdata('smessage','Data inserted successfully');
           redirect("dcadmin/topbar/view_topbar","refresh");
           }
           if($typ==2){

    $idw=base64_decode($iw);


 $this->db->select('*');
 $this->db->from('tbl_topbar');
 $this->db->where('id',$idw);
 $dsa=$this->db->get();
 $da=$dsa->row();





           $data_insert = array(
                  'Name'=>$Name,
  'link'=>$link,

                     );
             $this->db->where('id', $idw);
             $last_id=$this->db->update('tbl_topbar', $data_insert);
           }
                       if($last_id!=0){
                               $this->session->set_flashdata('smessage','Data updated successfully');
                               redirect("dcadmin/topbar/view_topbar","refresh");
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

               public function updatetopbarStatus($idd,$t){

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
                       $zapak=$this->db->update('tbl_topbar', $data_update);

                            if($zapak!=0){
                              $this->session->set_flashdata('smessage','Status updated successfully');
                            redirect("dcadmin/topbar/view_topbar","refresh");
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
                         $zapak=$this->db->update('tbl_topbar', $data_update);

                             if($zapak!=0){
                               $this->session->set_flashdata('smessage','Status updated successfully');
                             redirect("dcadmin/topbar/view_topbar","refresh");
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



               public function delete_topbar($idd){

                      if(!empty($this->session->userdata('admin_data'))){

                        $data['user_name']=$this->load->get_var('user_name');

                        // echo SITE_NAME;
                        // echo $this->session->userdata('image');
                        // echo $this->session->userdata('position');
                        // exit;
                        $id=base64_decode($idd);

                       if($this->load->get_var('position')=="Super Admin"){



 $zapak=$this->db->delete('tbl_topbar', array('id' => $id));
 if($zapak!=0){
   $this->session->set_flashdata('smessage','Topbar deleted successfully');
        redirect("dcadmin/topbar/view_topbar","refresh");
                }
                else
                {
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
