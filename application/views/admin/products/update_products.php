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
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Products </h3>
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
                           <form action=" <?php echo base_url(); ?>dcadmin/products/add_products_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
<tr>
<td> <strong>productname</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="name"  class="form-control" placeholder=""  value="<?=$products_data->name;?>" />  </td>
</tr>

<tr>
<td> <strong>Category</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="categoryname" id="cid">
  <option value="" selected>Select category</option>
  <?php $i=1; foreach($category->result() as $data) { ?>
<option value="<?=$data->id;?>" <?php if($products_data->category_id == $data->id){ echo 'selected';} ?> ><?=$data->categoryname;?></option>
<?php $i++; } ?>
</select> </td>
</tr>
<tr>
<td> <strong>Subcategory</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="subcategoryname" id="sid">
  <option value="" selected>Select Subcategory</option>
  <?php foreach ($subcategory->result() as  $value){?>

              <option value="<?=$value->id?>" <?php if($products_data->subcategory_id == $value->id){ echo 'selected';} ?> ><?php echo $value->name?></option>


                            <? } ?>

</select> </td>
</tr>


<tr>
<td> <strong>productimage</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="image"  class="form-control" placeholder="" />
<?php if($products_data->image!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$products_data->image; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
<tr>
<td> <strong>productimage1</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload1"  class="form-control" placeholder=""  value="" />
<?php if($products_data->image1!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$products_data->image1; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
</tr>
<tr>
<tr>
<td> <strong>productimage2</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload2"  class="form-control" placeholder=""  value="<?=$products_data->image2;?>" />
<?php if($products_data->image2!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$products_data->image2; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
</tr>
<tr>
<tr>
<td> <strong>productimage3</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload3"  class="form-control" placeholder=""  value="<?=$products_data->image3;?>" />
<?php if($products_data->image3!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$products_data->image3; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
</tr>
<tr>
<tr>
<td> <strong>productimage4</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload4"  class="form-control" placeholder=""  value="<?=$products_data->image4;?>" />
<?php if($products_data->image4!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$products_data->image4; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
</tr>



<tr>
<td> <strong>mrp</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="mrp"  class="form-control" placeholder=""  value="<?=$products_data->mrp;?>" />  </td>
</tr>
<tr>
<td> <strong>productdescription</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="productdescription"  class="form-control" placeholder=""  value="<?=$products_data->productdescription;?>" />  </td>
</tr>
<tr>
<td> <strong>colours</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="color" name="colours"  class="form-control" placeholder=""  value="<?=$products_data->colours;?>" />  </td>
</tr>
<tr>
<td> <strong>inventory</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="inventory"  class="form-control" placeholder=""  value="<?=$products_data->inventry;?>" />  </td>
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


  <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
  <link href="<? echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
  <script>
  $(document).ready(function(){
    	$("#cid").change(function(){
  		var vf=$(this).val();
      //var yr = $("#year_id option:selected").val();
  		if(vf==""){
  			return false;

  		}else{
  			$('#sid option').remove();
  			  var opton="<option value=''>Please Select </option>";
  			$.ajax({
  				url:base_url+"dcadmin/Products/getSubcategory?isl="+vf,
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
  							alert('No Branch Found');
  							return false;
  						}

  					}

  				})
  		}


  	})
    });

  </script>
