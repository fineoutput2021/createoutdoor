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
'image'=> base_url().$data->image,
'link'=>$data->link
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
'image'=> base_url().$data->image,
'link'=>$data->link

);
}
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$gallery
);

echo json_encode($res);

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
'data'=>$category,
'data'=>$text

);

echo json_encode($res);


}

// ========= Get Products =========================
public function get_products(){

$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('is_active',1);
$productsdata= $this->db->get();
$products=[];
foreach($productsdata->result() as $data) {
$products[] = array(
'productname'=> $data->name,
'productimage'=> base_url().$data->image,
'mrp'=> $data->mrp,
'productdescription'=> $data->productdescription,
'colours'=> $data->colours,
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
'link'=>$data->link,

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
'background_image'=>base_url().$data->back_image,
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
'text'=>$data1->text


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
$this->db->like('subcategory',$subcategory_id);
$this->db->where('is_active',1);
$product_data= $this->db->get();

// print_r($product_data);
// exit;

$product_check=$product_data->row();



if(!empty($product_check)){

$product_data1 = [];

foreach($product_data->result() as $data) {

  $this->db->select('*');
              $this->db->from('tbl_subcategory');
              $this->db->where('id',$subcategory_id);
              $this->db->where('is_active',1);
              $get_name= $this->db->get()->row();
              if(!empty($get_name)){
                $subcategory_name=$get_name->subcategory;
                $subcategory_text=$get_name->text;
              }

$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('product_id',$data->id);
$this->db->where('is_active',1);
$type_info= $this->db->get();

$type_check=$type_info->row();

if(!empty($type_check)){
$type_data= [];
foreach($type_info->result() as $data1) {

$type_data[] = array(

'type_id'=>$data1->id,
'type_name'=>$data1->name,
'type_mrp'=>$data1->mrp,
'type_price'=>$data1->spgst,

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
'data'=>$product_data1,
'subcategory'=>$subcategory_name,
'text'=>$subcategory_text
);

echo json_encode($res);


}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>"product is not found",
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



//all product detail using id  single detail  product
public function get_all_products_detail($id){

$this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$id);
$this->db->where('is_active',1);
$productsdata= $this->db->get();
$products=[];
foreach($productsdata->result() as $data) {
$newvar=json_decode($data->category);
//category
foreach ($newvar as $value_ub) {


$this->db->select('*');
$this->db->from('tbl_category');
$this->db->where('id',$value_ub);
$cat= $this->db->get()->row();
if(!empty($cat)){
  $category_title=$cat->title;
}

}

//subcategory
$decode_sub=json_decode($data->subcategory);
foreach ($decode_sub as $value_sub) {


$this->db->select('*');
$this->db->from('tbl_subcategory');
$this->db->where('id',$value_sub);
$sub= $this->db->get()->row();
if(!empty($sub)){
  $subcategory_title=$sub->subcategory;
}

}
//type --
$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('product_id',$data->id);
$this->db->where('is_active',1);
$typ= $this->db->get();
$producttype=[];
foreach($typ->result() as $type){

$producttype[]=array(
'type_id'=>$type->id,
'type_name'=>$type->name,
'MRP' =>$type->mrp,
'Price' =>$type->spgst,
);

}



$products[] = array(
'product_id'=> $data->id,
'productname'=> $data->productname,

'category'=> $category_title,
'sucategory'=> $subcategory_title,
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
$this->db->where('is_active',1);
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
$this->db->where('is_active',1);
$typ= $this->db->get();
$producttype=[];
foreach($typ->result() as $type){

$producttype[]=array(
'type_id'=>$type->id,
'type_name'=>$type->name,
'MRP' =>$type->mrp,
'Price' =>$type->spgst,

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



  $this->db->select('*');
  $this->db->from('tbl_inventory');
  $this->db->where('type_id',$type_id);
  $inventory_data= $this->db->get()->row();

  // echo $inventory_data->quantity;
  // exit;
  //----inventory_check----------

  if($inventory_data->quantity >= $quantity){

  }else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=> "$product_data->productname Product is out of stock",
  'status'=>201
  );

  echo json_encode($res);
  exit;

  }



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

    $this->db->select('*');
    $this->db->from('tbl_inventory');
    $this->db->where('type_id',$type_id);
    $inventory_data= $this->db->get()->row();

    // echo $inventory_data->quantity;
    // exit;
    //----inventory_check----------

    if($inventory_data->quantity >= $quantity){

    }else{
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=> "$product_data->productname  Product is out of stock",
    'status'=>201
    );

    echo json_encode($res);
    exit;

    }
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


    $this->db->select('*');
    $this->db->from('tbl_inventory');
    $this->db->where('type_id',$type_id);
    $inventory_data= $this->db->get()->row();

    // echo $inventory_data->quantity;
    // exit;
    //----inventory_check----------

    if($inventory_data->quantity >= $quantity){

    }else{
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=> " Product is out of stock",
    'status'=>201
    );

    echo json_encode($res);
    exit;

    }



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
//-----update with token id------
else{


    $this->db->select('*');
    $this->db->from('tbl_inventory');
    $this->db->where('type_id',$type_id);
    $inventory_data= $this->db->get()->row();

    // echo $inventory_data->quantity;
    // exit;
    //----inventory_check----------

    if($inventory_data->quantity >= $quantity){

    }else{
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=> "Product is out of stock",
    'status'=>201
    );

    echo json_encode($res);
    exit;

    }



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
$this->db->where('is_active',1);
$dsa= $this->db->get();
$product_data=$dsa->row();


$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$this->db->where('is_active',1);
$dsa= $this->db->get();
$type_data=$dsa->row();


$cart_info[] = array('product_id'=>$data->product_id,
'product_name'=>$product_data->productname,
'product_image'=>base_url().$product_data->image,
'type_id'=>$data->type_id,
'type_name'=>$type_data->name,
'quantity'=>$data->quantity,
'price'=>$type_data->spgst,
'total='=>$total = $type_data->spgst * $data->quantity

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
$this->db->where('is_active',1);
$dsa= $this->db->get();
$product_data=$dsa->row();


$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$this->db->where('is_active',1);
$dsa= $this->db->get();
$type_data=$dsa->row();


$cart_info[] = array('product_id'=>$data->product_id,
'product_name'=>$product_data->productname,
'product_image'=>base_url().$product_data->image,
'type_id'=>$data->type_id,
'type_name'=>$type_data->name,
'quantity'=>$data->quantity,
'price'=>$type_data->spgst,
'total='=>$total = $type_data->spgst * $data->quantity

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
public function custom_order(){

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
$new_file_name="customproduct1".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img1))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
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
$img2='image2';

$file_check=($_FILES['image2']['error']);
if($file_check!=4){
$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
if (!file_exists($image_upload_folder))
{
mkdir($image_upload_folder, DIR_WRITE_MODE, true);
}
$new_file_name="customproduct2".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img2))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
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

$img3='image3';

$file_check=($_FILES['image3']['error']);
if($file_check!=4){
$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
if (!file_exists($image_upload_folder))
{
mkdir($image_upload_folder, DIR_WRITE_MODE, true);
}
$new_file_name="customproduct3".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img3))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
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
$img4='image4';

$file_check=($_FILES['image4']['error']);
if($file_check!=4){
$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
if (!file_exists($image_upload_folder))
{
mkdir($image_upload_folder, DIR_WRITE_MODE, true);
}
$new_file_name="customproduct4".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img4))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
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

//image4
$img5='image5';

$file_check=($_FILES['image5']['error']);
if($file_check!=4){
$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
if (!file_exists($image_upload_folder))
{
mkdir($image_upload_folder, DIR_WRITE_MODE, true);
}
$new_file_name="customproduct5".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img5))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
}
else
{

$file_info = $this->upload->data();

$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
$file_info['new_name']=$videoNAmePath;
// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
$nnnn4=$file_info['file_name'];
// echo json_encode($file_info);
}
}

//image4
$img6='image6';

$file_check=($_FILES['image6']['error']);
if($file_check!=4){
$image_upload_folder = FCPATH . "assets/uploads/customproduct/";
if (!file_exists($image_upload_folder))
{
mkdir($image_upload_folder, DIR_WRITE_MODE, true);
}
$new_file_name="customproduct6".date("Ymdhms");
$this->upload_config = array(
'upload_path'   => $image_upload_folder,
'file_name' => $new_file_name,
'allowed_types' =>'jpg|jpeg|png',
'max_size'      => 25000
);
$this->upload->initialize($this->upload_config);
if (!$this->upload->do_upload($img6))
{
$upload_error = $this->upload->display_errors();
// echo json_encode($upload_error);
echo $upload_error;
exit;
}
else
{

$file_info = $this->upload->data();

$videoNAmePath = "assets/uploads/customproduct/".$new_file_name.$file_info['file_ext'];
$file_info['new_name']=$videoNAmePath;
// $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
$nnnn5=$file_info['file_name'];
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
'image4'=>$nnnn3,
'image5'=>$nnnn4,
'image6'=>$nnnn5,
'ip'=>$ip,
'date'=>$cur_date,



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


$data_insert = array('firstname'=>$firstname,
'lastname'=>$lastname,
'businessname'=>$businessname,
'email'=>$email,
'message'=>$message,
'ip'=>$ip,
'date'=>$cur_date,



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
public function subscribe_us(){

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
$this->db->from('tbl_subscribe_us');
$this->db->where('email_id',$email);
$dsa= $this->db->get();
$da=$dsa->row();
if(!empty($da)){

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"Already applied",
'status'=>201
);

echo json_encode($res);
exit;

}

$data_insert = array('email_id'=>$email,
'ip' =>$ip,
'date' =>$cur_date,


);


$last_id=$this->base_model->insert_table("tbl_subscribe_us",$data_insert,1) ;

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
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('email_id', 'email_id', 'required|valid_email|xss_clean|trim');
  $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

$email=$this->input->post('email_id');
$token_id=$this->input->post('token_id');
$password=$this->input->post('password');
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('email',$email);
    $user_data= $this->db->get()->row();

    if(!empty($user_data)){

    if($user_data->password==$password){

$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where('user_id',$user_data->id);
$this->db->where('payment_status',1);
$this->db->or_where('order_status',5);
$data= $this->db->get();

$viewcart=[];
foreach ($data->result() as $value) {

if($value->payment_type == 1){
$payment_type="COD";
}else if($value->payment_type == 2){
  $payment_type="Online Paymnet";
}else{
  $payment_type = "NA";
}

if($value->order_status==1 || $value->order_status==2){
  $cancel_status = 1;
}else{
    $cancel_status =0;
}

if($value->order_status==1){
  $order_status= "Placed";
}else if($value->order_status==2){
  $order_status= "Confirmed";
}else if($value->order_status==3){
  $order_status= "Dispatched";
}else if($value->order_status==4){
  $order_status= "Delivered";
}else if($value->order_status==5){
  $order_status= "Canceled";
}

$newdate = new DateTime($value->date);
$d2=$newdate->format('d-m-Y');   #d-m-Y  // March 10, 2001, 5:16 pm


$viewcart[]=array(
'order_id'=>$value->id,
'order_date'=>$d2,
'total_amount'=>$value->total_amount,
'final_amount'=>$value->final_amount,

'payment_type'=> $payment_type,
'delivery_charge'=>$value->delivery_charge,
'discount'=>$value->discount,
'order_status'=>$order_status,
'cancel_status'=>$cancel_status,
);

}
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$viewcart
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Wrong Password',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'user not found',
'status'=>201
);

echo json_encode($res);

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
  $res = array('message'=>"Please insert some data",
  'status'=>201
  );

  echo json_encode($res);

}

}

//------------------------------------



//-------------order detail-------------------
public function orderdetail(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('email_id', 'email_id', 'required|valid_email|xss_clean|trim');
  $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
  $this->form_validation->set_rules('order_id', 'order_id', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

  $email=$this->input->post('email_id');
  $token_id=$this->input->post('token_id');
  $password=$this->input->post('password');
  $order_id=$this->input->post('order_id');

    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('email',$email);
    $user_data= $this->db->get()->row();

    if(!empty($user_data)){

    if($user_data->password==$password){


$this->db->select('*');
$this->db->from('tbl_order2');
$this->db->where('main_id',$order_id);
$dsa= $this->db->get();
$da=$dsa->row();
$order2 = [] ;
$subtotal= 0 ;
foreach($dsa->result() as $data) {

            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$data->product_id);
$product_data= $this->db->get()->row();


            $this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$type_data= $this->db->get()->row();

$this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('id',$order_id);
            $data_order1= $this->db->get()->row();
            if(!empty($data_order1)){
              $data_amount=$data_order1->final_amount;
            }else{
            $data_amount="";
            }


$order2[]=array(
'product_id' =>$product_data->id,
'product_name' =>$product_data->productname,
'product_image' =>base_url().$product_data->image1,
'quantity'=> $data->quantity,
'type_id'=>$type_data->id,
'type_name'=>$type_data->name,
'price'=>$data->type_amt,
'total amount'=>$data_amount,



);
$subtotal = $subtotal + $data->total_amount;

}

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$order2,
'subtotal'=>$subtotal
);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Wrong Password',
'status'=>201
);

echo json_encode($res);
}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'user not found',
'status'=>201
);

echo json_encode($res);

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
  $res = array('message'=>"Please insert some data",
  'status'=>201
  );

  echo json_encode($res);

}

}

//-----related products------
public function related_products($id){

            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('id',$id);
$this->db->where('is_active',1);
$product_data= $this->db->get()->row();

$new_add=json_decode($product_data->subcategory);

foreach($new_add as $data_subcategory){
            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->like('subcategory',$data_subcategory);

$related_data= $this->db->get();


$related_info = [];
$type = [];
$i=1;
foreach($related_data->result() as $data) {

if($data->id!=$id){


            $this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('product_id',$data->id);
$this->db->where('is_active',1);
$type_data= $this->db->get();
$type_check= $type_data->row();

if(!empty($type_check)){

foreach($type_data->result() as $data1) {

$type[]= array(
'type_id'=>$data1->id,
'type_name'=>$data1->name,
'MRP'=>$data1->mrp,
'Price'=>$data1->spgst,
);


}
}

$related_info[]  = array(
'product_id'=>$data->id,
'productname'=>$data->productname,
'productimage'=>base_url().$data->image,
'productdescription'=>$data->productdescription,
'product_type'=>$type,

);
}
$i++;

}

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$related_info

);

echo json_encode($res);
exit();


}
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
$this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
$this->form_validation->set_rules('token', 'token', 'required|xss_clean|trim');
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
$password=$this->input->post('password');
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

if($user_data->password==$password){
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
$this->db->where('is_active',1);
$product_data= $this->db->get()->row();

$this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('id',$data->type_id);
$this->db->where('is_active',1);
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
$bytes = random_bytes(15);
$txn_id=bin2hex($bytes);


//-------final amount----------
$final_amount = $total + $shipping_charges;

//-------table_order1 entry-------

$order1_data = array('user_id'=>$user_data->id,
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
'txnid'=>$txn_id,
'final_amount'=>$final_amount,

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
'charges' => $shipping_charges,
'txn_id' => $txn_id,

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
$res = array('message'=>'Wrong Password',
'status'=>201
);

echo json_encode($res);
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
//----promocode---
public function apply_promocode(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
  $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
  $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('txn_id', 'txn_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('promocode', 'promocode', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

  $email=$this->input->post('email');
  $password=$this->input->post('password');
  $token_id=$this->input->post('token_id');
  $txn_id=$this->input->post('txn_id');
  $promocode=$this->input->post('promocode');

  $this->db->select('*');
  $this->db->from('tbl_users');
  $this->db->where('email',$email);
  $user_data= $this->db->get()->row();

  if(!empty($user_data)){

  if($user_data->password==$password){

  //--------check_promocode------
  $discount = 0;
  $promocode_id=0;

  $promocode = strtoupper($promocode);

  $this->db->select('*');
  $this->db->from('tbl_promocode');
  $this->db->where('promocode',$promocode);
  $dsa= $this->db->get();
  $promocode_data=$dsa->row();

  if(!empty($promocode_data)){

    $this->db->select('*');
    $this->db->from('tbl_order1');
    $this->db->where('txnid',$txn_id);
    $order_data= $this->db->get()->row();


    $final_amount = 0;
  $promocode_id = $promocode_data->id;
  if($promocode_data->ptype==1){

  $this->db->select('*');
  $this->db->from('tbl_order1');
  $this->db->where('user_id',$user_data->id);
  $this->db->where('promocode_id',$promocode_data->id);
  $dsa= $this->db->get();
  $promo_check=$dsa->row();

  if(empty($promo_check)){

  if($order_data->total_amount > $promocode_data->minorder){ //----checking minorder for promocode
  // echo "hii";

  $discount_amt = $order_data->total_amount * $promocode_data->giftpercent/100;
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
  if($order_data->total_amount > $promocode_data->minorder){ //----checking minorder for promocode
  // echo "hii";

  $discount_amt = $order_data->total_amount * $promocode_data->giftpercent/100;
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


  $final_amount = $order_data->final_amount - $discount;


  //-------table_order1 entry-------

  $update_order1_data = array(
  'promocode_id'=>$promocode_id,
  'discount'=>$discount,
  );

  $this->db->where('txnid', $txn_id);
  $last_id=$this->db->update('tbl_order1', $update_order1_data);

if(!empty($last_id)){



  $response  = array(

  'total' => $order_data->total_amount,
  'sub_total' => $final_amount,
  'promocode_discount' => $discount,
  'charges' => $order_data->delivery_charge,
  'promocode_id' => $promocode_id,

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
  $res = array('message'=>'invalid promocode',
  'status'=>201
  );

  echo json_encode($res);
  exit;


  }



  }else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'Wrong Password',
  'status'=>201
  );

  echo json_encode($res);
  }
  }else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'user not found',
  'status'=>201
  );

  echo json_encode($res);

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

  $res = array('message'=>'No data are available',
  'status'=>201
  );

  echo json_encode($res);
  }





}

//----promocode_remove-----
public function promocode_remove(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
  $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
  $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('txn_id', 'txn_id', 'required|xss_clean|trim');
  $this->form_validation->set_rules('promocode_id', 'promocode_id', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

  $email=$this->input->post('email');
  $password=$this->input->post('password');
  $token_id=$this->input->post('token_id');
  $txn_id=$this->input->post('txn_id');
  $promocode=$this->input->post('promocode');

  $this->db->select('*');
  $this->db->from('tbl_users');
  $this->db->where('email',$email);
  $user_data= $this->db->get()->row();

  if(!empty($user_data)){

  if($user_data->password==$password){


              $data_insert = array('promocode_id'=>0,
                        'discount'=>0,

                        );


                $this->db->where('txnid', $txn_id);
                $last_id=$this->db->update('tbl_order1', $data_insert);
  if(!empty($last_id))   {
    $this->db->select('*');
  $this->db->from('tbl_order1');
  $this->db->where('txnid',$txn_id);
  $order_data= $this->db->get()->row();

$final_amount = $order_data->total_amount + $order_data->delivery_charge;
$response  = array(

'sub_total' => $final_amount,
'promocode_discount' => $order_data->discount,

);
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200,
'data'=>$response,

);

echo json_encode($res);
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'some error occured',
'status'=>201
);

echo json_encode($res);
}

      }else{
      header('Access-Control-Allow-Origin: *');
      $res = array('message'=>'Wrong Password',
      'status'=>201
      );

      echo json_encode($res);
      }
      }else{
      header('Access-Control-Allow-Origin: *');
      $res = array('message'=>'user not found',
      'status'=>201
      );

      echo json_encode($res);

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

      $res = array('message'=>'No data are available',
      'status'=>201
      );

      echo json_encode($res);
      }




}


//----------checkout-------------
public function checkout(){





$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->load->helper('security');
if($this->input->post())
{

$this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
$this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
$this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
$this->form_validation->set_rules('payment_type', 'payment_type', 'required|xss_clean|trim');
$this->form_validation->set_rules('txn_id', 'txn_id', 'required|xss_clean|trim');

if($this->form_validation->run()== TRUE)
{

$email=$this->input->post('email');
$password=$this->input->post('password');
$token_id=$this->input->post('token_id');
$payment_type=$this->input->post('payment_type');
$txn_id=$this->input->post('txn_id');

	$ip = $this->input->ip_address();
date_default_timezone_set("Asia/Calcutta");
	$cur_date=date("Y-m-d H:i:s");


$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('email',$email);
$user_data= $this->db->get()->row();

if(!empty($user_data)){

if($user_data->password==$password){
$this->db->select('*');
$this->db->from('tbl_order1');
$this->db->where('txnid',$txn_id);
$order_data= $this->db->get()->row();

if(!empty($order_data)){

            $this->db->select('*');
$this->db->from('tbl_order2');
$this->db->where('main_id',$order_data->id);
$order2_data= $this->db->get();


foreach($order2_data->result() as $data) {

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

}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=> "$product_data->productname. Product is out of stock",
'status'=>201
);

echo json_encode($res);
exit;

}


}//--end_cart foreach

//------cod------------

if($payment_type==1){

//-------final amount----------
$final_amount = ($order_data->total_amount - $order_data->discount) + $order_data->delivery_charge;

//-------table_order1 entry-------

$order1_data = array(
'final_amount'=>$final_amount,
'payment_status'=>1,
'order_status'=>1,
'payment_type'=>1,
'ip' =>$ip,
'date'=>$cur_date,
);

$this->db->where('txnid', $txn_id);
$last_id=$this->db->update('tbl_order1', $order1_data);


if(!empty($last_id)){

///--update_invenory----
foreach($order2_data->result() as $data) {

$this->db->select('*');
$this->db->from('tbl_inventory');
$this->db->where('type_id',$data->type_id);
$inventory_data= $this->db->get()->row();

if(!empty($inventory_data)){

$new_inventory = $inventory_data->quantity - $data->quantity;

$update_data = array(
'quantity'=>$new_inventory,
);

$this->db->where('type_id', $data->type_id);
$last_id=$this->db->update('tbl_inventory', $update_data);

}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'Some Eroor Occured! please try again',
  'status'=>201
  );

  echo json_encode($res);
  exit;
}
}//--end_cart foreach

$zapak=$this->db->delete('tbl_cart', array('user_id' => $user_data->id));



header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200
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


}
//-----online payment----
else{

}
}else{

header('Access-Control-Allow-Origin: *');
$res = array('message'=>'orders is empty',
'status'=>201
);

echo json_encode($res);
exit;

}
}else{
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'Wrong Password',
'status'=>201
);

echo json_encode($res);
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






//---------------search api --------------
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
$this->db->where('is_active',1);
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
        $ty_mrp=  $type_data->mrp;
        $ty_price=$type_data->spgst;

                     $search_data[]=array(
                       'product_id'=>$data->id,
                       'product_name'=>$data->productname,
                       'produt_image'=>base_url().$data->image,
                       'productdescription'=>$data->productdescription,
                       'type_id'=>$ty_id,
                       'type_name'=>$ty_name,
                       'type_mrp'=>$ty_mrp,
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



//----add to wishlist--------
public function add_to_wishlist(){



    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->helper('security');
    if($this->input->post())
    {

    $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
    $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
    $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
    $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
    $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');

    if($this->form_validation->run()== TRUE)
    {

    $email=$this->input->post('email');
    $password=$this->input->post('password');
    $token_id=$this->input->post('token_id');
    $product_id=$this->input->post('product_id');
    $type_id=$this->input->post('type_id');
    $ip = $this->input->ip_address();
    date_default_timezone_set("Asia/Calcutta");
    $cur_date=date("Y-m-d H:i:s");

    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where('email',$email);
    $user_data= $this->db->get()->row();

    if(!empty($user_data)){

    if($user_data->password==$password){

            $this->db->select('*');
$this->db->from('tbl_wishlist');
$this->db->where('user_id',$user_data->id);
$this->db->where('product_id',$product_id);
$this->db->where('type_id',$type_id);
$wishlist_data= $this->db->get()->row();

if(empty($wishlist_data)){
      $data_insert = array('user_id'=>$user_data->id,
                'product_id'=>$product_id,
                'type_id'=>$type_id,
                'ip' =>$ip,
                'date'=>$cur_date

                );


      $last_id=$this->base_model->insert_table("tbl_wishlist",$data_insert,1) ;
if(!empty($last_id)){
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'success',
  'status'=>200
  );

  echo json_encode($res);
}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'some error occured',
  'status'=>201
  );

  echo json_encode($res);
}

}else{
  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'product is already in your wishist',
  'status'=>201
  );

  echo json_encode($res);


}

        }else{
        header('Access-Control-Allow-Origin: *');
        $res = array('message'=>'Wrong Password',
        'status'=>201
        );

        echo json_encode($res);
        }
        }else{
        header('Access-Control-Allow-Origin: *');
        $res = array('message'=>'user not found',
        'status'=>201
        );

        echo json_encode($res);

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

        $res = array('message'=>'No data are available',
        'status'=>201
        );

        echo json_encode($res);
        }





}

//----remove wishlist product-----
public function remove_wishlist_product(){


      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->helper('security');
      if($this->input->post())
      {

      $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
      $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
      $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
      $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
      $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');

      if($this->form_validation->run()== TRUE)
      {

      $email=$this->input->post('email');
      $password=$this->input->post('password');
      $token_id=$this->input->post('token_id');
      $product_id=$this->input->post('product_id');
      $type_id=$this->input->post('type_id');
      $ip = $this->input->ip_address();
      date_default_timezone_set("Asia/Calcutta");
      $cur_date=date("Y-m-d H:i:s");

      $this->db->select('*');
      $this->db->from('tbl_users');
      $this->db->where('email',$email);
      $user_data= $this->db->get()->row();

      if(!empty($user_data)){

      if($user_data->password==$password){


        $zapak=$this->db->delete('tbl_wishlist', array('user_id' => $user_data->id,'product_id' => $product_id,'type_id' => $type_id,));

  if(!empty($zapak)){
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=>'success',
    'status'=>200
    );

    echo json_encode($res);
  }else{
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=>'some error occured',
    'status'=>201
    );

    echo json_encode($res);
  }

          }else{
          header('Access-Control-Allow-Origin: *');
          $res = array('message'=>'Wrong Password',
          'status'=>201
          );

          echo json_encode($res);
          }
          }else{
          header('Access-Control-Allow-Origin: *');
          $res = array('message'=>'user not found',
          'status'=>201
          );

          echo json_encode($res);

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

          $res = array('message'=>'No data are available',
          'status'=>201
          );

          echo json_encode($res);
          }






}

//------------filter-----
public function filter(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('leadtime_id', 'leadtime_id', 'xss_clean|trim');
  $this->form_validation->set_rules('furniture_type_id', 'furniture_type_id', 'xss_clean|trim');
  $this->form_validation->set_rules('seating_id', 'seating_id', 'xss_clean|trim');
  $this->form_validation->set_rules('shape_id', 'shape_id', 'xss_clean|trim');
  $this->form_validation->set_rules('feature_id', 'feature_id', 'xss_clean|trim');



  if($this->form_validation->run()== TRUE)
  {

    $leadtime_id=$this->input->post('leadtime_id');
    $furniture_type_id=$this->input->post('furniture_type_id');
    $seating_id=$this->input->post('seating_id');
    $shape_id=$this->input->post('shape_id');
    $feature_id=$this->input->post('feature_id');

$leadtime_info = explode(',',$leadtime_id);
$furniture_type_info = explode(',',$furniture_type_id);
$seating_info = explode(',',$seating_id);
$shape_info = explode(',',$shape_id);
$feature_info = explode(',',$feature_id);



            $this->db->select('*');
$this->db->from('tbl_products');
$this->db->where('is_active',1);
foreach($leadtime_info as $data) {
$this->db->or_where('leadtime_id',$data);
}
foreach($furniture_type_info as $data1) {
$this->db->or_where('furniture_type_id',$data1);
}
foreach($seating_info as $data2) {
$this->db->or_where('seating_id',$data2);
}
foreach($shape_info as $data3) {
$this->db->or_where('shape_id',$data3);
}
foreach($feature_info as $data4) {
$this->db->or_where('feature_id',$data4);
}
$filter_data= $this->db->get();
$filter_check = $filter_data->row();
$filter_info = [];
if(!empty($filter_check)){

foreach($filter_data->result() as $data) {


            $this->db->select('*');
$this->db->from('tbl_type');
$this->db->where('product_id',$data->id);
$type_data= $this->db->get()->row();

$filter_info[] = array(
'product_id'=>$data->id,
'product_name'=>$data->productname,
'product_image'=>base_url().$data->image,
'productdescription'=>$data->productdescription,
'type_id'=>$type_data->id,
'type_name'=>$type_data->name,
'price'=>$type_data->spgst,

);

}
}

header('Access-Control-Allow-Origin: *');

$res = array('message'=>'success',
'status'=>200,
'data'=>$filter_info,
);

echo json_encode($res);


            }else{
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

///cancel_order
public function cancel_order(){



        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if($this->input->post())
        {

        $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');
        $this->form_validation->set_rules('order_id', 'order_id', 'required|xss_clean|trim');

        if($this->form_validation->run()== TRUE)
        {

        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $token_id=$this->input->post('token_id');
        $order_id=$this->input->post('order_id');

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('email',$email);
        $user_data= $this->db->get()->row();

        if(!empty($user_data)){

        if($user_data->password==$password){


                    $data_insert = array('order_status'=>5,
                              );

                      $this->db->where('id', $order_id);
                      $last_id=$this->db->update('tbl_order1', $data_insert);
   //inventory update
                      $this->db->select('*');
                                  $this->db->from('tbl_order2');
                                  $this->db->where('main_id',$order_id);
                                  $data_order1= $this->db->get()->row();
              if(!empty($data_order1)){
                $this->db->select('*');
                            $this->db->from('tbl_inventory');
                            $this->db->where('type_id',$data_order1->type_id);
                            $data_inventory= $this->db->get()->row();

                          $total_quantity=$data_order1->quantity + $data_inventory->quantity;



                          $data_update=array(
                                   'quantity'=>$total_quantity
                          );
                          $this->db->where('type_id', $data_order1->type_id);
                          $last_id2=$this->db->update('tbl_inventory', $data_update);








    if(!empty($last_id)){
      header('Access-Control-Allow-Origin: *');
      $res = array('message'=>'success',
      'status'=>200
      );

      echo json_encode($res);
    }else{
      header('Access-Control-Allow-Origin: *');
      $res = array('message'=>'some error occured',
      'status'=>201
      );

      echo json_encode($res);
    }
  }else{
    header('Access-Control-Allow-Origin: *');
    $res = array('message'=>'order_id not found',
    'status'=>201
    );

    echo json_encode($res);
  }

            }else{
            header('Access-Control-Allow-Origin: *');
            $res = array('message'=>'Wrong Password',
            'status'=>201
            );

            echo json_encode($res);
            }
            }else{
            header('Access-Control-Allow-Origin: *');
            $res = array('message'=>'user not found',
            'status'=>201
            );

            echo json_encode($res);

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

            $res = array('message'=>'No data are available',
            'status'=>201
            );

            echo json_encode($res);
            }



}

//----view wishlist-------
public function view_wishlist(){




          $this->load->helper(array('form', 'url'));
          $this->load->library('form_validation');
          $this->load->helper('security');
          if($this->input->post())
          {

          $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
          $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');
          $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

          if($this->form_validation->run()== TRUE)
          {

          $email=$this->input->post('email');
          $password=$this->input->post('password');
          $token_id=$this->input->post('token_id');

          $this->db->select('*');
          $this->db->from('tbl_users');
          $this->db->where('email',$email);
          $user_data= $this->db->get()->row();

          if(!empty($user_data)){

          if($user_data->password==$password){


                      $this->db->select('*');
          $this->db->from('tbl_wishlist');
          $this->db->where('user_id',$user_data->id);
          $wishlist_data= $this->db->get();
          $wishlist_check= $wishlist_data->row();
  $wishlist_info = [];
if(!empty($wishlist_check)){
foreach($wishlist_data->result() as $data) {

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

$wishlist_info[]=array(
  'product_id'=>$product_data->id,
  'product_name'=>$product_data->productname,
  'product_image'=>base_url().$product_data->image1,
  'type_id'=>$type_data->id,
  'type_name'=>$type_data->name,
  'type_mrp'=>$type_data->mrp,
  'price'=>$type_data->spgst,
);

}
header('Access-Control-Allow-Origin: *');
$res = array('message'=>'success',
'status'=>200,
'data'=>$wishlist_info,
);

echo json_encode($res);
}
else{

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>'Wishlist is empty',
  'status'=>201
  );

  echo json_encode($res);

}

        }else{
              header('Access-Control-Allow-Origin: *');
              $res = array('message'=>'Wrong Password',
              'status'=>201
              );

              echo json_encode($res);
              }
              }else{
              header('Access-Control-Allow-Origin: *');
              $res = array('message'=>'user not found',
              'status'=>201
              );

              echo json_encode($res);

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

              $res = array('message'=>'No data are available',
              'status'=>201
              );

              echo json_encode($res);
              }



}

function random_strings($length_of_string)
{

// String of all alphanumeric character
$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

// Shufle the $str_result and returns substring
// of specified length
return substr(str_shuffle($str_result), 0, $length_of_string);
}


///----forget_password-----
public function forget_password(){

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if($this->input->post())
            {

            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

            if($this->form_validation->run()== TRUE)
            {

            $email=$this->input->post('email');
            $token_id=$this->input->post('token_id');

            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('email',$email);
            $this->db->where('is_active',1);
            $user_data= $this->db->get()->row();

            if(!empty($user_data)){
              $user_id=$user_data->id;
              $user_name=$user_data->name;
              $ip = $this->input->ip_address();
      date_default_timezone_set("Asia/Calcutta");
              $cur_date=date("Y-m-d H:i:s");

              //generate unique string number for txn_id

   $txn_id=  $this->random_strings(15);

   $data_insert = array('user_id'=>$user_id,
             'txn_id'=>$txn_id,
             'status'=>0,
             'ip'=>$ip,
             'date'=>$cur_date,
             'added_by'=>""
             );

   $last_id=$this->base_model->insert_table("tbl_forgot_pass",$data_insert,1) ;
   $link = "http://localhost:3000/reset-password/".$txn_id;
  $forgot_password_data = array('user_name'=>$user_name,
  'link'=>$link

 );
  //-------email--------



        $config = Array(
                     'protocol' => 'ssmtp',
                     // 'smtp_host' => 'mail.fineoutput.co.in',
                     'smtp_host' => SMTP_HOST,
                     'smtp_port' => SMTP_PORT,
                     // 'smtp_user' => 'info@fineoutput.co.in', // change it to yours
                     // 'smtp_pass' => 'info@fineoutput2019', // change it to yours
                     'smtp_user' => USER_NAME, // change it to yours
                     'smtp_pass' => PASSWORD, // change it to yours
                     'mailtype' => 'html',
                     'charset' => 'iso-8859-1',
                     'wordwrap' => TRUE
                     );

                  $to=$email;


                    $message = 	$this->load->view('email/forgetpassword',$forgot_password_data,TRUE);
                  $this->load->library('email', $config);
                  $this->email->set_newline("");
                  // $this->email->from('info@fineoutput.co.in'); // change it to yours
                  $this->email->from(EMAIL); // change it to yours
                  $this->email->to($to);// change it to yours
                  $this->email->subject('Reset Forgot Password');
                  $this->email->message($message);
                  if($this->email->send()){
                  //  echo 'Email sent.';
                  }else{
                  // show_error($this->email->print_debugger());
                  }


                  header('Access-Control-Allow-Origin: *');
                  $res = array('message'=>'success',
                  'status'=>200,
                  'data'=> $txn_id
                  );

                  echo json_encode($res);

                }else{
                header('Access-Control-Allow-Origin: *');
                $res = array('message'=>'user not found',
                'status'=>201
                );

                echo json_encode($res);

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

                $res = array('message'=>'No data are available',
                'status'=>201
                );

                echo json_encode($res);
                }





}

//---forget-password-reset-----
public function forget_password_reset(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {

  $this->form_validation->set_rules('forget_token', 'forget_token', 'required|xss_clean|trim');
  $this->form_validation->set_rules( 'reset_password', 'reset_password', 'required|xss_clean|trim' );
  $this->form_validation->set_rules( 'confirm_password', 'confirm_password', 'required|matches[reset_password]|xss_clean|trim' );
  $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

  $forget_token=$this->input->post('forget_token');
  $reset_password=$this->input->post('reset_password');
  $token_id=$this->input->post('token_id');

	$this->db->select('*');
	$this->db->from('tbl_forgot_pass');
	$this->db->where('txn_id',$forget_token);
	$u1= $this->db->get()->row();

if(!empty($u1)) {
	$st=$u1->status;

	if($st==0){
		$data_update = array('status'=>1);
		$this->db->where('status', $u1->status);
		$zapak=$this->db->update('tbl_forgot_pass', $data_update);

if(!empty($zapak)){
  $rs=md5($reset_password);
          $data_update = array('password'=>$rs);

                                              $this->db->where('id', $u1->user_id);
                                              $zapak2=$this->db->update('tbl_users', $data_update);

                                        if(!empty($zapak2)) {
                                          header('Access-Control-Allow-Origin: *');

                                          $res = array('message'=>'success',
                                          'status'=>200
                                          );

                                          echo json_encode($res);
                                        }else{
                                          header('Access-Control-Allow-Origin: *');

                                          $res = array('message'=>'Some erroe occcured! please try again',
                                          'status'=>201
                                          );

                                          echo json_encode($res);
                                        }
}else{
  header('Access-Control-Allow-Origin: *');

  $res = array('message'=>'Some erroe occcured!',
  'status'=>201
  );

  echo json_encode($res);
}


	}else{

    header('Access-Control-Allow-Origin: *');

    $res = array('message'=>'Link already used',
    'status'=>201
    );

    echo json_encode($res);

	}
	}else{

    header('Access-Control-Allow-Origin: *');

    $res = array('message'=>'Wrong token',
    'status'=>201
    );

    echo json_encode($res);

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

  $res = array('message'=>'No data are available',
  'status'=>201
  );

  echo json_encode($res);
  }

}

public function update_password($t){

$txn_id=$t;

			      			$this->db->select('*');
									$this->db->from('tbl_forgot_pass');
									$this->db->where('txn_id',$txn_id);
									$u2= $this->db->get()->row();
									$ui=$u2->user_id;
									$data['auth']=$txn_id;
			$this->load->helper( array( 'form', 'url' ) );
			$this->load->library( 'form_validation' );
			$this->load->helper( 'security' );
			if ( $this->input->post() ) {

					$this->form_validation->set_rules( 'reset_password', 'reset_password', 'required|xss_clean|trim' );

					if ( $this->form_validation->run() == TRUE ) {

							$reset_password = $this->input->post( 'reset_password' );

							$this->db->select('*');
							$this->db->from('tbl_users');
							$this->db->where('id',$ui);
							$user= $this->db->get()->row();
							$rs=md5($reset_password);
							$data_update = array('password'=>$rs);

							                                    $this->db->where('password', $user->password);
							                    								$zapak=$this->db->update('tbl_users', $data_update);

							                                        if($zapak!=0){
																												$this->session->set_flashdata('smessage','Password successfully reset');
																												redirect("home/login","refresh");

							                                                }



						}else{

							$this->load->view('common/header',$data);
							$this->load->view('frontend/reset_password');
							$this->load->view('common/footer',$data);


								}

								}
							else{


								$this->load->view('common/header',$data);
								$this->load->view('frontend/reset_password');
								$this->load->view('common/footer',$data);


							}

}


                  ///get filter name
                  public function get_filter_name(){

                              $this->db->select('*');
                  $this->db->from('tbl_leadtime');
                  $this->db->where('is_active',1);
                  $leadtime_data= $this->db->get();

                              $this->db->select('*');
                  $this->db->from('tbl_furnituretype');
                  $this->db->where('is_active',1);
                  $type_data= $this->db->get();

                              $this->db->select('*');
                  $this->db->from('tbl_seating');
                  $this->db->where('is_active',1);
                  $seating_data= $this->db->get();

                              $this->db->select('*');
                  $this->db->from('tbl_tableshape');
                  $this->db->where('is_active',1);
                  $shape_data= $this->db->get();

                              $this->db->select('*');
                  $this->db->from('tbl_table_feature');
                  $this->db->where('is_active',1);
                  $feature_data= $this->db->get();

                  $leadtime = [];
                  $type = [];
                  $seating = [];
                  $shape = [];
                  $feature = [];

                  foreach($leadtime_data->result() as $data1) {
                  $leadtime[] = array(
                  "name"=>$data1->filtername
                  );
                  }
                  foreach($type_data->result() as $data2) {
                  $type[] = array(
                  "name"=>$data2->filtername
                  );
                  }
                  foreach($seating_data->result() as $data3) {
                  $seating[] = array(
                  "name"=>$data3->filtername
                  );
                  }
                  foreach($shape_data->result() as $data4) {
                  $shape[] = array(
                  "name"=>$data4->filtername
                  );
                  }
                  foreach($feature_data->result() as $data5) {
                  $feature[] = array(
                  "name"=>$data5->filtername
                  );
                  }

                  $response = array(
                  "leadtime"=>$leadtime,
                  "type"=>$type,
                  "seating"=>$seating,
                  "shape"=>$shape,
                  "feature"=>$feature
                  );


                  header('Access-Control-Allow-Origin: *');

                  $res = array('message'=>'success',
                  'status'=>200,
                  'data'=>$response,
                  );

                  echo json_encode($res);


//-------------------state api--------------------
                  }
      public function all_state_get(){

                                   $this->db->select('*');
                       $this->db->from('all_states');
                       //$this->db->where('id',$usr);
                       $data= $this->db->get();
                       if(!empty($data)){
                        $address=[];
                       foreach($data->result() as $value){
                         $address[]=array(
                           'state_id'=>$value->id,
                           'state'=>$value->state_name,
                         );
                       }

                       header('Access-Control-Allow-Origin: *');

                       $res = array('message'=>'success',
                       'status'=>200,
                       'data'=>$address,
                       );

                       echo json_encode($res);
                  }else{

                                           header('Access-Control-Allow-Origin: *');

                                           $res = array('message'=>'some error occured',
                                           'status'=>201,

                                           );

                                           echo json_encode($res);
                  }
                }
    //-------------------------------------------------

  //-----------------get_product_id using category_id--------------

  public function get_all_products_category(){

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');
  if($this->input->post())
  {


  // print_r($this->input->post());
  // exit;
  $this->form_validation->set_rules('category_id', 'category_id', 'required|xss_clean|trim');

  if($this->form_validation->run()== TRUE)
  {

                                        $category_id=$this->input->post('category_id');


                                        $this->db->select('*');
                                        $this->db->from('tbl_products');
                                        $this->db->like('category',$category_id);
                                        $product_data= $this->db->get();

                                        // print_r($product_data);
                                        // exit;

                                        $product_check=$product_data->row();


                  if(!empty($product_check)){



                                        $product_data1 = [];

                      foreach($product_data->result() as $data) {

                        $this->db->select('*');
                                    $this->db->from('tbl_category');
                                    $this->db->where('id',$category_id);
                                    $get_name= $this->db->get()->row();



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
                                                  'type_mrp'=>$data1->mrp,
                                                  'type_price'=>$data1->spgst,

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
                                        'data'=>$product_data1,
                                        'category'=>$get_name->title,
                                        'text'=>$get_name->text
                                        );

                                        echo json_encode($res);
                            }else{
                              header('Access-Control-Allow-Origin: *');
                              $res = array('message'=>'category_id not exist.',
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


public function custom_brochers(){

            $this->db->select('*');
$this->db->from('tbl_custom_brochers');
$this->db->where('is_active',1);
$brocher_data= $this->db->get();
$brosher_info = [];
foreach($brocher_data->result() as $data) {
$brosher_info[] = array(
  "id"=>$data->id,
  "title"=>$data->title,
  "file"=>base_url().$data->file,
  "image"=>base_url().$data->image,
);
}

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>"success",
  'status'=>200,
  'data'=>$brosher_info,
  );

  echo json_encode($res);

  }

public function corporate_brochers(){

            $this->db->select('*');
$this->db->from('tbl_corporate_brochers');
$this->db->where('is_active',1);
$brocher_data= $this->db->get();
$brosher_info = [];
foreach($brocher_data->result() as $data) {
$brosher_info[] = array(
  "id"=>$data->id,
  "title"=>$data->title,
  "file"=>base_url().$data->file,
  "image"=>base_url().$data->image,
);
}

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>"success",
  'status'=>200,
  'data'=>$brosher_info,
  );

  echo json_encode($res);

  }

//-------custom banner image
public function custom_banner_image(){

            $this->db->select('*');
$this->db->from('tbl_custom_banner_image');
$this->db->where('is_active',1);
$custom_data= $this->db->get();
$banner_data=[];

foreach($custom_data->result() as $data) {

$banner_data = array(
  "home_image"=>base_url().$data->home_image,
  "detail_image1"=>base_url().$data->detail_image_1,
  "detail_image2"=>base_url().$data->detail_image_2
);

}

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>"success",
  'status'=>200,
  'data'=>$banner_data,
  );

  echo json_encode($res);

}

//-------corporate banner image
public function corporate_banner_image(){

            $this->db->select('*');
$this->db->from('tbl_corporate_banner_image');
$this->db->where('is_active',1);
$corporate_data= $this->db->get();
$banner_data=[];

foreach($corporate_data->result() as $data) {

  $banner_data = array(
    "home_image"=>base_url().$data->home_image,
    "detail_image1"=>base_url().$data->detail_image_1,
    "detail_image2"=>base_url().$data->detail_image_2
  );

}

  header('Access-Control-Allow-Origin: *');
  $res = array('message'=>"success",
  'status'=>200,
  'data'=>$banner_data,
  );

  echo json_encode($res);

}


//testimonals
public function view_testimonials(){

  $this->db->select('*');
              $this->db->from('tbl_Testimonals');
              $this->db->where('is_active',1);
              $view_testmonials= $this->db->get();
              $Testimonals_data=[];
            foreach ($view_testmonials->result() as $value) {
              $Testimonals_data[]=array(
                'id'=>$value->id,
                'name'=>$value->Name,
                'image'=>base_url().$value->Image,
                'description'=>$value->Description
              );
            }
            header('Access-Control-Allow-Origin: *');
            $res=array('message'=> "sucess",
                  'status'=>200,
                  'data'=>$Testimonals_data


          );
          echo json_encode($res);
}

//top bar api
public function get_topbar(){

$this->db->select('*');
$this->db->from('tbl_topbar');
$topdata= $this->db->get();
$top=[];
foreach($topdata->result() as $data) {
$top[] = array(
'id'=> $data->id,
'name'=> $data->Name,
'link'=>$data->link
);
}
header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$top
);

echo json_encode($res);


}
//get chair text
public function get_chair_text(){

$this->db->select('*');
$this->db->from('tbl_chair_text');
$chair_text= $this->db->get()->row();
if(!empty($chair_text)){
  $chair_id=$chair_text->id;
  $chair_heading=$chair_text->heading;
  $chair_subheading=$chair_text->heading2;
  $chair_paregraph=$chair_text->paregraph;


}
$top=[];

$top[] = array(
'id'=>$chair_id,
'Heading'=> $chair_heading,
'Sub_Heading'=>$chair_subheading,
'paregraph'=>$chair_paregraph
);

header('Access-Control-Allow-Origin: *');
$res = array('message'=>"success",
'status'=>200,
'data'=>$top
);

echo json_encode($res);

}
// address get api
public function get_address(){


                          $this->load->helper(array('form', 'url'));
                          $this->load->library('form_validation');
                          $this->load->helper('security');
                          if($this->input->post())
                          {
                            // print_r($this->input->post());
                            // exit;
                            $this->form_validation->set_rules('email', 'email', 'required|xss_clean');
                            $this->form_validation->set_rules('password', 'password','required|xss_clean');
                            $this->form_validation->set_rules('token_id', 'token_id', 'required|xss_clean');

                            if($this->form_validation->run()== TRUE)
                            {
                              $email=$this->input->post('email');
                              $password=$this->input->post('password');
                              $token_id=$this->input->post('token_id');

                              $this->db->select('*');
                                          $this->db->from('tbl_users');
                                          $this->db->where('email',$email);
                                          $check_email= $this->db->get()->row();
                                          if(!empty($check_email)){
                                            if($password == $check_email->password){
                                                $this->db->select('*');
                                                            $this->db->from('tbl_order1');
                                                            $this->db->order_by('id','desc');
                                                            $this->db->where('user_id',$check_email->id);
                                                            $data_address= $this->db->get()->row();
                                                            $get_address=[];
                                                            if(!empty($data_address)){
                                                                     $get_address[]=array(
                                                                       'email'=>$data_address->email,
                                                                       'first_Name'=>$data_address->first_name,
                                                                       'Last_Name'=>$data_address->last_name,
                                                                       'post_code'=>$data_address->post_code,
                                                                       'Street_address'=>$data_address->street_address,
                                                                       'state'=>$data_address->state,
                                                                       'city'=>$data_address->city,
                                                                       'phone_number'=>$data_address->phone,
                                                                     );
                                                                     header('Access-Control-Allow-Origin: *');
                                                                     $res = array('message'=>"success",
                                                                     'status'=>200,
                                                                     'data'=>$get_address
                                                                     );

                                                                     echo json_encode($res);


                                                            }else{
                                                              header('Access-Control-Allow-Origin: *');
                                                              $res=array(
                                                                'message'=>"this user no address",
                                                                'status'=>201
                                                              );
                                                              echo json_encode($res);
                                                            }

                                            }else{
                                              header('Access-Control-Allow-Origin: *');
                                              $res=array(
                                                'message'=>"wrong password,Try again.",
                                                'status'=>201
                                              );
                                              echo json_encode($res);
                                            }
                                          }else{
                                            header('Access-Control-Allow-Origin: *');
                                            $res=array(
                                              'message'=>"wrong email,Try again.",
                                              'status'=>201
                                            );
                                            echo json_encode($res);
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


}
