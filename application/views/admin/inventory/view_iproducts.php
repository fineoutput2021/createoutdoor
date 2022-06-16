<div class="content-wrapper">
<section class="content-header">
<h1>
Products
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <!-- <li><a href="<?php echo base_url() ?>dcadmin/inventory/view_icategory"><i class="fa fa-dashboard"></i> View category </a></li> -->
  <li><a href="<?php echo base_url() ?>dcadmin/inventory/view_isubcategory"><i class="fa fa-dashboard"></i> View Subcategory </a></li>
</ol>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Products</h3>
</div>
<div class="panel panel-default">

<? if(!empty($this->session->flashdata('smessage'))){ ?>
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h4><i class="icon fa fa-check"></i> Alert!</h4>
<? echo $this->session->flashdata('smessage'); ?>
</div>
<? }
if(!empty($this->session->flashdata('emessage'))){ ?>
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h4><i class="icon fa fa-ban"></i> Alert!</h4>
<? echo $this->session->flashdata('emessage'); ?>
</div>
<? } ?>


<div class="panel-body">
<div class="box-body table-responsive no-padding">
<table class="table table-bordered table-hover table-striped" id="userTable">
<thead>
<tr>
<th>#</th>
<th>Category</th>
<th>Subcategory</th>

<th>Product Name</th>
<th>Image</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($product_list->result() as $data) { ?>
<tr>
<td><?php echo $i ?> </td>

<td><?php  $cid=json_decode($data->category);
foreach($cid as $category_data){
$this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id',$category_data);
            $dsa= $this->db->get();
            $da=$dsa->row();
            if(!empty($da)){
            echo $da->title;
            echo "<br>";
          }else{
            echo "";
          }
}
?></td>
<td><?php  $sid=json_decode($data->subcategory);
foreach($sid as $subcategory_data){


$this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('id',$subcategory_data);
            $dsa_sub= $this->db->get();
            $data_sub=$dsa_sub->row();

            if(!empty($data_sub)){



            echo $data_sub->subcategory;
          }else{
            echo "";
          }
}

?></td>
<td>
<?
echo $data->productname;

?>

</td>
<td>
<?php if($data->image!=""){  ?>
<img id="slide_img_path" height=50 width=100  src="<?php echo base_url().$data->image ?>" >
<?php }else {  ?>
Sorry No image Found
<?php } ?>

</td>

<!-- <td>

  // echo $data->id;
  // exit;
  //             $this->db->select('*');
  // $this->db->from('tbl_type');
  // $this->db->where('product_id',$data->id);
  // $type= $this->db->get()->row();
  // if(!empty($type)){
  //     echo $type->name;
  // }else{
  //   echo "some error occured";
  // }
  //


</td> -->
<td>
<div class="btn-group" id="btns<?php echo $i ?>">
<div class="btn-group">
<button type="button" class="btn btn-default">
<a href="<?=base_url()?>dcadmin/inventory/view_type/<?=base64_encode($data->id);?>">
  View type </button>

</div>
</div>
</td>
</tr>
<?php $i++; } ?>
</tbody>
</table>






</div>
</div>
</div>

</div>

</div>
</div>
</section>
</div>


<style>
label{
margin:5px;
}
</style>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#userTable').DataTable({
responsive: true,
// bSort: true
});

$(document.body).on('click', '.dCnf', function() {
var i=$(this).attr("mydata");
console.log(i);

$("#btns"+i).hide();
$("#cnfbox"+i).show();

});

$(document.body).on('click', '.cans', function() {
var i=$(this).attr("mydatas");
console.log(i);

$("#btns"+i).show();
$("#cnfbox"+i).hide();
})

});

</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->
