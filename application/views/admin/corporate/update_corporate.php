<div class="content-wrapper">
        <section class="content-header">
           <h1>
          Add New Corporate
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dcadmin/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/corporate/view_corporate"><i class="icon-undo"></i> View Corporate </a></li>
            <!-- <li class="active">View Corporate</li> -->
          </ol>
        </section>
    <section class="content">
    <div class="row">
       <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Corporate</h3>
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
                                   <form action="<?php echo base_url() ?>dcadmin/corporate/add_data_corporate/<? echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                      <tr>
                                                                <td> <strong>First Name</strong>  <span style="color:red;">*</span></strong> </td>
                                                                <td>
                                          <input type="text" name="firstname"  class="form-control" placeholder="" required value="<?=$data_image->firstname?>" />
                                                              </td>
                                        </tr>
                                      <tr>
                                                                <td> <strong>Last Name</strong>  <span style="color:red;">*</span></strong> </td>
                                                                <td>
                                          <input type="text" name="lastname"  class="form-control" placeholder="" required value="<?=$data_image->lastname?>" />
                                                              </td>
                                        </tr>
                                      <tr>
                                                                <td> <strong>Business Name</strong>  <span style="color:red;">*</span></strong> </td>
                                                                <td>
                                          <input type="text" name="businessname"  class="form-control" placeholder="" required value="<?=$data_image->businessname?>" />
                                                              </td>
                                        </tr>
                                      <tr>
                                                                <td> <strong>Email</strong>  <span style="color:red;">*</span></strong> </td>
                                                                <td>
                                          <input type="text" name="email"  class="form-control" placeholder="" reqcorporateuired value="<?=$data_image->email?>" />
                                                              </td>
                                        </tr>
                                        <tr>
                                                                  <td> <strong>Message</strong>  <span style="color:red;">*</span></strong> </td>
                                                                  <td>
                                            <input type="text" name="message"  class="form-control" placeholder="" reqcorporateuired value="<?=$data_image->message?>" />
                                                                </td>
                                          </tr>

                      <tr>
                                                <td> <strong>IMAGE 1</strong>  <span style="color:red;">*</span></strong> </td>
                                                <td>
                          <input type="file" name="image1"  class="form-control" placeholder=""  value="" />

                          <?php if($data_image->image1!=""){  ?>
    <img id="slide_img_path" height=50 width=100  src="<?php echo base_url().$data_image->image1 ?>" >
                      <?php }else {  ?>
                      Sorry No image Found
                      <?php } ?>
                                              </td>
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
