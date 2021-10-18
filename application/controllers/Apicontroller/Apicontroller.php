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

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
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

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
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
public function get_all_category(){

$this->db->select('*');
$this->db->from('tbl_category');
$categorydata= $this->db->get();
$category=[];
foreach($categorydata->result() as $data) {

$this->db->select('*');
$this->db->from('tbl_subcategory');
$this->db->where('category',$data->id);
$sub= $this->db->get();
$subcategory=[];
foreach($sub->result() as $sub2) {

$subcategory[] = array(
'sub_id' => $sub2->id,
'name'=> $sub2->subcategory



);
}
// $catt=array('name'=> $data->categoryname,'sub_name'=>$subcategory);

$cat[] = array(
'category_id' =>$data->id,
'name' =>$data->title,
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
public function get_all_products(){

$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{


// print_r($this->input->post());
// exit;
$this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{

$subcategory_id=$this->input->post('subcategory_id');


$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('subcategory',$subcategory_id);
$product_data= $this->db->get();

// print_r($product_data);
// exit;

$product_check=$product_data->row();


if(!empty($product_check)){

$product_data1 = [];

foreach($product_data->result() as $data) {

$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('product_id',$data->id);
$type_info= $this->db->get();

$type_check=$type_info->row();

if(!empty($type_check)){
$type_data= [];
foreach($type_info->result() as $data1) {

$type_data[] = array(

'type_id'=>$data1->id,
'type_name'=>$data1->name,
'type_price'=>$data1->gstprice,

);
}
$product_data1[]= array(
'product_id'=>$data->id,
'product_name'=>$data->productname,
'description'=>$data->productdescription,
'image'=>base_url().$data->image,
'type'=>$type_data,
);


}
}

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200,
'data'=>$product_data1
);

echo json_encode($res);


}}
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



//all product detail using id  single detail  product
public function get_all_products_detail($id){

$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$id);
$productsdata= $this->db->get();
$products=[];
foreach($productsdata->result() as $data) {

//category
$this->db->select('*');
$this->db->from('tbl_category');
$this->db->where('id',$data->category);
$cat= $this->db->get()->row();



//subcategory
$this->db->select('*');
$this->db->from('tbl_subcategory');
$this->db->where('id',$data->subcategory);
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
'productname'=> $data->productname,

'category'=> $cat->title,
'sucategory'=> $sub->subcategory,
'productimage'=> base_url().$data->image,
'productimage1'=> base_url().$data->image1,
'productimage2'=> base_url().$data->image2,
'productimage3'=> base_url().$data->image3,

'mrp'=> $data->mrp,
'productdescription'=> $data->productdescription,
// 'colours'=> $data->colours,
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
//-----------most popular product slider------------
public function most_popular_products(){

$this->db->select('*');
$this->db->from('tbl_products');
$this->db->limit(10);
$productslimitdata= $this->db->get();
$products=[];
foreach($productslimitdata->result() as $limit) {

//category
$this->db->select('*');
$this->db->from('tbl_category');
$this->db->where('id',$limit->category);
$cat= $this->db->get()->row();
if(!empty($cat)){
$c1=$cat->title;
}
else{
$c1="";
}


//subcategory
$this->db->select('*');
$this->db->from('tbl_subcategory');
$this->db->where('id',$limit->subcategory);
$sub= $this->db->get()->row();
if(!empty($sub)){
$s1=$sub->subcategory;
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
'productname'=> $limit->productname,
'category'=> $c1,
'sucategory'=> $s1,
'productimage'=> base_url().$limit->image,
'productimage1'=> base_url().$limit->image1,
'productimage2'=> base_url().$limit->image2,
'productimage3'=> base_url().$limit->image3,
'mrp'=> $limit->mrp,
'productdescription'=> $limit->productdescription,
// 'colours'=> $limit->colours,
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
public function add_to_cart(){

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
$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{
$product_id=$this->input->post('product_id');
$type_id=$this->input->post('type_id');
$quantity=$this->input->post('quantity');
$email_id=$this->input->post('email_id');
$password=$this->input->post('password');
$token_id=$this->input->post('token_id');

//-------add to cart with email----------

if(!empty($email_id)){

$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email_id);
$dsa= $this->db->get();
$user_data=$dsa->row();
if(!empty($user_data)){

if($user_data->password==$password){

$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('user_id',$user_data->id);
$this->db->where('product_id',$product_id);
$this->db->where('type_id',$type_id);
$dsa= $this->db->get();
$cart_data=$dsa->row();

if(empty($cart_data)){

$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");

$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$product_id);
$product_data= $this->db->get()->row();
$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$type_id);
$type_data= $this->db->get()->row();


if(!empty($product_data)){

if(!empty($type_data)){

$data_insert = array('product_id'=>$product_id,
'type_id'=>$type_id,
'quantity'=>$quantity,
'user_id'=>$user_data->id,
'token_id'=>$token_id,
'ip' =>$ip,
'date'=>$cur_date

);

$last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;


if(!empty($last_id)){
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'type_id is not exist',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Product_id is not exist',
'status'=>201
);

echo json_encode($res);

}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Product is already in cart',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Passwod does not match',
'status'=>201
);

echo json_encode($res);

}


}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Email is not exist',
'status'=>201
);

echo json_encode($res);
}

}
//-----add to cart with token id------
else{

// echo $type_id;
// exit;
$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('token_id',$token_id);
$this->db->where('product_id',$product_id);
$this->db->where('type_id',$type_id);
$dsa= $this->db->get();
$cart_data=$dsa->row();
// print_r($cart_data);
// exit;
if(empty($cart_data)){

$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
$cur_date=date("Y-m-d H:i:s");
$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$product_id);
$product_data= $this->db->get()->row();
$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$type_id);
$type_data= $this->db->get()->row();


if(!empty($product_data)){

if(!empty($type_data)){

$data_insert = array('product_id'=>$product_id,
'type_id'=>$type_id,
'quantity'=>$quantity,
'token_id'=>$token_id,
'ip' =>$ip,
'date'=>$cur_date

);

$last_id=$this->base_model->insert_table("tbl_cart",$data_insert,1) ;


if(!empty($last_id)){
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'type_id is not exist',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Product_id is not exist',
'status'=>201
);

echo json_encode($res);

}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Product is already in cart',
'status'=>201
);

echo json_encode($res);
}

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

//------delete product cart-----
public function delete_cart_product(){

$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{
// print_r($this->input->post());
// exit;
$this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
$this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
$this->form_validation->set_rules('email_id', 'email_id', 'xss_clean|trim');
$this->form_validation->set_rules('password', 'password', 'xss_clean|trim');
$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{
$product_id=$this->input->post('product_id');
$type_id=$this->input->post('type_id');
$email_id=$this->input->post('email_id');
$password=$this->input->post('password');
$token_id=$this->input->post('token_id');

//-------delete with email----------

if(!empty($email_id)){

$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email_id);
$dsa= $this->db->get();
$user_data=$dsa->row();
if(!empty($user_data)){

if($user_data->password==$password){

//             $this->db->select('*');
// $this->db->from('tbl_cart');
// $this->db->where('user_id',$user_data->id);
// $this->db->where('$product_id',$product_id);
// $this->db->where('$type_id',$type_id);
// $cart_data= $this->db->get()->row();

$zapak=$this->db->delete('tbl_cart', array('user_id' => $user_data->id,'product_id'=>$product_id,'type_id'=>$type_id));

// echo $zapak;
// exit;
if(!empty($zapak)){
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}

}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Passwod does not match',
'status'=>201
);

echo json_encode($res);

}


}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Email is not exist',
'status'=>201
);

echo json_encode($res);
}

}
//-----delete with token id------
else{


$zapak=$this->db->delete('tbl_cart', array('token_id' => $token_id,'product_id'=>$product_id,'type_id'=>$type_id));

if(!empty($zapak)){
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}


}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>validation_errors(),
'status'=>201
);

echo json_encode($res);


}

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"please insert data",
'status'=>201
);

echo json_encode($res);


}

}

//------update product cart-----
public function update_cart_product(){

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
$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{
$product_id=$this->input->post('product_id');
$type_id=$this->input->post('type_id');
$quantity=$this->input->post('quantity');
$email_id=$this->input->post('email_id');
$password=$this->input->post('password');
$token_id=$this->input->post('token_id');

//-------update with email----------

if(!empty($email_id)){

$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email_id);
$dsa= $this->db->get();
$user_data=$dsa->row();
if(!empty($user_data)){

if($user_data->password==$password){

$data_insert = array('product_id'=>$product_id,
    'type_id'=>$type_id,
    'quantity'=>$quantity

    );


$this->db->where(array('user_id'=>  $user_data->id,'product_id'=>$product_id,'type_id'=>$type_id));
$last_id=$this->db->update('tbl_cart', $data_insert);


if(!empty($last_id)){
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}

}else{

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Passwod does not match',
'status'=>201
);

echo json_encode($res);

}


}else{

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Email is not exist',
'status'=>201
);

echo json_encode($res);
}

}
//-----delete with token id------
else{

$data_insert = array('product_id'=>$product_id,
      'type_id'=>$type_id,
      'quantity'=>$quantity

      );

$this->db->where(array('token_id'=> $token_id,'product_id'=>$product_id,'type_id'=>$type_id));
$last_id=$this->db->update('tbl_cart', $data_insert);


if(!empty($last_id)){
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Some error occured',
'status'=>201
);

echo json_encode($res);
}


}
}else{
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>validation_errors(),
'status'=>201
);

echo json_encode($res);


}

}else{

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"please insert data",
'status'=>201
);

echo json_encode($res);


}

}

//add to cart get api

public function get_cart_data(){


$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{
$this->form_validation->set_rules('email_id', 'email_id', 'xss_clean|trim');
$this->form_validation->set_rules('password', 'password', 'xss_clean|trim');
$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{
$email_id=$this->input->post('email_id');
$password=$this->input->post('password');
$token_id=$this->input->post('token_id');

//-------add to cart with email----------

if(!empty($email_id)){

$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email_id);
$dsa= $this->db->get();
$user_data=$dsa->row();
if(!empty($user_data)){

if($user_data->password==$password){

$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('user_id',$user_data->id);
$cart_data= $this->db->get();
$cart_check = $cart_data->row();

if(!empty($cart_check)){
$total=0;
$sub_total=0;
$cart_info = [];
foreach($cart_data->result() as $data) {


$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$data->product_id);
$dsa= $this->db->get();
$product_data=$dsa->row();


$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$dsa= $this->db->get();
$type_data=$dsa->row();


$cart_info[] = array('product_id'=>$data->product_id,
'product_name'=>$product_data->productname,
'product_image'=>base_url().$product_data->image,
'type_id'=>$data->type_id,
'type_name'=>$type_data->name,
'quantity'=>$data->quantity,
'price'=>$type_data->gstprice,
'total='=>$total = $type_data->gstprice * $data->quantity

);
$sub_total= $sub_total + $total;
}

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200,
'data'=>$cart_info,
'subtotal'=>$sub_total
);

echo json_encode($res);

}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>' Your cart is empty',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Passwod does not match',
'status'=>201
);

echo json_encode($res);

}


}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Email is not exist',
'status'=>201
);

echo json_encode($res);
}

}
//-----add to cart with token id------
else{

// echo $token_id;
// exit;
$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('token_id',$token_id);
$cart_data= $this->db->get();
$cart_check = $cart_data->row();
// print_r($cart_check);
// exit;
if(!empty($cart_check)){
$total=0;
$sub_total=0;
$cart_info= [];
foreach($cart_data->result() as $data) {


$this->db->select('*');
  $this->db->from('tbl_products');
  $this->db->where('id',$data->product_id);
  $dsa= $this->db->get();
  $product_data=$dsa->row();


$this->db->select('*');
  $this->db->from('tbl_type');
  $this->db->where('id',$data->type_id);
  $dsa= $this->db->get();
  $type_data=$dsa->row();


$cart_info[] = array('product_id'=>$data->product_id,
    'product_name'=>$product_data->productname,
    'product_image'=>base_url().$product_data->image,
    'type_id'=>$data->type_id,
    'type_name'=>$type_data->name,
    'quantity'=>$data->quantity,
    'price'=>$type_data->gstprice,
    'total='=>$total = $type_data->gstprice * $data->quantity

    );
$sub_total= $sub_total + $total;
}

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200,
'data'=>$cart_info,
'subtotal'=>$sub_total
);

echo json_encode($res);

}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Your cart is empty',
'status'=>201
);

echo json_encode($res);
}

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
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
);

echo json_encode($res);

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"sorry error occured",
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

}else{

header('Access-Control-Allow-Origin: *');
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
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
);

echo json_encode($res);

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"sorry error occured",
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

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'No data are available',
'status'=>201
);

echo json_encode($res);


}

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

header('Access-Control-Allow-Origin: *');
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
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
);

echo json_encode($res);

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"sorry error occured",
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

}else{

header('Access-Control-Allow-Origin: *');
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

header('Access-Control-Allow-Origin: *');
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
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200
);

echo json_encode($res);

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"sorry error occured",
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

}else{

header('Access-Control-Allow-Origin: *');
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

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$order2
);

echo json_encode($res);

}



//count view cart product

public function cart_count(){

$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{

$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
$this->form_validation->set_rules('email_id', 'email_id', 'valid_email|xss_clean|trim');
$this->form_validation->set_rules('password', 'password', 'xss_clean|trim');

if($this->form_validation->run()== TRUE)
{

$token_id=$this->input->post('token_id');
$email_id=$this->input->post('email_id');
$password=$this->input->post('password');

if($token_id==NULL && $email_id==NULL && $password==NULL){
header('Access-Control-Allow-Origin: *');
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

header('Access-Control-Allow-Origin: *');
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



header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$counting
);

echo json_encode($res);

}else{
header('Access-Control-Allow-Origin: *');
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
if(!empty($counting)){


$fa= $counting;




}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"wrong token_id",
'status'=>201,

);

echo json_encode($res);
exit();

}


header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$fa
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

}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'No data are available',
'status'=>201
);

echo json_encode($res);
}




}


//-------------calculate----------------------------

public function calculate(){



						$this->load->helper(array('form', 'url'));
						$this->load->library('form_validation');
						$this->load->helper('security');
						if($this->input->post())
						{

							$this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean|trim');
							$this->form_validation->set_rules('address_email', 'address_email', 'required|valid_email|xss_clean|trim');
							$this->form_validation->set_rules('first_name', 'first_name', 'required|xss_clean|trim');
							$this->form_validation->set_rules('last_name', 'last_name', 'required|xss_clean|trim');
							$this->form_validation->set_rules('post_code', 'post_code', 'required|xss_clean|trim');
							$this->form_validation->set_rules('street_address', 'street_address', 'required|xss_clean|trim');
							$this->form_validation->set_rules('city', 'city', 'required|xss_clean|trim');
							$this->form_validation->set_rules('state', 'state', 'required|xss_clean|trim');
							$this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');

							if($this->form_validation->run()== TRUE)
							{

								$email=$this->input->post('email');
								$address_email=$this->input->post('address_email');
								$first_name=$this->input->post('first_name');
								$last_name=$this->input->post('last_name');
								$post_code=$this->input->post('post_code');
								$street_address=$this->input->post('street_address');
								$city=$this->input->post('city');
								$state=$this->input->post('state');
								$phone=$this->input->post('phone');
								$promocode=$this->input->post('promocode');

									$ip = $this->input->ip_address();
					date_default_timezone_set("Asia/Calcutta");
									$cur_date=date("Y-m-d H:i:s");


            $this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email);
$user_data= $this->db->get()->row();

if(!empty($user_data)){

            $this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('user_id',$user_data->id);
$cart_data= $this->db->get();
$cart_check = $cart_data->row();

if(!empty($cart_check)){
$price=0;
$total= 0;
$shipping_charges= 0;
$total_weight = 0;
foreach($cart_data->result() as $data) {

            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$data->product_id);
$product_data= $this->db->get()->row();

            $this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$type_data= $this->db->get()->row();


            $this->db->select('*');
$this->db->from('tbl_inventory');
$this->db->where('type_id',$data->type_id);
$inventory_data= $this->db->get()->row();

// echo $inventory_data->quantity;
// exit;
//----inventory_check----------

if($inventory_data->quantity >= $data->quantity){

  $price = $type_data->spgst * $data->quantity;
  $total = $total + $price;
  $total_weight = $total_weight +$type_data->weight;
  $shipping_charges = $total_weight * SHIPPING;





}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=> "$product_data->productname. Product is out of stock",
        'status'=>201
        );

        echo json_encode($res);
        exit;

}


}//--end_cart foreach



//--------check_promocode------
$discount = 0;
$promocode_id=0;
if(!empty($promocode)){

$promocode = strtoupper($promocode);

$this->db->select('*');
            $this->db->from('tbl_promocode');
            $this->db->like('promocode',$promocode);
            $dsa= $this->db->get();
            $promocode_data=$dsa->row();

if(!empty($promocode_data)){
$promocode_id = $promocode_data->id;
if($promocode_data->ptype==1){

$this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('user_id',$user_data->id);
            $this->db->where('promocode_id',$promocode_data->id);
            $dsa= $this->db->get();
            $promo_check=$dsa->row();

if(empty($promo_check)){

  if($total > $promocode_data->minorder){ //----checking minorder for promocode
      // echo "hii";

      $discount_amt = $total * $promocode_data->giftpercent/100;
    if($discount_amt > $promocode_data->max){
      // will get max amount
      $discount =  $promocode_data->max;

    }else{

      $discount =  $discount_amt;
    }

    }//endif of minorder
      else{

        header('Access-Control-Allow-Origin: *');
        $res = array('message'=>'Please add more products for promocode',
              'status'=>201
              );

              echo json_encode($res);
              exit;
      }



}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'Promocode is already used',
        'status'=>201
        );

        echo json_encode($res);
        exit;


}


}
//-----every time promocode---
else{
  if($total > $promocode_data->minorder){ //----checking minorder for promocode
      // echo "hii";

      $discount_amt = $total * $promocode_data->giftpercent/100;
    if($discount_amt > $promocode_data->max){
      // will get max amount
      $discount =  $promocode_data->max;

    }else{

      $discount =  $discount_amt;
    }

    }//endif of minorder
      else{

        header('Access-Control-Allow-Origin: *');
        $res = array('message'=>'Please add more products for promocode',
              'status'=>201
              );

              echo json_encode($res);
              exit;
      }



}



}else{

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'invalid promocode',
        'status'=>201
        );

        echo json_encode($res);
        exit;


  }


}


//-------final amount----------
$final_amount = ($total - $discount) + $shipping_charges;

//-------table_order1 entry-------

$order1_data = array('user_id'=>$user_data->id,
          'promocode_id'=>$promocode_id,
          'discount'=>$discount,
          'total_amount'=>$total,
          'delivery_charge'=>$shipping_charges,
          'payment_status'=>0,
          'order_status'=>0,
          'ip' =>$ip,
          'date'=>$cur_date,
          'email'=>$address_email,
          'first_name'=>$first_name,
          'last_name'=>$last_name,
          'post_code'=>$post_code,
          'street_address'=>$street_address,
          'city'=>$city,
          'state'=>$state,
          'phone'=>$phone,

          );



$last_id=$this->base_model->insert_table("tbl_order1",$order1_data,1) ;


//------table order2 entries----
if(!empty($last_id)){
$price2= 0 ;
foreach($cart_data->result() as $data3) {

  $this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data3->type_id);
$type_data= $this->db->get()->row();

$price2= $type_data->spgst * $data3->quantity;

$order2_data = array('main_id'=>$last_id,
          'product_id'=>$data3->product_id,
          'type_id'=>$data3->type_id,
          'quantity'=>$data3->quantity,
          'total_amount'=>$price2,
          'type_amt'=>$type_data->spgst,
          'gst'=>$type_data->gst,
          'gst_percentage'=>$type_data->gstprice,
          'ip' =>$ip,
          'date'=>$cur_date,
        );

$last_id2=$this->base_model->insert_table("tbl_order2",$order2_data,1) ;
}
$response = [];
if(!empty($last_id2)){

$response  = array(

'total' => $total,
'sub_total' => $final_amount,
'promocode_discount' => $discount,
'charges' => $shipping_charges

);


header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'success',
        'status'=>200,
        'data'=>$response
        );

        echo json_encode($res);

}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'some eroor occured! please try again',
        'status'=>201
        );

        echo json_encode($res);
        exit;



}


}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'some eroor occured',
        'status'=>201
        );

        echo json_encode($res);
        exit;


  }
}else{

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'cart is empty',
        'status'=>201
        );

        echo json_encode($res);
        exit;

}
}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'user not found',
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

}else{
  header('Access-Control-Allow-Origin: *');

$res = array('message'=>'No data are available',
'status'=>201
);

echo json_encode($res);
}








}


//search api --------------
public function search_product(){


  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {
  // print_r($this->input->post());
  // exit;

  $this->form_validation->set_rules('string', 'string', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

  $string=$this->input->post('string');

  $this->db->select('*');
              $this->db->from('tbl_products');
              $this->db->like('productname',$string);
              $search_string= $this->db->get();
              $string_check= $search_string->row();
              // print_r ($string_check);
              // exit;
              $search_data=[];
              if(!empty($string_check)){
              foreach($search_string->result() as $data){
                // echo $data->id;
                // exit;
                $this->db->select('*');
                            $this->db->from('tbl_type');
                            $this->db->where('product_id',$data->id);
                            $type_data= $this->db->get()->row();
                          if(!empty($type_data)){
                          $ty_id=  $type_data->id;
                          $ty_name=  $type_data->name;
                          $ty_price=$type_data->gstprice;

                                       $search_data[]=array(
                                         'product_id'=>$data->id,
                                         'product_name'=>$data->productname,
                                         'produt_image'=>base_url().$data->image,
                                         'productdescription'=>$data->productdescription,
                                         'type_id'=>$ty_id,
                                         'type_name'=>$ty_name,
                                         'Price'=>$ty_price



                     );


              }




            }
            header('Access-Control-Allow-Origin: *');
            $res = array('message'=>"success",
            'status'=>200,
            'data'=>$search_data
            );

            echo json_encode($res);


          }else{
            header('Access-Control-Allow-Origin: *');
            $res = array('message'=>$string."no product",
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

        }else{
            header('Access-Control-Allow-Origin: *');

        $res = array('message'=>'No data are available',
        'status'=>201
        );

        echo json_encode($res);
        }



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






}
