<div class="content-wrapper">
        <section class="content-header">
           <h1>
           Coupon Codes
          </h1>
          <ol class="breadcrumb">
           <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url() ?>dcadmin/coupon/view_coupon"><i class="fa fa-dashboard"></i> All Coupon Codes </a></li>
            <li class="active">View Coupon Codes</li>
          </ol>
        </section>
          <section class="content">
          <div class="row">
             <div class="col-lg-12">
                 <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/coupon/add_coupon" role="button" style="margin-bottom:12px;"> Add Coupon Code</a>
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Coupon Codes</h3>
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
                                                  <th>Promocode</th>
                                                  <th>Date Range</th>
                                                  <th>Minimum Cart Value</th>
                                                  <th>Maximum Discount Amount</th>
                                                  <th>Discount Percentage</th>
                                                  <th>Status</th>
                                                  <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php $i=1; foreach($coupon_data->result() as $data) { ?>
                        <tr>
                            <td><?php echo $i ?> </td>
                            <td><?php echo $data->promocode ?></td>
                            <td><?php echo $data->start_date." To ".$data->end_date ?></td>
                            <td><?php echo $data->min_cart_amount ?></td>
                            <td><?php echo $data->maximum_discount ?></td>
                            <td><?php echo $data->discount_percent ?></td>
                              <td><?php if($data->is_active==1){ ?>
        <p class="label bg-green" >Active</p>

    <?php } else { ?>
        <p class="label bg-yellow" >Inactive</p>


<?php		}   ?>
      </td>
                    <td>
<div class="btn-group" id="btns<?php echo $i ?>">
<div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
<ul class="dropdown-menu" role="menu">

<?php if($data->is_active==1){ ?>
<li><a href="<?php echo base_url() ?>dcadmin/coupon/updatecouponStatus/<?php echo base64_encode($data->id) ?>/inactive">Inactive</a></li>
<?php } else { ?>
<li><a href="<?php echo base_url() ?>dcadmin/coupon/updatecouponStatus/<?php echo base64_encode($data->id) ?>/active">Active</a></li>
<?php		}   ?>
<li><a href="<?php echo base_url() ?>dcadmin/coupon/update_coupon/<?php echo base64_encode($data->id) ?>">Edit</a></li>
<li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
</ul>
</div>
</div>

<div style="display:none" id="cnfbox<?php echo $i ?>">
<p> Are you sure delete this </p>
<a href="<?php echo base_url() ?>dcadmin/coupon/delete_coupon/<?php echo base64_encode($data->id); ?>" class="btn btn-danger" >Yes</a>
<a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>" >No</a>
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
