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
						$cat= $this->db->get()->row();;



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
					$this->form_validation->set_rules('user_id', 'user_id', 'xss_clean|trim');
					$this->form_validation->set_rules('device_id', 'device_id', 'xss_clean|trim');

					if($this->form_validation->run()== TRUE)
					{
						$product_id=$this->input->post('product_id');
						$type_id=$this->input->post('type_id');
						$quantity=$this->input->post('quantity');
						$user_id=$this->input->post('user_id');
						$device_id=$this->input->post('device_id');

$this->db->select('*');
            $this->db->from('tbl_cart');
            $this->db->where('product_id',$product_id);
            $this->db->where('type_id',$type_id);
            $dsa= $this->db->get();
            $da=$dsa->row();
if(!empty($da)){
	$res = array('message'=>"Already added cart",
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
								'device_id'=>$device_id,


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

      			$this->db->select('*');
$this->db->from('tbl_cart');
//$this->db->where('id',$usr);
$data= $this->db->get();
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
							$d1=$da->name;
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
		'product_name'=>$d1,
		'type_Name'=>$t1,
		'Price'=>$t2,
		'Quantity'=>$quan,
		'total_cost'=>$total
	);
$subtotal= $subtotal + $total ;
}

	header('Access-Control-Allow-Origin: *');
	$res = array('message'=>"success",
				'status'=>200,
				'data'=>$addcart,
				'sub_total'=>$subtotal
				);

				echo json_encode($res);


}




}
