<?php

    if (! defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Abandoncart extends CI_finecontrol
       {
           public function __construct()
           {
               parent::__construct();
               $this->load->model("login_model");
               $this->load->model("admin/base_model");
               $this->load->library('user_agent');
               $this->load->library('upload');
           }

           public function view_Abandon_cart()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $data['user_name']=$this->load->get_var('user_name');

                   $this->db->select('user_id,token_id');
                   $this->db->distinct();
                   // $this->db->where('user_id is NOT NULL', null, false);
                   $this->db->order_by('id', 'desc');
                   $cart_data = $this->db->get('tbl_cart');
                   // $cart_data = $this->db->count_all_results('tbl_cart');
                   // echo $cart_data;exit;

                   $data['cart_data']= $cart_data;

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/abandoncart/view_Abandon_cart');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           public function view_percentage()
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->db->select('*');
                   $this->db->from('tbl_discount_percentage');
                   //$this->db->where('id',$usr);
                   $data['percentage_data']= $this->db->get()->row();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/abandoncart/view_percentage');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }
           public function add_percentage_data($t, $iw="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   $this->load->helper(array('form', 'url'));
                   $this->load->library('form_validation');
                   $this->load->helper('security');
                   if ($this->input->post()) {
                       // print_r($this->input->post());
                       // exit;
                       $this->form_validation->set_rules('percentage', 'percentage', 'required|xss_clean|trim');

                       if ($this->form_validation->run()== true) {
                           $percentage=$this->input->post('percentage');

                           $ip = $this->input->ip_address();
                           date_default_timezone_set("Asia/Calcutta");
                           $cur_date=date("Y-m-d H:i:s");

                           $addedby=$this->session->userdata('admin_id');

                           $typ=base64_decode($t);
                           if ($typ==1) {
                               $data_insert = array('percentage'=>$percentage,
                               'ip' =>$ip,
                               'added_by' =>$addedby,
                               'is_active' =>1,
                               'date'=>$cur_date

                               );


                               $last_id=$this->base_model->insert_table("tbl_discount_percentage", $data_insert, 1) ;
                           }
                           if ($typ==2) {
                               $idw=base64_decode($iw);
                               // echo $idw;
                               // exit;
                               $data_insert = array('percentage'=>$percentage,
                               'ip' =>$ip,
                               'added_by' =>$addedby,
                               'is_active' =>1,
                               'date'=>$cur_date

                               );

                               $this->db->where('id', $idw);
                               $last_id=$this->db->update('tbl_discount_percentage', $data_insert);
                           }


                           if ($last_id!=0) {
                               $this->session->set_flashdata('smessage', 'Data updated successfully');

                               redirect("dcadmin/Abandoncart/view_Abandon_cart", "refresh");
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

           public function view_cart_details($idd,$id="")
           {
               if (!empty($this->session->userdata('admin_data'))) {
                   if(!empty($id)){
                     $id=base64_decode($id);
                   $this->db->select('*');
                   $this->db->from('tbl_cart');
                   $this->db->where('user_id', $id);
                 }else{
                   $id=base64_decode($idd);
                   $data['id']=$idd;
                   $this->db->select('*');
                   $this->db->from('tbl_cart');
                   $this->db->where('token_id', $id);
                 }
                 $data['cart_data']= $this->db->get();

                   $this->load->view('admin/common/header_view', $data);
                   $this->load->view('admin/abandoncart/view_cart_details');
                   $this->load->view('admin/common/footer_view');
               } else {
                   redirect("login/admin_login", "refresh");
               }
           }

           //---------cronjob function-----------

           public function abandoncart()
           {
               $this->db->select('user_id');
               $this->db->distinct();
               $this->db->where('user_id is NOT NULL', null, false);
               $cart_data = $this->db->get('tbl_cart');

               $cart_check = $cart_data->row();
               if (!empty($cart_check)) {
                   foreach ($cart_data->result() as $data) {
                       $email_data = [];


                       $this->db->select('*');
                       $this->db->from('tbl_users');
                       $this->db->where('id', $data->user_id);
                       $user_data= $this->db->get()->row();


                       //------craeting special promocode------
                       $this->db->select('*');
                       $this->db->from('tbl_discount_percentage');
                       $discount_data= $this->db->get()->row();


                       $ip = $this->input->ip_address();
                       date_default_timezone_set("Asia/Calcutta");
                       $cur_date=date("Y-m-d H:i:s");

                       $random = bin2hex(random_bytes(3));

                       $promo = strtoupper("CS".$random);

                       $data_insert = array(
                        'promocode'=>$promo,
                        'ptype'=>1,
                        'abandon'=>1,
                        'giftpercent'=>$discount_data->percentage,
                        'ip' =>$ip,
                        'is_active' =>1,
                        'date'=>$cur_date
                        );

                       $last_id=$this->base_model->insert_table("tbl_promocode", $data_insert, 1) ;
                       $email_data =array(
                'user_id'=> $user_data->id,
                'discount'=> $discount_data->percentage,
                'promocode'=> $promo);

                       $config = array(
                           'protocol' => 'smtp',
                           'smtp_host' => SMTP_HOST,
                           'smtp_port' => SMTP_PORT,
                           'smtp_user' => USER_NAME, // change it to yours
                           'smtp_pass' => PASSWORD, // change it to yours
                           'mailtype' => 'html',
                           'charset' => 'iso-8859-1',
                           'wordwrap' => true
                       );
                       $to=$user_data->email;

                       // print_r($email_data);
                       //   exit;
                       $message = 	$this->load->view('email/abandon', $email_data, true);
                       echo $message;
                       exit;
                       // $message = 'Hello '.$n1.'<br/><br/>
                       // you have requested to reset your password, Here is the link<br/>'.$link.'<br/>click on the link and reset your password. Please remember that link can be used only once<br/><br/>Thanks';
                       $this->load->library('email', $config);
                       $this->email->set_newline("");
                       $this->email->from(EMAIL); // change it to yours
              $this->email->to($to);// change it to yours
              $this->email->subject('Special Discount for you');
                       $this->email->message($message);
                       if ($this->email->send()) {
                           // echo 'Email sent.';
                       } else {
                           // show_error($this->email->print_debugger());
                       }

                       //-------update cart status---------------

                       $this->db->select('*');
                       $this->db->from('tbl_cart');
                       $this->db->where('user_id', $data->user_id);
                       $this->db->where('abandon', 0);
                       $c_data= $this->db->get();
                       foreach ($c_data->result() as $Cdata) {
                           $cart_update = array('abandon'=>1,
                         );
                           $this->db->where('id', $Cdata->id);
                           $zapak=$this->db->update('tbl_cart', $cart_update);
                       }
                   }
                   header('Access-Control-Allow-Origin: *');
                   $res = array('message'=>'success',
            'status'=>200
            );

                   echo json_encode($res);
               }
           }
       }
