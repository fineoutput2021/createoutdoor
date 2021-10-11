																		<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
																		class Apicontroller extends CI_Controller{
																		function __construct()
																				{
																					parent::__construct();
																					$this->load->model("admin/login_model");
																					$this->load->model("admin/base_model");
																				}


																		// ==================================== Home Components =========================================================



																		// .slider


																		public function get_slider(){

																		              $this->db->select('*');
																		  $this->db->from('tbl_sliderpanel');
																		  $sliderdata= $this->db->get();
																		  $slider=[];
																		foreach($sliderdata->result() as $data) {
																		$slider[] = array(
																		      'name'=> $data->name,
																		      'image'=> base_url().$data->image
																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$slider
																					);

																					echo json_encode($res);

																		  }




																		// ========= gallery =========
																		public function get_gallery(){

																		              $this->db->select('*');
																		  $this->db->from('tbl_gallery');
																		  $gallerydata= $this->db->get();
																		  $gallery=[];
																		foreach($gallerydata->result() as $data) {
																		$gallery[] = array(
																					'name'=> $data->name,
																		      'image'=> base_url().$data->image

																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$gallery
																					);

																					echo json_encode($res);

																		  }




																		//------- demo user register--------
																		public function add_user(){


																		              $this->load->helper(array('form', 'url'));
																		              $this->load->library('form_validation');
																		              $this->load->helper('security');
																		              if($this->input->post())
																		              {
																		                // print_r($this->input->post());
																		                // exit;
																		                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
																		                $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');
																		                $this->form_validation->set_rules('pincode', 'pincode', 'required|xss_clean|trim');
																		                $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');

																		                if($this->form_validation->run()== TRUE)
																		                {
																		                  $name=$this->input->post('name');
																		                  $address=$this->input->post('address');
																		                  $pincode=$this->input->post('pincode');
																		                  $password=$this->input->post('password');

																		                    $ip = $this->input->ip_address();
																		            date_default_timezone_set("Asia/Calcutta");
																		                    $cur_date=date("Y-m-d H:i:s");
																		                    $addedby=999;

																		            $data_insert = array('name'=>$name,
																		                      'address'=>$address,
																		                      'pincode'=>$pincode,
																		                      'password'=>md5($password),
																		                      'ip' =>$ip,
																		                      'added_by' =>$addedby,
																		                      'is_active' =>1,
																		                      'date'=>$cur_date

																		                      );





																		            $last_id=$this->base_model->insert_table("tbl_users",$data_insert,1) ;

																		            if($last_id!=0){

																		              $res = array('message'=>"success",
																		'status'=>200
																		);

																		echo json_encode($res);

																		                                        }

																		                                        else

																		                                        {

																		                                          $res = array('message'=>"Sorry error occured",
																		                                          			'status'=>201
																		                                          			);

																		                                          			echo json_encode($res);




																		                                        }


																		                }
																		              else{
																		                $res = array('message'=>validation_errors(),
																		                			'status'=>201
																		                			);

																		                			echo json_encode($res);


																		              }

																		              }
																		            else{

																		              $res = array('message'=>"Please insert some data, No data available",
																		              			'status'=>201
																		              			);

																		              			echo json_encode($res);

																		            }



																		}
																		// ======== Get Category =========

																		public function get_category(){

																		            $this->db->select('*');
																		$this->db->from('tbl_category');
																		$categorydata= $this->db->get();
																		$category=[];
																		foreach($categorydata->result() as $data) {
																		$category[] = array(
																		    'categoryname'=> $data->categoryname

																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$category
																					);

																					echo json_encode($res);


																		}

																		// ========= Get Products =========================
																		public function get_products(){

																		            $this->db->select('*');
																		$this->db->from('tbl_products');
																		$productsdata= $this->db->get();
																		$products=[];
																		foreach($productsdata->result() as $data) {
																		$products[] = array(
																			  'productname'=> $data->name,
																		    'productimage'=> base_url().$data->image,
																		    'mrp'=> $data->mrp,
																		    'productdescription'=> $data->productdescription,
																		    'colours'=> $data->colours,
																		    // 'inventory'=> $data->inventory
																		);
																		}

																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$products
																					);

																					echo json_encode($res);


																		}

																		// ========= Get Sale =============
																		public function get_sale(){

																		            $this->db->select('*');
																		$this->db->from('tbl_sale');
																		$salesdata= $this->db->get();
																		$sales=[];
																		foreach($salesdata->result() as $data) {
																		$sales[] = array(
																		    'title'=> $data->title,
																		    'description'=> $data->description,
																		    'image'=> base_url().$data->image,
																		    'image1'=> base_url().$data->image1,

																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$sales
																					);

																					echo json_encode($res);


																		}

																		// ========= Get Stock =============
																		public function get_stock(){

																		            $this->db->select('*');
																		$this->db->from('tbl_stock');
																		$stockdata= $this->db->get();
																		$stock=[];
																		foreach($stockdata->result() as $data) {
																		$stock[] = array(
																			'image'=> base_url().$data->image,
																		    'title'=> $data->title,
																				'description'=> $data->description,


																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$stock
																					);

																					echo json_encode($res);


																		}
																		// ========= Get chair =============
																		public function get_chair(){

																		            $this->db->select('*');
																		$this->db->from('tbl_chair');
																		$chairdata= $this->db->get();
																		$chair=[];
																		foreach($chairdata->result() as $data) {
																		$chair[] = array(
																				'image'=> base_url().$data->image1,
																				// 'image2'=> base_url().$data->Image2

																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$chair
																					);

																					echo json_encode($res);


																		}



																		// ========= Register User ================


																		public function register_user(){


																		              $this->load->helper(array('form', 'url'));
																		              $this->load->library('form_validation');
																		              $this->load->helper('security');
																		              if($this->input->post())
																		              {
																		                // print_r($this->input->post());
																		                // exit;
																		                $this->form_validation->set_rules('fullname', 'fullname', 'required|xss_clean|trim');
																		                $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
																		                $this->form_validation->set_rules('agentcode', 'agentcode', 'required|xss_clean|trim');

																		                if($this->form_validation->run()== TRUE)
																		                {
																		                  $fullname=$this->input->post('fullname');
																		                  $phone=$this->input->post('phone');
																		                  $agentcode=$this->input->post('agentcode');


																		                    $ip = $this->input->ip_address();
																		            date_default_timezone_set("Asia/Calcutta");
																		                    $cur_date=date("Y-m-d H:i:s");


																		            $data_insert = array('fullname'=>$fullname,
																		                      'phone'=>$phone,
																		                      'agentcode'=>$agentcode,
																		                      'ip' =>$ip,
																		                      'is_active' =>1,
																		                      'date'=>$cur_date

																		                      );





																		            $last_id=$this->base_model->insert_table("tbl_tempuser",$data_insert,1) ;

																		            if($last_id!=0){

																		              $res = array('message'=>"success",
																		'status'=>200
																		);

																		echo json_encode($res);

																		                                        }

																		                                        else

																		                                        {

																		                                          $res = array('message'=>"Sorry error occured",
																		                                          			'status'=>201
																		                                          			);

																		                                          			echo json_encode($res);




																		                                        }


																		                }
																		              else{
																		                $res = array('message'=>validation_errors(),
																		                			'status'=>201
																		                			);

																		                			echo json_encode($res);


																		              }

																		              }
																		            else{

																		              $res = array('message'=>"Please insert some data, No data available",
																		              			'status'=>201
																		              			);

																		              			echo json_encode($res);

																		            }
																		}
																		//get subcategory

																		public function get_subcategory($id){


																		            $this->db->select('*');
																		$this->db->from('tbl_subcategory');
																		$this->db->where('category_id',$id);
																		$subcategorydata= $this->db->get();
																		$subcategory=[];
																		foreach($subcategorydata->result() as $data1) {
																		$subcategory[] = array(
																		    'name'=> $data1->name,


																		);
																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$subcategory
																					);

																					echo json_encode($res);


																		}



																		//get all category
																		public function get_allcategory(){

																		            $this->db->select('*');
																		$this->db->from('tbl_category');
																		$categorydata= $this->db->get();
																		$category=[];
																		foreach($categorydata->result() as $data) {

																			$this->db->select('*');
																			$this->db->from('tbl_subcategory');
																			$this->db->where('category_id',$data->id);
																			$sub= $this->db->get();
																			$subcategory=[];
																			foreach($sub->result() as $sub2) {

																			$subcategory[] = array(
																				'sub_id' => $sub2->id,
																			    'name'=> $sub2->name



																			);
																		}
																		// $catt=array('name'=> $data->categoryname,'sub_name'=>$subcategory);

																			$cat[] = array(
																				'id' =>$data->id,
																				'name' =>$data->categoryname,
																				'sub_category' =>$subcategory

																		);


																		}
																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$cat,
																					);

																					echo json_encode($res);


																		}


																		//all product detail
																		public function get_allproducts(){

																		            $this->db->select('*');
																		$this->db->from('tbl_products');
																		$this->db->where('is_active',1);
																		$productsdata= $this->db->get();
																		$products=[];
																		foreach($productsdata->result() as $data) {

																			//category
																		      			$this->db->select('*');
																		$this->db->from('tbl_category');
																		$this->db->where('id',$data->category_id);
																		$cat= $this->db->get()->row();
																		if(!empty($cat)){
																			$c1=$cat->categoryname;
																		}
																		else{
																			$c1="";
																		}



																		//type --
																		$this->db->select('*');
																			$this->db->from('tbl_type');
																		$this->db->where('product_id',$data->id);
																		$typ= $this->db->get();
																		$producttype=[];
																		foreach($typ->result() as $type){

																		$producttype[]=array(
																		'type_id'=>$type->id,
																		'type_name'=>$type->name,
																		'MRP'    =>$type->mrp,
																		'Price' =>$type->gstprice,

																		);

																		}

																		//subcategory
																		$this->db->select('*');
																			$this->db->from('tbl_subcategory');
																		$this->db->where('id',$data->subcategory_id);
																		$sub= $this->db->get()->row();
												if(!empty($sub)){
													$s1=$sub->name;
												}
												else{
													$s1="";
												}

																		$products[] = array(
																			'product_id'=>$data->id,
																			  'productname'=> $data->name,
																				'category'=> $c1,
																			  'subcategory'=>$s1,
																				'productimage'=> base_url().$data->image,
																				'productimage1'=> base_url().$data->image1,
																				'productimage2'=> base_url().$data->image2,
																				'productimage3'=> base_url().$data->image3,
																				'productimage4'=> base_url().$data->image4,
																		    'mrp'=> $data->mrp,
																		    'productdescription'=> $data->productdescription,
																		    'colours'=> $data->colours,
																				'product_type'=>$producttype,

																		    // 'inventory'=> $data->inventory
																		);
																		}

																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$products
																					);

																					echo json_encode($res);


																		}
																		//all product detail using id  single detail  product
																		public function get_allproductsdetail($id){

																		            $this->db->select('*');
																		$this->db->from('tbl_products');
																		$this->db->where('id',$id);
																		$productsdata= $this->db->get();
																		$products=[];
																		foreach($productsdata->result() as $data) {

																			//category
																		      			$this->db->select('*');
																		$this->db->from('tbl_category');
																		$this->db->where('id',$data->category_id);
																		$cat= $this->db->get()->row();



																		//subcategory
																		$this->db->select('*');
																			$this->db->from('tbl_subcategory');
																		$this->db->where('id',$data->subcategory_id);
																		$sub= $this->db->get()->row();


																		//type --
																		$this->db->select('*');
																			$this->db->from('tbl_type');
																		$this->db->where('product_id',$data->id);
																		$typ= $this->db->get();
																		$producttype=[];
																		foreach($typ->result() as $type){

																		$producttype[]=array(
																		'type_id'=>$type->id,
																		'type_name'=>$type->name,
																		'MRP' =>$type->mrp,
												            'Price' =>$type->gstprice,
																		);

																		}



																		$products[] = array(
																			 'product_id'=> $data->id,
																			  'productname'=> $data->name,

																			  'category'=> $cat->categoryname,
																			  'sucategory'=> $sub->name,
																				'productimage'=> base_url().$data->image,
																				'productimage1'=> base_url().$data->image1,
																				'productimage2'=> base_url().$data->image2,
																				'productimage3'=> base_url().$data->image3,
																				'productimage4'=> base_url().$data->image4,

																		    'mrp'=> $data->mrp,
																		    'productdescription'=> $data->productdescription,
																		    'colours'=> $data->colours,
																				'product_type'=>$producttype,
																		    // 'inventory'=> $data->inventory
																		);
																		}

																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$products
																					);

																					echo json_encode($res);


																		}
																		//most popular product slider
																		public function get_allproductlimit(){

																		            $this->db->select('*');
																		$this->db->from('tbl_products');
																		$this->db->limit(10);
																		$productslimitdata= $this->db->get();
																		$products=[];
																		foreach($productslimitdata->result() as $limit) {

																			//category
																		      			$this->db->select('*');
																		$this->db->from('tbl_category');
																		$this->db->where('id',$limit->category_id);
																		$cat= $this->db->get()->row();
												if(!empty($cat)){
													$c1=$cat->categoryname;
												}
												else{
													$c1="";
												}


																		//subcategory
																		$this->db->select('*');
																			$this->db->from('tbl_subcategory');
																		$this->db->where('id',$limit->subcategory_id);
																		$sub= $this->db->get()->row();
												if(!empty($sub)){
													$s1=$sub->name;
												}else{
													$s1="";
												}

																		//type --
																		$this->db->select('*');
																			$this->db->from('tbl_type');
																		$this->db->where('product_id',$limit->id);
																		$typ= $this->db->get();
																		$producttype=[];
																		foreach($typ->result() as $type){

																		$producttype[]=array(
																		'type_id'=>$type->id,
																		'type_name'=>$type->name,
																		'MRP' =>$type->mrp,
												            'Price' =>$type->gstprice,

																		);

																		}



																		$products[] = array(
																			'product_id'=>$limit->id,
																			  'productname'=> $limit->name,
																			  'category'=> $c1,
																			  'sucategory'=> $s1,
																				'productimage'=> base_url().$limit->image,
																				'productimage1'=> base_url().$limit->image1,
																				'productimage2'=> base_url().$limit->image2,
																				'productimage3'=> base_url().$limit->image3,
																				'productimage4'=> base_url().$limit->image4,
																		    'mrp'=> $limit->mrp,
																		    'productdescription'=> $limit->productdescription,
																		    'colours'=> $limit->colours,
																				'product_type'=>$producttype,
																		    // 'inventory'=> $data->inventory
																		);
																		}

																		header('Access-Control-Allow-Origin: *');
																		$res = array('message'=>"success",
																					'status'=>200,
																		      'data'=>$products
																					);

																					echo json_encode($res);


																		}

												//add to cart api insert data
																		public function addtocart(){

																$this->load->helper(array('form', 'url'));
																$this->load->library('form_validation');
																$this->load->helper('security');
																if($this->input->post())
																{
																	// print_r($this->input->post());
																	// exit;
																	$this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
																	$this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
																	$this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');
																	$this->form_validation->set_rules('email_id', 'email_id', 'xss_clean|trim');
																	$this->form_validation->set_rules('password', 'password', 'xss_clean|trim');
																	$this->form_validation->set_rules('token_id', 'token_id', 'xss_clean|trim');

																	if($this->form_validation->run()== TRUE)
																	{
																		$product_id=$this->input->post('product_id');
																		$type_id=$this->input->post('type_id');
																		$quantity=$this->input->post('quantity');
																		$email_id=$this->input->post('email_id');
																		$password=$this->input->post('password');
																		$token_id=$this->input->post('token_id');

																		if(!empty($email_id) || !empty($password)){

                                    $this->db->select('*');
                                                $this->db->from('tbl_users');
                                                $this->db->where('email',$email_id);
                                                $this->db->where('password',$password);
                                                $dsa= $this->db->get();
                                                $da=$dsa->row();
                                              if(!empty($da)){
                                                $user_id=$da->id;
																								$password=$da->password;



																							}else{
																								$res = array('message'=>"email id  or password wrong",
																					'status'=>200
																					);

																					echo json_encode($res);
																					exit;


																										}



																																						$this->db->select('*');
																																						            $this->db->from('tbl_cart');
																																						            $this->db->where('product_id',$product_id);
																																						            $this->db->where('type_id',$type_id);

																																						            $this->db->where('user_id',$user_id);

																																						            $dsa= $this->db->get();
																																						            $da=$dsa->row();
																																						if(!empty($da)){
																																							$res = array('message'=>"Already added cart data",
																																										'status'=>201
																																										);

																																										echo json_encode($res);
																																						  exit();
																																						}else{



																																									$data_insert = array('product_id'=>$product_id,
																																														'type_id'=>$type_id,
																																														'quantity'=>$quantity,
																																														'user_id'=>$user_id,
																																														'quantity'=>$quantity,

																																														'token_id'=>$token_id


																																														);


																																						}


																																									$last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;





																																									if($last_id!=0){

																																										$res = array('message'=>"success",
																																							'status'=>200
																																							);

																																							echo json_encode($res);

																																																							}

																																																							else

																																																							{

																																																								$res = array('message'=>"Sorry error occured",
																																																											'status'=>201
																																																											);

																																																											echo json_encode($res);




																																																							}


																		}
																		else{


if(empty($token_id)){

	$res = array('message'=>"please enter token_id",
				'status'=>201
				);

				echo json_encode($res);
	exit;
}




												$this->db->select('*');
												            $this->db->from('tbl_cart');
												            $this->db->where('product_id',$product_id);
												            $this->db->where('type_id',$type_id);


												            $dsa= $this->db->get();
												            $da=$dsa->row();
												if(!empty($da)){
													$res = array('message'=>"Already added cart data",
																'status'=>201
																);

																echo json_encode($res);
												  exit();
												}else{



															$data_insert = array('product_id'=>$product_id,
																				'type_id'=>$type_id,
																				'quantity'=>$quantity,



																				'token_id'=>$token_id


																				);


												}


															$last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;





															if($last_id!=0){

																$res = array('message'=>"success",
													'status'=>200
													);

													echo json_encode($res);

																													}

																													else

																													{

																														$res = array('message'=>"Sorry error occured",
																																	'status'=>201
																																	);

																																	echo json_encode($res);




																													}
																												}



																	}
																else{
																	$res = array('message'=>validation_errors(),
																				'status'=>201
																				);

																				echo json_encode($res);


																}

																}
															else{

																$res = array('message'=>"Please insert some data, No data available",
																			'status'=>201
																			);

																			echo json_encode($res);

															}
													}



												//add to cart get api

												public function get_addcart(){



																													$this->load->helper(array('form', 'url'));
																													$this->load->library('form_validation');
																													$this->load->helper('security');
																													if($this->input->post())
																													{
																														// print_r($this->input->post());
																														// exit;
																														$this->form_validation->set_rules('token_id', 'token_id', 'xss_clean|trim');
																														$this->form_validation->set_rules('email_id', 'email_id', 'valid_email|xss_clean|trim');
																														$this->form_validation->set_rules('password', 'password', 'xss_clean|trim');


																														if($this->form_validation->run()== TRUE)
																														{
																															$token_id=$this->input->post('token_id');
																															$email_id=$this->input->post('email_id');
																															$password=$this->input->post('password');

                                                           if($token_id==NULL && $email_id==NULL && $password==NULL){

                                                               echo "please insert data";
																															 exit;

																													 }



																										if(!empty($email_id) || !empty($password)){

                                                        $this->db->select('*');
                                                                    $this->db->from('tbl_users');
                                                                    $this->db->where('email',$email_id);
                                                                    $this->db->where('password',$password);
                                                                    $dsa= $this->db->get();
                                                                    $da=$dsa->row();
                                                                     if(!empty($da)){
																																			 $user_id=$da->id;
																																				$password=$da->password;
																																		 }else{

																																			 $res = array('message'=>"email and password not match",
																															 							'status'=>201
																															 							);

																															 							echo json_encode($res);
																																						exit;


																																		 }

																																		 $this->db->select('*');
																																		             $this->db->from('tbl_cart');
																																		             $this->db->where('user_id',$user_id);
																																		             $dsa4= $this->db->get();
																																		             $da=$dsa4->row();
																																		     if(empty($da)){
																																					 $res = array('message'=>"this email and password no data",
																																								 'status'=>201
																																								 );

																																								 echo json_encode($res);
																																						 exit;


																																				 }




																																					$this->db->select('*');
																															           	$this->db->from('tbl_cart');
																																				  	$this->db->where('user_id',$user_id);
																																					$data= $this->db->get();
																																					//$ta=$data->row();
																																					$addcart=[];
																																					$subtotal=0;


																																					foreach ($data->result() as $value) {



																																						//product
																																					$this->db->select('*');
																																					            $this->db->from('tbl_products');
																																					            $this->db->where('id',$value->product_id);
																																					            $dsa= $this->db->get();
																																					            $da=$dsa->row();
																																											if(!empty($da)){

																																												$d3=$da->id;
																																												$d1=$da->name;
																																												$d2=$da->image;
																																											}else{
																																												$d1="";
																																											}

																																					//type
																																					$this->db->select('*');
																																					            $this->db->from('tbl_type');
																																					            $this->db->where('id',$value->type_id);
																																					            $ds= $this->db->get();
																																					            $ty=$ds->row();
																																											if(!empty($ty)){
																																												$t0=$ty->id;
																																												$t1=$ty->name;
																																												$t2=$ty->gstprice;
																																												$quan=$value->quantity;
																																												$total=$t2* $quan;

																																											}else{
																																												$t1="";
																																												$t2="";
																																											}


																																						//quantity



																																						$addcart[]=array(
																																							'token_id'=>$value->token_id,

																																							'product_id'=>$d3,
																																							'product_name'=>$d1,
																																							'product_image'=>$d2,
                                                                                'type_id'=>$t0,
																																							'type_Name'=>$t1,
																																							'Price'=>$t2,
																																							'Quantity'=>$quan,
																																							'total_cost'=>$total
																																						);
																																					$subtotal= $subtotal + $total ;





																																				}



																																			}



else{


        $this->db->select('*');
            $this->db->from('tbl_cart');
            $this->db->where('token_id',$token_id);
            $dsa44= $this->db->get();
            $da4=$dsa44->row();
						if(empty($da4)){

							$res = array('message'=>"wrong enterd token_id please check",
										'status'=>201
										);

										echo json_encode($res);
								die();


						}








												      			$this->db->select('*');
												$this->db->from('tbl_cart');
												$this->db->where('token_id',$token_id);
												$data= $this->db->get();
												//$ta=$data->row();
												$addcart=[];
												$subtotal=0;




												foreach ($data->result() as $value) {
																										//product
																																$this->db->select('*');
																																            $this->db->from('tbl_products');
																																            $this->db->where('id',$value->product_id);
																																            $dsa= $this->db->get();
																																            $da=$dsa->row();
																																						if(!empty($da)){

																																							$d3=$value->product_id;
																																							$d1=$da->name;
																																							$d2=$da->image;
																																						}else{
																																							$d1="";
																																						}

																																//type
																																$this->db->select('*');
																																            $this->db->from('tbl_type');
																																            $this->db->where('id',$value->type_id);
																																            $ds= $this->db->get();
																																            $ty=$ds->row();
																																						if(!empty($ty)){
																																							$t0=$ty->id;
																																							$t1=$ty->name;
																																							$t2=$ty->gstprice;
																																							$quan=$value->quantity;
																																							$total=$t2* $quan;

																																						}else{
																																							$t1="";
																																							$t2="";
																																						}


																																	//quantity



																																	$addcart[]=array(
																																		'token_id'=>$value->token_id,

																																		'product_id'=>$d3,
																																		'product_name'=>$d1,
																																		'product_image'=>$d2,
                                                                    'type_id'=>$t0,
																																		'type_Name'=>$t1,
																																		'Price'=>$t2,
																																		'Quantity'=>$quan,
																																		'total_cost'=>$total
																																	);
																																$subtotal= $subtotal + $total ;





											                           	}



			}



																																									header('Access-Control-Allow-Origin: *');
																																										$res = array('message'=>"success",
																																													'status'=>200,
																																													'data'=>$addcart,
																																													'sub_total'=>$subtotal
																																													);

																																													echo json_encode($res);


		}else{
				$res = array('message'=>validation_errors(),
							'status'=>201
							);

							echo json_encode($res);


			}

}else{

$res = array('message'=>"please insert data",
'status'=>201
);

echo json_encode($res);


}










												}




												//custom order ----
												public function customorder(){

													$this->load->helper(array('form', 'url'));
													$this->load->library('form_validation');
													$this->load->helper('security');
													if($this->input->post())
													{
														// print_r($this->input->post());
														// exit;
														$this->form_validation->set_rules('firstname', 'firstname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('lastname', 'lastname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('businessname', 'businessname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
														$this->form_validation->set_rules('message', 'message', 'required|xss_clean|trim');


														if($this->form_validation->run()== TRUE)
														{
															$firstname=$this->input->post('firstname');
															$lastname=$this->input->post('lastname');
															$businessname=$this->input->post('businessname');
															$email=$this->input->post('email');
															$message=$this->input->post('message');


												$this->load->library('upload');

												//image1 code
												$img1='image1';

												            $file_check=($_FILES['image1']['error']);
												            if($file_check!=4){
												          	$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
												  						if (!file_exists($image_upload_folder))
												  						{
												  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
												  						}
												  						$new_file_name="customproduct".date("Ymdhms");
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
												  							echo $upload_error;
												  						}
												  						else
												  						{

												  							$file_info = $this->upload->data();

												  							$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
												  							$file_info['new_name']=$videoNAmePath;
												  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
												  							$nnnn=$file_info['file_name'];
												  							// echo json_encode($file_info);
												  						}
												            }


													//image2
													$img1='image2';

													            $file_check=($_FILES['image2']['error']);
													            if($file_check!=4){
													          	$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
													  						if (!file_exists($image_upload_folder))
													  						{
													  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
													  						}
													  						$new_file_name="customproduct".date("Ymdhms");
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
													  							echo $upload_error;
													  						}
													  						else
													  						{

													  							$file_info = $this->upload->data();

													  							$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
													  							$file_info['new_name']=$videoNAmePath;
													  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
													  							$nnnn1=$file_info['file_name'];
													  							// echo json_encode($file_info);
													  						}
													            }

												//image3

												$img1='image3';

												            $file_check=($_FILES['image3']['error']);
												            if($file_check!=4){
												          	$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
												  						if (!file_exists($image_upload_folder))
												  						{
												  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
												  						}
												  						$new_file_name="customproduct".date("Ymdhms");
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
												  							echo $upload_error;
												  						}
												  						else
												  						{

												  							$file_info = $this->upload->data();

												  							$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
												  							$file_info['new_name']=$videoNAmePath;
												  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
												  							$nnnn2=$file_info['file_name'];
												  							// echo json_encode($file_info);
												  						}
												            }


													//image4
													$img1='image4';

													            $file_check=($_FILES['image4']['error']);
													            if($file_check!=4){
													          	$image_upload_folder = FCPATH . "assets/uploads/team/";
													  						if (!file_exists($image_upload_folder))
													  						{
													  							mkdir($image_upload_folder, DIR_WRITE_MODE, true);
													  						}
													  						$new_file_name="customproduct".date("Ymdhms");
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
													  							echo $upload_error;
													  						}
													  						else
													  						{

													  							$file_info = $this->upload->data();

													  							$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
													  							$file_info['new_name']=$videoNAmePath;
													  							// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
													  							$nnnn3=$file_info['file_name'];
													  							// echo json_encode($file_info);
													  						}
													            }

																$ip = $this->input->ip_address();
												date_default_timezone_set("Asia/Calcutta");
																$cur_date=date("Y-m-d H:i:s");

																$addedby=$this->session->userdata('admin_id');



												$data_insert = array('firstname'=>$firstname,
																	'lastname'=>$lastname,
																	'businessname'=>$businessname,
																	'email'=>$email,
																	'message'=>$message,
																	'image1'=>$nnnn,
																	'image2'=>$nnnn1,
																	 'image3'=>$nnnn2,
																	 'image4'=>$nnnn3



																	);





												$last_id=$this->base_model->insert_table("tbl_customorder",$data_insert,1) ;


																								if($last_id!=0){
																									$res = array('message'=>"success",
																								'status'=>200
																								);

																								echo json_encode($res);

																								}else{

																									$res = array('message'=>"sorry error occured",
																									'status'=>201
																									);

																									echo json_encode($res);


																								}


																													}
																												else{
																													$res = array('message'=>validation_errors(),
																																'status'=>201
																																);

																																echo json_encode($res);


																												}

												}else{

													$res = array('message'=>"please insert data",
													'status'=>201
													);

													echo json_encode($res);


												}

											}
												//corporate ----

												public function corporate(){

													$this->load->helper(array('form', 'url'));
													$this->load->library('form_validation');
													$this->load->helper('security');
													if($this->input->post())
													{
														// print_r($this->input->post());
														// exit;
														$this->form_validation->set_rules('firstname', 'firstname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('lastname', 'lastname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('businessname', 'businessname', 'required|xss_clean|trim');
														$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
														$this->form_validation->set_rules('message', 'message', 'required|xss_clean|trim');


														if($this->form_validation->run()== TRUE)
														{
															$firstname=$this->input->post('firstname');
															$lastname=$this->input->post('lastname');
															$businessname=$this->input->post('businessname');
															$email=$this->input->post('email');
															$message=$this->input->post('message');

																$ip = $this->input->ip_address();
												date_default_timezone_set("Asia/Calcutta");
																$cur_date=date("Y-m-d H:i:s");

																$addedby=$this->session->userdata('admin_id');



												$data_insert = array('firstname'=>$firstname,
																	'lastname'=>$lastname,
																	'businessname'=>$businessname,
																	'email'=>$email,
																	'message'=>$message,



																	);





												$last_id=$this->base_model->insert_table("tbl_corporate",$data_insert,1) ;


																								if($last_id!=0){
																									$res = array('message'=>"success",
																								'status'=>200
																								);

																								echo json_encode($res);

																								}else{

																									$res = array('message'=>"sorry error occured",
																									'status'=>201
																									);

																									echo json_encode($res);


																								}


																													}
																												else{
																													$res = array('message'=>validation_errors(),
																																'status'=>201
																																);

																																echo json_encode($res);


																												}

												}else{

													$res = array('message'=>'No data are available',
																'status'=>201
																);

																echo json_encode($res);


												}

												}

												//delete to cat api
												public function deletecart($id,$idd,$id1){



												$this->db->where("user_id",$id);
												$this->db->where("product_id",$idd);
												$this->db->where("type_id",$id1);

												$this->db->delete('tbl_cart');



																																		 $res = array('message'=>"success",
												 																					'status'=>200
												 																					);

												 																					echo json_encode($res);



												             }


												public function addressadd(){



												          	$this->load->helper(array('form', 'url'));
												            $this->load->library('form_validation');
												            $this->load->helper('security');
												            if($this->input->post())
												            {
												              // print_r($this->input->post());
												              // exit;
												              $this->form_validation->set_rules('address', 'address', 'required|customTextbox|xss_clean');
												              $this->form_validation->set_rules('pincode', 'pincode', 'required|xss_clean');
												              $this->form_validation->set_rules('state', 'state', 'required|xss_clean');
												              $this->form_validation->set_rules('city', 'city', 'required|xss_clean');
												              $this->form_validation->set_rules('email_id', 'email_id', 'required|xss_clean');
												              $this->form_validation->set_rules('password', 'password', 'required|xss_clean');

												              if($this->form_validation->run()== TRUE)
												              {
												                $address=$this->input->post('address');
												                $pincode=$this->input->post('pincode');
												                $state=$this->input->post('state');
												                $city=$this->input->post('city');
												                $email_id=$this->input->post('email_id');
												                $password=$this->input->post('password');



												                  $ip = $this->input->ip_address();
												          date_default_timezone_set("Asia/Calcutta");
												                  $cur_date=date("Y-m-d H:i:s");

												                  $addedby=$this->session->userdata('admin_id');

												              			$this->db->select('*');
												        $this->db->from('tbl_users');
												        $this->db->where('email',$email_id);
												        $this->db->where('password',$password);
												        $data= $this->db->get();
												        $da=$data->row();

																if(empty($da)){

																	$res = array('message'=>'email_id and password not match',
																	'status'=>201
																	);

																	echo json_encode($res);
																	exit;


																}else{
												          $data_insert = array('address'=>$address,
												                    'pincode'=>$pincode,
												                    'state'=>$state,
												                    'city'=>$city,
																						'user_id'=>$da->id,
												                    'ip' =>$ip


												                    );


}


												          $last_id=$this->base_model->insert_table("tbl_address",$data_insert,1) ;

																	if($last_id!=0){
																		$res = array('message'=>"success",
																	'status'=>200
																	);

																	echo json_encode($res);

																	}else{

																		$res = array('message'=>"sorry error occured",
																		'status'=>201
																		);

																		echo json_encode($res);


																	}


																						}
																					else{
																						$res = array('message'=>validation_errors(),
																									'status'=>201
																									);

																									echo json_encode($res);


																					}

																}else{

																$res = array('message'=>'No data are available',
																'status'=>201
																);

																echo json_encode($res);
															}

																}


												//footer subscription
												public function subscription(){

													$this->load->helper(array('form', 'url'));
													$this->load->library('form_validation');
													$this->load->helper('security');
													if($this->input->post())
													{

														$this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');

														if($this->form_validation->run()== TRUE)
														{

															$email=$this->input->post('email');

																$ip = $this->input->ip_address();
												date_default_timezone_set("Asia/Calcutta");
																$cur_date=date("Y-m-d H:i:s");

												$this->db->select('*');
												            $this->db->from('tbl_subscription');
												            $this->db->where('Email_id',$email);
												            $dsa= $this->db->get();
												            $da=$dsa->row();
												    if(!empty($da)){

															$res = array('message'=>"email already exist.",
														 'status'=>201
														 );

														 echo json_encode($res);
												exit;

														}


																$addedby=$this->session->userdata('admin_id');


												$data_insert = array('Email_id'=>$email,
																	'ip' =>$ip


																	);





												$last_id=$this->base_model->insert_table("tbl_subscription",$data_insert,1) ;

												if($last_id!=0){
													$res = array('message'=>"success",
												'status'=>200
												);

												echo json_encode($res);

												}else{

													$res = array('message'=>"sorry error occured",
													'status'=>201
													);

													echo json_encode($res);


												}


																	}
																else{
																	$res = array('message'=>validation_errors(),
																				'status'=>201
																				);

																				echo json_encode($res);


																}

												}else{

												$res = array('message'=>'No data are available',
												'status'=>201
												);

												echo json_encode($res);
												}

					}



								//order 1 api----------------------

					            public function view_order(){

											      			$this->db->select('*');
											$this->db->from('tbl_order1');
											//$this->db->where('id',$usr);
											$data= $this->db->get();
					  $payment="";
					            $viewcart=[];
											foreach ($data->result() as $value) {
					//payment type
					         $paymentstatus=$value->payment_status;
					         $payment=$value->payment_type;
									 if($payment == 1  || $payment == 2){
					           $var="cash on delivery";


									 }
									 if($paymentstatus == 1 ){
										 $status="order success";
									 }else{
										 $status = "order pending";
									 }


					  $newdate = new DateTime($value->date);
					  $d2=$newdate->format('d-m-Y');   #d-m-Y  // March 10, 2001, 5:16 pm


												$viewcart[]=array(
						                 'order_id'=>$value->id,
														 'order_date'=>$d2,
														 'total_amount'=>$value->total_amount,
														 'payment_type'=> $var,
														 'payment_status'=> $status,

														  'delevery_charge'=>$value->delivery_charge,
															'promocode_id'=>$value->promocode_id,
															'discount'=>$value->discount
												);

											}
											header('Access-Control-Allow-Origin: *');
											$res = array('message'=>"success",
														'status'=>200,
														'data'=>$viewcart
														);

														echo json_encode($res);




											}

					//------------------------------------



					//-------------order detail-------------------
					public function orderdetail(){

					      			$this->db->select('*');
					$this->db->from('tbl_order1');
					//$this->db->where('id',$usr);
					$order= $this->db->get();

					$order2=[];
					foreach ($order->result() as $value) {
						$new = $value->id;
					//order2
						$this->db->select('*');
												$this->db->from('tbl_order2');
												$this->db->where('main_id',$new);
												$dsa= $this->db->get();
												$da=$dsa->row();
					if(!empty($da)){
					$p_id=$da->product_id;
					$quan=$da->quantity;
					$total_amount=$da->total_amount;
					$type_id=$da->type_id;
					$daa=$da->gst;
					$daa1=$da->gst_percentage;




					}else{
					$p_id="";
					$daa1="";
					$daa="";
					$type_id="";
					$total_amount="";
					$quan="";


					}
					//product table
					$this->db->select('*');
					            $this->db->from('tbl_products');
					            $this->db->where('id',$p_id);
					            $dsa1= $this->db->get();
					            $fa=$dsa1->row();
					          if(!empty($fa)){
											$var=$fa->name;

										}


                   //type--------------
									$this->db->select('*');
									            $this->db->from('tbl_type');
									            $this->db->where('id',$type_id);
									            $dsa2= $this->db->get();
									            $da2=$dsa2->row();
															if(!empty($da2)){
                               $t_name=$da2->name;
															 $t_gst=$da2->spgst;
															 $t_gstprice=$da2->gstprice;



															}


								//cart
								$this->db->select('*');
								            $this->db->from('tbl_cart');
								            $this->db->where('product_id',$p_id);
								            $ds= $this->db->get();
								            $dafa=$ds->row();
								           if(!empty($dafa)) {
                            $faa=$dafa->quantity;


													 }



						$order2[]=array(
					     'product_name' =>$var,
							 'quantity'=> $faa,
							 'total amount'=>$value->total_amount,
							 'type_name'=>$t_name,
							 'Price'=>$t_gst,
							 'Gst'=>$t_gstprice




						);

					}

					$res = array('message'=>"success",
								 'status'=>200,
								 'data'=>$order2
								 );

								 echo json_encode($res);

					}


					//prmocode api

     // public function promocode(){
		 //
		 //
		 //
			//  													$this->load->helper(array('form', 'url'));
			//  													$this->load->library('form_validation');
			//  													$this->load->helper('security');
			//  													if($this->input->post())
			//  													{
		 //
			//  														$this->form_validation->set_rules('prmocode_name', 'prmocode_name', 'required|valid_email|xss_clean');
		 //
			//  														if($this->form_validation->run()== TRUE)
			//  														{
		 //
			//  															$prmocode_name=$this->input->post('prmocode_name');
		 //
			//  																$ip = $this->input->ip_address();
			//  												date_default_timezone_set("Asia/Calcutta");
			//  																$cur_date=date("Y-m-d H:i:s");
		 //
		 //
			// 										   $addedby=$this->session->userdata('admin_id');
		 //
     //                           $this->db->select('*');
     //                                       $this->db->from('tbl_promocode');
     //                                       $this->db->where('promocode',$prmocode_name);
     //                                       $this->db->where('is_active',1);
     //                                       $dsa= $this->db->get();
     //                                       $prmo=$dsa->row();
     //                                    if(!empty($prmo)) {
     //                                   $p_id=$prmo->id;
			// 																 $p_name=$prmo->promocode;
			// 																 $p_rate=$prmo->giftpercent;
		 //
		 //
			// 																	}else{
		 //
			// 																		$res = array('message'=>'It is not valid prmocode',
			// 																					'status'=>201
			// 																					);
		 //
			// 																					echo json_encode($res);
		 //
			// 																	}
		 //
			// 															//prmocode id match of table tbl_order1
			// 															  $this->db->select('*');
			// 															              $this->db->from('tbl_order1');
			// 															              $this->db->where('promocode_id',$p_name);
			// 															              $dsa= $this->db->get();
			// 															              $order=$dsa->row();
			// 															           if(!empty($order)){
		 //
     //                                               $user_id=$order->user_id;
		 //
			// 																				 }else{
		 //
			// 																					 $res = array('message'=>'please add product cart',
			// 																								'status'=>201
			// 																								);
		 //
			// 																								echo json_encode($res);
		 //
			// 																				 }
		 //
			// 																	//cart table
		 //
			// 																	$this->db->select('*');
			// 																	            $this->db->from('tbl_');
			// 																	            $this->db->where('_id',$id);
			// 																	            $dsa= $this->db->get();
			// 																	            $da=$dsa->row();
			// 																	            echo $da->name;
		 //
		 //
		 //
		 //
		 //
		 //
		 //
		 //
			// 										 }
			// 										else{
			// 											$res = array('message'=>validation_errors(),
			// 														'status'=>201
			// 														);
		 //
			// 														echo json_encode($res);
		 //
		 //
			// 										}
		 //
			// 						}else{
		 //
			// 						$res = array('message'=>'No data are available',
			// 						'status'=>201
			// 						);
		 //
			// 						echo json_encode($res);
			// 						}
		 //
		 //
		 //
		 //
		 //
		 //
		 //
		 //
		 // }

					//---------------------------------------------

//count view cart product

public function cart_count(){

	$this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

 	 $this->form_validation->set_rules('token_id', 'token_id', 'xss_clean|trim');
 	 $this->form_validation->set_rules('email_id', 'email_id', 'valid_email|xss_clean|trim');
 	 $this->form_validation->set_rules('password', 'password', 'xss_clean|trim');

 	 if($this->form_validation->run()== TRUE)
 	 {

 		 $token_id=$this->input->post('token_id');
 		 $email_id=$this->input->post('email_id');
 		 $password=$this->input->post('password');

		 if($token_id==NULL && $email_id==NULL && $password==NULL){
			 $res = array('message'=>"data is not insert",
		 			 'status'=>201,

		 			 );

		 			 echo json_encode($res);
		 			 exit();

		 }


			if(!empty($email_id) || !empty($password)){

            $this->db->select('*');
                        $this->db->from('tbl_users');
                        $this->db->where('email',$email_id);
                        $this->db->where('password',$password);
                        $dsa= $this->db->get();
                        $user=$dsa->row();
												if(!empty($user)){
                        $user_id=$user->id;
												$pass=$user->password;

											}else{

												$res = array('message'=>"email or passwod not match",
		 				 								 'status'=>201,

		 				 								 );

		 				 								 echo json_encode($res);
														 exit();

											}


											$this->db->select('*');
											            $this->db->from('tbl_cart');
											            $this->db->where('user_id',$user_id);

																	$counting=$this->db->count_all_results();
																	if(!empty($counting)){



																	$res = array('message'=>"success",
																				 'status'=>200,
																				 'data'=>$counting
																				 );

																				 echo json_encode($res);

}else{
	$res = array('message'=>"no add product cart",
				 'status'=>200,

				 );

				 echo json_encode($res);
            exit();

}


			}else{

  $this->db->select('*');
              $this->db->from('tbl_cart');
              $this->db->where('token_id',$token_id);
              $counting=$this->db->count_all_results();
							if(!empty($check1)){


								 $counting= count($counting);




							}else{

								$res = array('message'=>"wrong token_id",
										 'status'=>201,

										 );

										 echo json_encode($res);
										 exit();

							}


							$res = array('message'=>"success",
										 'status'=>200,
										 'data'=>$counting
										 );

										 echo json_encode($res);






			   }

		}
		else{
		$res = array('message'=>validation_errors(),
					'status'=>201
					);

					echo json_encode($res);


		}

		}else{

		$res = array('message'=>'No data are available',
		'status'=>201
		);

		echo json_encode($res);
		}




}





}
