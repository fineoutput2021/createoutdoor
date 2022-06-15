<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Products
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/products/view_products"><i class="icon-undo"></i> View Product </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Products</h3>
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
              <form action=" <?php echo base_url()  ?>dcadmin/products/add_products_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">


                    <tr>
                      <td> <strong>Product Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="productname" class="form-control" placeholder="" required value="" /> </td>
                    </tr>

                    <tr>
                      <td> <strong>Subcategory Name</strong> <span style="color:red;">*</span></strong> </td>


                      <td>

                        <select class="selectpicker form-control" multiple data-live-search="true" name="sub_category[]" required>
                          <? foreach($subcategory_data->result() as $value){?>
                          <option value="<?=$value->id;?>"><?=$value->subcategory?></option>

                          <? } ?>
                        </select>
                    </tr>

                    <!-- <tr>
<td> <strong>Subcategory Name</strong>  <span style="color:red;">*</span></strong> </td>
<td>
<select class="form-control" id="sid" name="sub_category">
</select>


</td>
</tr> -->

                    <tr>
                      <td> <strong>image</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="file" name="image" class="form-control" placeholder="" required value="" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>image1</strong></td>
                      <td> <input type="file" name="image1" class="form-control" placeholder="" value="" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>image2</strong></td>
                      <td> <input type="file" name="image2" class="form-control" placeholder="" value="" /> </td>
                    </tr>
                    <tr>
                      <td> <strong>image3</strong></td>
                      <td> <input type="file" name="image3" class="form-control" placeholder="" value="" /> </td>
                    </tr>
                    <tr>
                      <tr>
                        <td> <strong>Video</strong></td>
                        <td> <input type="file" name="video" class="form-control" placeholder="" value="" /> </td>
                      </tr>
                      <tr>
                      <td> <strong>Product Description</strong> <span style="color:red;">*</span></strong> </td>
                      <!-- <td> <input type="text" name="productdescription"  class="form-control" placeholder="" required value="" />  </td> -->
                      <td>
                        <textarea id="editor1" name="productdescription" required></textarea>

                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Product Specification</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea id="editor2" name="productspecification" required></textarea>

                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Model no.</strong> <span style="color:red;">*</span></strong> </td>
                      <td> <input type="text" name="modelno" class="form-control" placeholder="" required value="" /> </td>
                    </tr>
                    <tr>
                      <td><strong>Top Products</strong></strong> </td>
                      <td><input type="radio" id="yes" name="top" value="1">
                        <label for="yes">Yes</label>
                        <input type="radio" id="no" name="top" value="0" checked>
                        <label for="no">No</label>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Lead Time</strong> </strong> </td>
                      <td> <select class="form-control" name="leadtime">
                          <option value="" selected>Select</option>
                          <?php foreach($leadtime_data->result() as $lead){ ?>
                          <option value="<?=$lead->id?>"><?php echo $lead->filtername?></option>
                          <? } ?>
                        </select> </td>
                    </tr>

                    <tr>
                      <td> <strong>Seating</strong> </strong> </td>
                      <td> <select class="form-control" name="seating">
                          <option value="" selected>Select</option>
                          <?php foreach($seating_data->result() as $seating){ ?>
                          <option value="<?=$seating->id?>"><?php echo $seating->filtername?></option>
                          <? } ?>
                        </select> </td>
                    </tr>
                    <tr>
                      <td> <strong>Shape</strong> </strong> </td>
                      <td> <select class="form-control" name="shape">
                          <option value="" selected>Select</option>
                          <?php foreach($shape_data->result() as $shape){ ?>
                          <option value="<?=$shape->id?>"><?php echo $shape->filtername?></option>
                          <? } ?>
                        </select> </td>
                    </tr>

                    <tr>
                      <td> <strong>Furniture Type</strong> </strong> </td>
                      <td> <select class="form-control" name="furniture">
                          <option value="" selected>Select</option>
                          <?php foreach($furniture_type->result() as $furniture){ ?>
                          <option value="<?=$furniture->id?>"><?php echo $furniture->filtername?></option>
                          <? } ?>
                        </select> </td>
                    </tr>
                    <tr>
                      <td> <strong>Feature</strong> </strong> </td>
                      <td> <select class="form-control" name="feature">
                          <option value="" selected>Select</option>
                          <?php foreach($feature_data->result() as $feature){ ?>
                          <option value="<?=$feature->id?>"><?php echo $feature->filtername?></option>
                          <? } ?>
                        </select> </td>
                    </tr>



                    <tr>
                      <td colspan="2">
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

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>



<script type="text/javascript" src=" <?php echo base_url()?>assets/slider/ajaxupload.3.5.js"></script>
<link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
  $('select').selectpicker();
</script>

<script>
  // for(let i=0;i<document.getElementsByClassName("cid").length;i++){
  //   document.getElementsByClassName("cid")[i].addEventListner("change",c_id())
  // }
  var cid_obj = {}
  cid_obj.ids = []
  localStorage.setItem('cid_arr', JSON.stringify(cid_obj))

  function c_id(e) {
    var vf = e.target.value;
    alert(e.target.getAttribute("data"));

    // var yr = $("#year_id option:selected").val();
    if (vf == "") {
      console.log("!")
      const arr = JSON.parse(localStorage.getItem('cid_arr'));
      console.log(arr)
      // alert("fgfdf",e.target.getAttribute("data"))
      var index = arr.ids.indexOf(e.target.getAttribute("data"))
      console.log(index)

      if (index > -1) {
        arr.ids.splice(index, 1);
      }
      localStorage.setItem("cid_arr", JSON.stringify(arr))

      e.target.value = e.target.getAttribute("data");

      $('#sid option').remove();

      return false;

    } else {
      // var arr = [];
      // if(localStorage.getItem('cid_arr')!==null){
      console.log("!")

      const arr = JSON.parse(localStorage.getItem('cid_arr'));
      // alert(arr);

      const newData = {};

      newData.ids = [...arr.ids, e.target.value]
      localStorage.setItem("cid_arr", JSON.stringify(newData))
      // }
      $('#sid option').remove();
      var opton = "<option value=''>Please Select </option>";
      var data = JSON.parse(localStorage.getItem('cid_arr'))
      // console.log('data',data)
      $.ajax({
        url: base_url + "dcadmin/products/getSubcategory",
        data: data,
        type: "post",
        success: function(html) {
          if (html != "NA") {

            console.log(html)
            var s = jQuery.parseJSON(html);
            console.log(s);
            $.each(s, function(i) {
              opton += '<option value="' + s[i]['sub_id'] + '">' + s[i]['sub_name'] + '</option>';
            });
            $('#sid').append(opton);
            //$('#city').append("<option value=''>Please Select State</option>");

            //var json = $.parseJSON(html);
            //var ayy = json[0].name;
            //var ayys = json[0].pincode;
          } else {
            alert('No Subcategory Found');
            return false;
          }

        }

      })
      e.target.value = "";
    }


  }

  // $(document).ready(function(){
  //   	$("#cid").change(function(){
  // 		var vf=$(this).val();
  //
  //     // var yr = $("#year_id option:selected").val();
  // 		if(vf==""){
  //       $(this).val("1");
  //       $('#sid option').remove();
  //
  // 			return false;
  //
  // 		}else{
  // 			$('#sid option').remove();
  // 			  var opton="<option value=''>Please Select </option>";
  // 			$.ajax({
  // 				url:base_url+"dcadmin/products/getSubcategory?isl="+vf,
  // 				data : '',
  // 				type: "get",
  // 				success : function(html){
  // 						if(html!="NA")
  // 						{
  // 							var s = jQuery.parseJSON(html);
  // 							$.each(s, function(i) {
  // 							opton +='<option value="'+s[i]['sub_id']+'">'+s[i]['sub_name']+'</option>';
  // 							});
  // 							$('#sid').append(opton);
  // 							//$('#city').append("<option value=''>Please Select State</option>");
  //
  //                       //var json = $.parseJSON(html);
  //                       //var ayy = json[0].name;
  //                       //var ayys = json[0].pincode;
  // 						}
  // 						else
  // 						{
  // 							alert('No Subcategory Found');
  // 							return false;
  // 						}
  //
  // 					}
  //
  // 				})
  // $(this).val("");
  //     }
  //
  //
  // 	})
  //
  //
  //   });
</script>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor1');
  CKEDITOR.replace('editor2');
</script>
