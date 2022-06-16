<div class="content-wrapper">
<section class="content-header">
   <h1>
  Update Two Images
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() ?>dcadmin/sale/view_sale"><i class="icon-undo"></i> View Two Images </a></li>
    <!-- <li class="active">View Categories</li> -->
  </ol>
</section>
<section class="content">
<div class="row">
<div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Two Images </h3>
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
                           <form action=" <?php echo base_url(); ?>dcadmin/sale/add_sale_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
<tr>
<td> <strong>Title</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="title"  class="form-control" placeholder="" required value="<?=$sale_data->title;?>" />  </td>
</tr>
<tr>
<td> <strong>Description</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="text" name="description"  class="form-control" placeholder="" required value="<?=$sale_data->description;?>" />  </td>
</tr>
<tr>
<td> <strong>Link</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="url" name="link"  class="form-control" placeholder="" required value="<?=$sale_data->link;?>" />  </td>
</tr>
<tr>
<td> <strong>Image</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload1"  class="form-control" placeholder="" />
<?php if($sale_data->image!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$sale_data->image; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
</tr>
<tr>
<td> <strong>image1</strong>  <span style="color:red;">*</span></strong> </td>
<td> <input type="file" name="fileToUpload2"  class="form-control" placeholder="" />
<?php if($sale_data->image1!=""){ ?> <img id="slide_img_path" height=200 width=300 src="<?php echo base_url().$sale_data->image1; ?> "> <?php }else{ ?> Sorry No File Found <?php } ?>  </td>
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
