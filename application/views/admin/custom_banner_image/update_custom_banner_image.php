<div class="content-wrapper">
<section class="content-header">
   <h1>
  Update Custom banner Image
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() ?>dcadmin/custom_banner_image/view_custom_banner_image"><i class="icon-undo"></i> View Custom Banner Image</a></li>
    <!-- <li class="active">View Categories</li> -->
  </ol>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Custom banner image </h3>
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
                           <form action=" <?php echo base_url(); ?>dcadmin/custom_banner_image/add_custom_banner_image_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
<tr>
<td> <strong>Home image</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="home_image"  class="form-control" placeholder="" />
<?php if($custom_banner_image_data->home_image!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$custom_banner_image_data->home_image; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
<tr>
<td> <strong>Detail Image 1</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="detail_image_1"  class="form-control" placeholder="" />
<?php if($custom_banner_image_data->detail_image_1!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$custom_banner_image_data->detail_image_1; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
<tr>
<td> <strong>Detail Image 2</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="detail_image_2"  class="form-control" placeholder="" />
<?php if($custom_banner_image_data->detail_image_2!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$custom_banner_image_data->detail_image_2; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
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
