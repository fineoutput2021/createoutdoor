  <?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
       require_once(APPPATH . 'core/CI_finecontrol.php');
       class Neworder extends CI_finecontrol{
       function __construct()
           {
             parent::__construct();
             $this->load->model("login_model");
             $this->load->model("admin/base_model");
             $this->load->library('user_agent');
             $this->load->library('upload');
           }

           public function view_order(){

                            if(!empty($this->session->userdata('admin_data'))){


                              $data['user_name']=$this->load->get_var('user_name');

                              // echo SITE_NAME;
                              // echo $this->session->userdata('image');
                              // echo $this->session->userdata('position');
                              // exit;
                       $this->db->select('*');
           $this->db->from('tbl_order1');
           //$this->db->where('id',$usr);
           $data['order_data']= $this->db->get();

                              $this->load->view('admin/common/header_view',$data);
                              $this->load->view('admin/order/view_order');
                              $this->load->view('admin/common/footer_view');

                          }
                          else{

                             redirect("login/admin_login","refresh");
                          }

                          }
                    public function update_order_status($idd,$t){

                             if(!empty($this->session->userdata('admin_data'))){


                               $data['user_name']=$this->load->get_var('user_name');

                               // echo SITE_NAME;
                               // echo $this->session->userdata('image');
                               // echo $this->session->userdata('position');
                               // exit;
                               $id=base64_decode($idd);

                               if($t=="accept"){

                                 $data_update = array(
                             'order_status'=>2

                             );

                             $this->db->where('id', $id);
                            $zapak=$this->db->update('tbl_order1', $data_update);

                                 if($zapak!=0){
                                 redirect("dcadmin/Neworder/view_order","refresh");
                                         }
                                         else
                                         {
                                           echo "Error";
                                           exit;
                                         }
                               }





                           }
                           else{

                               $this->load->view('admin/login/index');
                           }

                           }
                  public function update_cancel_status($idd,$t){

                           if(!empty($this->session->userdata('admin_data'))){


                             $data['user_name']=$this->load->get_var('user_name');

                             // echo SITE_NAME;
                             // echo $this->session->userdata('image');
                             // echo $this->session->userdata('position');
                             // exit;
                             $id=base64_decode($idd);

                             if($t=="Cancel"){

                               $data_update = array(
                           'order_status'=>5

                           );

                           $this->db->where('id', $id);
                          $zapak=$this->db->update('tbl_order1', $data_update);

                               if($zapak!=0){
                               redirect("dcadmin/Neworder/view_order","refresh");
                                       }
                                       else
                                       {
                                         echo "Error";
                                         exit;
                                       }
                             }




                         }
                         else{

                             $this->load->view('admin/login/index');
                         }

                         }
                         public function view_product_status($idd){

                                          if(!empty($this->session->userdata('admin_data'))){


                                            $data['user_name']=$this->load->get_var('user_name');

                                            // echo SITE_NAME;
                                            // echo $this->session->userdata('image');
                                            // echo $this->session->userdata('position');
                                            // exit;
                                             $id=base64_decode($idd);



                                      $this->db->select('*');
                          $this->db->from('tbl_order2');
                          $this->db->where('main_id',$id);
                          $data['status_product']= $this->db->get();


                                            $this->load->view('admin/common/header_view',$data);
                                            $this->load->view('admin/order/view_product_status');
                                            $this->load->view('admin/common/footer_view');

                                        }
                                        else{

                                           redirect("login/admin_login","refresh");
                                        }

                                        }
                                        public function view_completed_orders(){

                                                         if(!empty($this->session->userdata('admin_data'))){


                                                           $data['user_name']=$this->load->get_var('user_name');

                                                           // echo SITE_NAME;
                                                           // echo $this->session->userdata('image');
                                                           // echo $this->session->userdata('position');
                                                           // exit;
                                                        $this->db->select('*');
                                                                    $this->db->from('tbl_order1');
                                                                    $this->db->where('order_status',2);
                                                                    $data['order_data']= $this->db->get();


                                                           $this->load->view('admin/common/header_view',$data);
                                                           $this->load->view('admin/order/view_order');
                                                           $this->load->view('admin/common/footer_view');

                                                       }
                                                       else{

                                                          redirect("login/admin_login","refresh");
                                                       }

                                                       }
                                            public function view_dispatched_orders(){

                                                             if(!empty($this->session->userdata('admin_data'))){


                                                               $data['user_name']=$this->load->get_var('user_name');

                                                               // echo SITE_NAME;
                                                               // echo $this->session->userdata('image');
                                                               // echo $this->session->userdata('position');
                                                               // exit;
                                                               $this->db->select('*');
                                                                           $this->db->from('tbl_order1');
                                                                           $this->db->where('order_status',3);
                                                                           $data['order_data']= $this->db->get();

                                                               $this->load->view('admin/common/header_view',$data);
                                                               $this->load->view('admin/order/view_order');
                                                               $this->load->view('admin/common/footer_view');

                                                           }
                                                           else{

                                                              redirect("login/admin_login","refresh");
                                                           }

                                                           }
                                                           public function view_cancel_orders(){

                                                                            if(!empty($this->session->userdata('admin_data'))){


                                                                              $data['user_name']=$this->load->get_var('user_name');

                                                                              // echo SITE_NAME;
                                                                              // echo $this->session->userdata('image');
                                                                              // echo $this->session->userdata('position');
                                                                              // exit;
                                                                              $this->db->select('*');
                                                                                          $this->db->from('tbl_order1');
                                                                                          $this->db->where('order_status',5);
                                                                                          $data['order_data']= $this->db->get();

                                                                              $this->load->view('admin/common/header_view',$data);
                                                                              $this->load->view('admin/order/view_order');
                                                                              $this->load->view('admin/common/footer_view');

                                                                          }
                                                                          else{

                                                                             redirect("login/admin_login","refresh");
                                                                          }

                                                                          }

                        public function view_order_bill($main_id){

                                         if(!empty($this->session->userdata('admin_data'))){


                                           $this->db->select('*');
                    $this->db->from('tbl_order1');
                    $this->db->where('id',base64_decode($main_id));
                    $data['order1_data']= $this->db->get()->row();

                   $this->db->select('*');
                    $this->db->from('tbl_order2');
                    $this->db->where('main_id',base64_decode($main_id));
                    $data['order2_data']= $this->db->get();

                                           //$this->load->view('admin/common/header_view',$data);
                                           $this->load->view('admin/order/order_bill',$data);
                                           //$this->load->view('admin/common/footer_view');

                                       }
                                       else{

                                          redirect("login/admin_login","refresh");
                                       }

                                       }




      }
