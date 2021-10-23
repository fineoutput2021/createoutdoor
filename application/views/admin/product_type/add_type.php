                          <div class="content-wrapper">
                                  <section class="content-header">
                                     <h1>
                                    Add New Type
                                    </h1>
                                    <ol class="breadcrumb">
                                     <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                                      <li><a href="<?php echo base_url() ?>admin/college"><i class="fa fa-dashboard"></i> All Type </a></li>

                                    </ol>
                                  </section>

                          		<section class="content">
                          		<div class="row">
                                 <div class="col-lg-12">

                                                  <div class="panel panel-default">
                                                      <div class="panel-heading">
                                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Type</h3>
                                                      </div>

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
                                                          <div class="col-lg-10">
                                                             <form action="<?php echo base_url() ?>dcadmin/product_type/add_data_type/<? echo base64_encode(1); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                                          <div class="table-responsive">
                                                              <table class="table table-hover">




                          											<tr>
                                                                          <td> <strong>Name</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="name"  class="form-control" placeholder="" required value="" />
                          	                                            </td>
                              										</tr>

                                                  <input type="hidden" name="p_id"  class="form-control" placeholder="" required value="<?=$id?>" />
                          											<tr>
                                                                          <td> <strong>MRP</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="mrp"  class="form-control" placeholder="" required value="" />
                          	                                            </td>
                              										</tr>

                          											<tr>
                                                                          <td> <strong>Selling Price(without GST)</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="sellingprice"  class="form-control" placeholder="" required value="" id="sp" />
                          	                                            </td>
                              										</tr>
                                                  <tr>
                                                                            <td> <strong>GST%</strong>  <span style="color:red;">*</span></strong> </td>
                                                                            <td>
                            													<input type="text" name="gst"  class="form-control" placeholder="" required value="" id="gst" />
                            	                                            </td>
                                										</tr>
                          											<tr>
                                                                          <td> <strong>GST%Price</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="gstprice"  class="form-control" placeholder="" required value="" id="gstprice"/>
                          	                                            </td>
                              										</tr>
                          											<tr>
                                                                          <td> <strong>Selling Price</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="price"  class="form-control" placeholder="" required value="" id="sellingprice"/>
                          	                                            </td>
                              										</tr>
                          											<tr>
                                                                          <td> <strong>color</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="color" name="color"  class="form-control" placeholder="" required value="" />
                          	                                            </td>
                              										</tr>
                          											<tr>
                                                                          <td> <strong>weight</strong>  <span style="color:red;">*</span></strong> </td>
                                                                          <td>
                          													<input type="text" name="weight"  class="form-control" placeholder="" required value="" />
                          	                                            </td>
                                                        <input type="hidden" name="p_id"  class="form-control" placeholder="" required value="<?=$id?>" />
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

<script type="text/javascript">
$(document).ready(function(){
  $('#gst').keyup(function() {

    var price=$('#sp').val();
    // alert("hello" + price);
    var gst=$('#gst').val();
    // alert('hello '+ price +"gst"+gst);

        $('#gstprice').val(price * gst/100);
      var sprice=$('#gstprice').val();
     var v1=parseInt($('#sp').val());
     var v2=parseInt($('#gstprice').val());
     var v3=v1 + v2;
     $('#sellingprice').val(v3);







  });
});

</script>
