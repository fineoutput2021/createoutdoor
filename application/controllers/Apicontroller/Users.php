<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller{
function __construct()
    {
      parent::__construct();
      $this->load->model("admin/login_model");
      $this->load->model("admin/base_model");
    }

    public function random_strings($length_of_string)
  	{

  	// String of all alphanumeric character
  	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

  	// Shufle the $str_result and returns substring
  	// of specified length
  	return substr(str_shuffle($str_result), 0, $length_of_string);
  	}


public function login(){


                  $this->load->helper(array('form', 'url'));
                  $this->load->library('form_validation');
                  $this->load->helper('security');
                  if($this->input->post())
                  {
                    // print_r($this->input->post());
                    // exit;
                    $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
                    $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');

                    if($this->form_validation->run()== TRUE)
                    {
                      $email=$this->input->post('email');
                      $password=$this->input->post('password');

                      $this->db->select('*');
                                  $this->db->from('tbl_users');
                                  $this->db->where('email',$email);
                                  $dsa= $this->db->get();
                                  $da=$dsa->row();
                              if(!empty($da)){

                                $p1=$da->password;
                                if($p1==$password){
                                  $txnid= $this->random_strings(30);

                                  $this->db->select('*');
                                              $this->db->from('tbl_users');
                                              $this->db->where('token',$txnid);
                                              $dsa= $this->db->get();
                                              $da23=$dsa->row();
                                        if(empty($da23)){
                                          $token=$txnid;
                                        }
                                        else{
                                            $token= $this->random_strings(30);
                                        }

                          header('Access-Control-Allow-Origin: *');
                                  $res=array(
                                    'code'=>200,
                                    'message'=>'success',
                                    'token'=>$token
                                  );
                                  echo json_encode($res);
                                  exit;

                                }
                                else{
                                  header('Access-Control-Allow-Origin: *');

                                  $res=array(
                                    'code'=>201,
                                    'message'=>'wrong password',
                                  );
                                  echo json_encode($res);
                                  exit;
                                }


                              }
                              else{
                                header('Access-Control-Allow-Origin: *');

                                $res=array(
                                  'code'=>201,
                                  'message'=>'no user found with this email',
                                );
                                echo json_encode($res);
                                exit;
                              }



                    }
                  else{
                    header('Access-Control-Allow-Origin: *');

                    $res = array('message'=>validation_errors(),
                          'status'=>201
                          );

                          echo json_encode($res);


                  }

                  }
                else{
                  header('Access-Control-Allow-Origin: *');

                  $res = array('message'=>"Please insert some data, No data available",
                        'status'=>201
                        );

                        echo json_encode($res);

                }



    }

public function register(){


                  $this->load->helper(array('form', 'url'));
                  $this->load->library('form_validation');
                  $this->load->helper('security');
                  if($this->input->post())
                  {
                    // print_r($this->input->post());
                    // exit;
                    $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                    $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim|valid_email');
                    $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
                    $this->form_validation->set_rules('agent_code', 'agent_code', 'xss_clean|trim');

                    if($this->form_validation->run()== TRUE)
                    {
                      $name=$this->input->post('name');
                      $email=$this->input->post('email');
                      $password=$this->input->post('password');
                      $agent_code=$this->input->post('agent_code');

                        $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                        $cur_date=date("Y-m-d H:i:s");
                        $addedby=999;

                $data_insert = array(
                          'name'=>$name,
                          'email'=>$email,
                          'password'=>$password,
                          'agent_code'=>$agent_code,
                          'ip' =>$ip,
                          'is_active' =>1,
                          'date'=>$cur_date

                          );





                $last_id=$this->base_model->insert_table("tbl_users",$data_insert,1) ;

                if($last_id!=0){
                  $token= $this->random_strings(30);

                  $this->db->select('*');
                              $this->db->from('tbl_users');
                              $this->db->where('token',$token);
                              $dsa= $this->db->get();
                              $da=$dsa->row();
                                if(!empty($da)){
                                      $token= $this->random_strings(30);
                                }
                                else{
                                      $token= $token;
                                }


                                $data_update = array(
                                                                    'token'=>$token,

                                                                    );

                                                                    $this->db->where('id', $last_id);
                                                                    $zapak=$this->db->update('tbl_users', $data_update);

                                                                    header('Access-Control-Allow-Origin: *');

            $res = array('message'=>"success",
                          'status'=>200,
                          'token'=>$token,
                          );

                  echo json_encode($res);

                      }

                      else

                      {
                        header('Access-Control-Allow-Origin: *');

                        $res = array('message'=>"Sorry error occured",
                              'status'=>201
                              );

                              echo json_encode($res);




                      }


                    }
                  else{
                    header('Access-Control-Allow-Origin: *');

                    $res = array('message'=>validation_errors(),
                          'status'=>201
                          );

                          echo json_encode($res);


                  }

                  }
                else{
                  header('Access-Control-Allow-Origin: *');

                  $res = array('message'=>"Please insert some data, No data available",
                        'status'=>201
                        );

                        echo json_encode($res);

                }



    }





  }
