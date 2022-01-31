<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Users extends CI_Controller
{
    public function __construct()
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


    public function login()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            // print_r($this->input->post());
            // exit;
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $email=$this->input->post('email');
                $password=md5($this->input->post('password'));

                $this->db->select('*');
                $this->db->from('tbl_users');
                $this->db->where('email', $email);
                $dsa= $this->db->get();
                $da=$dsa->row();
                if (!empty($da)) {
                    $p1=$da->password;
                    if ($p1==$password) {
                        $token = $da->token;

                        $this->db->select('*');
                        $this->db->from('tbl_cart');
                        $this->db->where('token_id', $token);
                        $cart_data= $this->db->get();

                        foreach ($cart_data->result() as $data) {
                            $data_insert = array('user_id'=>$da->id,

                                            );

                            $this->db->where('id', $data->id);
                            $last_id=$this->db->update('tbl_cart', $data_insert);
                        }
                        header('Access-Control-Allow-Origin: *');
                        $res=array(
                                    'code'=>200,
                                    'message'=>'success',
                                    'email'=>$email,
                                    'password'=>$p1,
                                    'user_name'=>$da->name
                                  );
                        echo json_encode($res);
                        exit;
                    } else {
                        header('Access-Control-Allow-Origin: *');

                        $res=array(
                                    'code'=>201,
                                    'message'=>'wrong password',
                                  );
                        echo json_encode($res);
                        exit;
                    }
                } else {
                    header('Access-Control-Allow-Origin: *');

                    $res=array(
                                  'code'=>201,
                                  'message'=>'no user found with this email',
                                );
                    echo json_encode($res);
                    exit;
                }
            } else {
                header('Access-Control-Allow-Origin: *');

                $res = array('message'=>validation_errors(),
                          'status'=>201
                          );

                echo json_encode($res);
            }
        } else {
            header('Access-Control-Allow-Origin: *');

            $res = array('message'=>"Please insert some data, No data available",
                        'status'=>201
                        );

            echo json_encode($res);
        }
    }

    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            // print_r($this->input->post());
            // exit;
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
            $this->form_validation->set_rules('agent_code', 'agent_code', 'xss_clean|trim');
            $this->form_validation->set_rules('token', 'token', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $name=$this->input->post('name');
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $agent_code=$this->input->post('agent_code');
                $token=$this->input->post('token');

                $ip = $this->input->ip_address();
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $addedby=999;
                $this->db->select('*');
                $this->db->from('tbl_users');
                $this->db->where('email', $email);
                $userdata1= $this->db->get()->row();

                if (empty($userdata1)) {

                    $data_insert = array(
                          'name'=>$name,
                          'email'=>$email,
                          'password'=>md5($password),
                          'agent_code'=>$agent_code,
                          'token'=>$token,

                          'ip' =>$ip,
                          'is_active' =>1,
                          'date'=>$cur_date

                          );





                    $last_id=$this->base_model->insert_table("tbl_users", $data_insert, 1) ;

                    if ($last_id!=0) {
                        $this->db->select('*');
                        $this->db->from('tbl_users');
                        $this->db->where('id', $last_id);
                        $user_data= $this->db->get()->row();

                        $token = $user_data->token;

                        $this->db->select('*');
                        $this->db->from('tbl_cart');
                        $this->db->where('token_id', $token);
                        $cart_data= $this->db->get();

                        foreach ($cart_data->result() as $data) {
                            $data_insert = array('user_id'=>$user_data->id,

                            );

                            $this->db->where('id', $data->id);
                            $last_id=$this->db->update('tbl_cart', $data_insert);
                        }


                        $data_update = array('token'=>$token);

                        $this->db->where('id', $last_id);
                        $zapak=$this->db->update('tbl_users', $data_update);

                        //------send register email -------------

                        $config = Array(
                        		'protocol' => 'smtp',
                            'smtp_host' => SMTP_HOST,
                            'smtp_port' => SMTP_PORT,
                            'smtp_user' => USER_NAME, // change it to yours
                            'smtp_pass' => PASSWORD, // change it to yours
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1',
                            'wordwrap' => true
                        		 );
                        $to=$email;
                        $data['name'] = $name;
                        $message =$this->load->view('email/newaccount',$data,TRUE);
                         // print_r($message);
                         // exit;

                        $this->load->library('email', $config);
                        $this->email->set_newline("");
                        $this->email->from(EMAIL); // change it to yours
                        $this->email->to($to);// change it to yours
                        $this->email->subject('Order Placed');
                        $this->email->message($message);
                        if($this->email->send()){
                         // echo 'Email sent.';
                        }else{
                         // show_error($this->email->print_debugger());
                        }




                        header('Access-Control-Allow-Origin: *');
                        $res = array('message'=>"success",
                          'status'=>200,
                          'email'=>$email,
                          'password'=>md5($password),
                          'user_name'=>$name,
                          );

                        echo json_encode($res);
                    } else {
                        header('Access-Control-Allow-Origin: *');

                        $res = array('message'=>"Sorry error occured",
                              'status'=>201
                              );

                        echo json_encode($res);
                    }
                } else {
                    header('Access-Control-Allow-Origin: *');

                    $res = array('message'=>'User already exist',
        'status'=>201
        );

                    echo json_encode($res);
                }
            } else {
                header('Access-Control-Allow-Origin: *');

                $res = array('message'=>validation_errors(),
                          'status'=>201
                          );

                echo json_encode($res);
            }
        } else {
            header('Access-Control-Allow-Origin: *');

            $res = array('message'=>"Please insert some data, No data available",
                        'status'=>201
                        );

            echo json_encode($res);
        }
    }
}
