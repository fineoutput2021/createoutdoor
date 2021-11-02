<div class="content-wrapper">
<section class="content-header">
<h1>
Update Products
</h1>

</section>
<section class="content">
<div class="row">
<div class="col-lg-12">

<div class="panel panel-default">
<div class="panel-heading">
 <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Products</h3>
</div>

      <? if(!empty($this->session->flashdata('smessage'))){  ?>
           <div class="alert alert-success alert-dismissible">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <h4><i class="icon fa fa-check"></i> Alert!</h4>
      <? echo $this->session->flashdata('smessage');  ?>
     </div>
        <? }
        if(!empty($this->session->flashdata('emessage'))){  ?>
        <div class="alert alert-danger alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
     <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <? echo $this->session->flashdata('emessage');  ?>
   </div>
      <? }  ?>


<div class="panel-body">
 <div class="col-lg-10">
    <form action=" <?php echo base_url()  ?>dcadmin/products/add_products_data/<? echo base64_encode(2);?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
 <div class="table-responsive">
     <table class="table table-hover">
<tr>
<td> <strong>Product Name</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="productname"  class="form-control" placeholder=""  value="<?=$products_data->productname?>" />  </td>
</tr>
<tr>
<td> <strong>Category Name</strong>  <span style="color:red;">*</span></strong> </td>
<td>
<select class="form-control" id="cid" name="category">
<option value="">Please select category</option>

<?

foreach($category_data->result() as $value) {?>
<option value="<?=$value->id;?>"<?php if($products_data->category == $value->id){ echo "selected"; } ?>><?=$value->title;?></option>
<? }?>
</select>
</td>
</tr>

<tr>
<td> <strong>Subcategory Name</strong>  <span style="color:red;">*</span></strong> </td>
<td>
<select class="form-control" id="sid" name="sub_category">
  <?php foreach ($subcategory_data->result() as $sub){ ?>


  <option value="<?=$sub->id;?>" <?php if($products_data->subcategory == $sub->id){ echo "selected"; } ?>><?=$sub->subcategory;?></option>
  <? } ?>
</select>


</td>
</tr>

<tr>
<td> <strong>image</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="image"  class="form-control" placeholder=""  value="<?=$products_data->image?>" />
<?php if($products_data->image!=""){ ?>
<img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$products_data->image
?>" >
<?php }else { ?>
Sorry No File Found
<?php } ?>

</td>
</tr>
<tr>
<td> <strong>image1</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="image1"  class="form-control" placeholder=""  value="<?=$products_data->image1?>" />
<?php if($products_data->image1!=""){ ?>
<img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$products_data->image1
?>" >
<?php }else { ?>
Sorry No File Found
<?php } ?>

   </td>

</tr>
<tr>
<td> <strong>image2</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="image2"  class="form-control" placeholder=""  value="<?=$products_data->image2?>" />
<?php if($products_data->image2!=""){ ?>
<img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$products_data->image2
?>" >
<?php }else { ?>
Sorry No File Found
<?php } ?>
</td>





</tr>
<tr>
<td> <strong>image3</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="image3"  class="form-control" placeholder=""  value="<?=$products_data->image3?>" />

<?php if($products_data->image3!=""){ ?>
<img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$products_data->image3
?>" >
<?php }else { ?>
Sorry No File Found
<?php } ?>
</td>


</tr>
<tr>
<td> <strong>Product Description</strong>  <span style="color:red;">*</span></strong> </td>
<!-- <td> <input type="text" name="productdescription"  class="form-control" placeholder="" required value="" />  </td> -->
<td>
  <textarea id="editor1" name="productdescription"><?=$products_data->productdescription?></textarea>
</td>
</tr>
<tr>
<td> <strong>Model No.</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="modelno"  class="form-control" placeholder=""  value="<?=$products_data->	modelno?>" />  </td>
</tr>

<tr>
<td> <strong>Lead Time</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="leadtime">
<!-- <option value="" selected>Select</option> -->
<?php foreach($leadtime_data->result() as $lead){ ?>
<option value="<?=$lead->id?>"  <?php if($products_data->leadtime_id == $lead->id){ echo "selected"; } ?>><?php echo $lead->filtername?></option>
<? } ?>
</select>  </td>
</tr>

<tr>
<td> <strong>Seating</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="seating">

<?php foreach($seating_data->result() as $seating){ ?>
<option value="<?=$seating->id?>" <?php if($products_data->seating_id == $seating->id){ echo "selected"; } ?>><?php echo $seating->filtername?></option>
<? } ?>
</select>  </td>
</tr>
<tr>
<td> <strong>Shape</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="shape">

<?php foreach($shape_data->result() as $shape){ ?>
<option value="<?=$shape->id?>" <?php if($products_data->shape_id == $shape->id){ echo "selected"; } ?>><?php echo $shape->filtername?></option>
<? } ?>
</select>  </td>
</tr>

<tr>
<td> <strong>Furniture Type</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="furniture">

<?php foreach($furniture_type->result() as $furniture){ ?>
<option value="<?=$furniture->id?>" <?php if($products_data->furniture_type_id == $furniture->id){ echo "selected"; } ?>><?php echo $furniture->filtername?></option>
<? } ?>
</select>  </td>
</tr>
<tr>
<td> <strong>Feature</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="feature">

<?php foreach($feature_data->result() as $feature){ ?>
<option value="<?=$feature->id?>" <?php if($products_data->feature_id == $feature->id){ echo "selected"; } ?>><?php echo $feature->filtername?></option>
<? } ?>
</select>  </td>
</tr>



<tr>
<td colspan="2" >
<input type="submit" class="btn btn-success" value="save">
</td>
</tr>
         </table>
     </div>

  </form>

     </div>



 </div>

</div>

</div>
</div>
</section>
</div>


<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
$(document).ready(function(){
$("#cid").change(function(){
var vf=$(this).val();
// var yr = $("#year_id option:selected").val();
if(vf==""){
return false;

}else{
$('#sid option').remove();
var opton="<option value=''>Please Select </option>";
$.ajax({
url:base_url+"dcadmin/products/getSubcategory?isl="+vf,
data : '',
type: "get",
success : function(html){
if(html!="NA")
{
var s = jQuery.parseJSON(html);
$.each(s, function(i) {
opton +='<option value="'+s[i]['sub_id']+'">'+s[i]['sub_name']+'</option>';
});
$('#sid').append(opton);
//$('#city').append("<option value=''>Please Select State</option>");

//var json = $.parseJSON(html);
//var ayy = json[0].name;
//var ayys = json[0].pincode;
}
else
{
alert('No Subcategory Found');
return false;
}

}

})
}


})
});
</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
                        CKEDITOR.replace( 'editor1' );
                </script>
