<div class="content-wrapper">
<section class="content-header">
   <h1>
  Update Testimonials
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() ?>dcadmin/Testimonals/view_Testimonals"><i class="icon-undo"></i> View Testimonials </a></li>
    <!-- <li class="active">View Order</li> -->
  </ol>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Testimonials </h3>
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
                           <form action=" <?php echo base_url(); ?>dcadmin/Testimonals/add_Testimonals_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
<tr>
<td> <strong>name</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="Name"  class="form-control" placeholder="" required value="<?=$Testimonals_data->Name;?>" />  </td>
</tr>
<tr>
<td> <strong>image</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="Image"  class="form-control" placeholder=""  value="" />

  <?php if($Testimonals_data->Image!=""){ ?>
  <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$Testimonals_data->Image
  ?>" >
  <?php }else { ?>
  Sorry No File Found
  <?php } ?>



</td>
</tr>
<tr>
<td> <strong>description</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="Description"  class="form-control" placeholder="" required value="<?=$Testimonals_data->Description;?>" />  </td>
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
