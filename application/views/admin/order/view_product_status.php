<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Order Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url() ?>admin/college"><i class="fa fa-dashboard"></i> All  Orders </a></li>
      <li class="active">View Order Details</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/Neworder/view_order" role="button" style="margin-bottom:12px;">Back</a>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Order Details</h3>
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
                      <th>User</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>Pincode</th>
                      <th>Product</th>
                      <th>Model No.</th>
                      <th>Type</th>
                      <th>Sample</th>
                      <th>Quantity</th>
                      <th>Amount</th>
                      <th>date</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach($status_product->result() as $data) {
                      $this->db->select('*');
                      $this->db->from('tbl_order1');
                      $this->db->where('id',$data->main_id);
                      $order_data= $this->db->get()->row();
                      ?>
                    <tr>
                      <td><?php echo $i ?> </td>
                      <td><?php if(!empty($order_data->user_id) ){
                        if(!is_null($order_data->user_id) == false){
                        $this->db->select('*');
                        $this->db->from('tbl_users');
                        $this->db->where('id',$order_data->user_id);
                        $users_data= $this->db->get()->row();
                        echo $users_data->name;
                      }else{
                          echo $order_data->first_name." ".$order_data->last_name;
                        }
                    }else{
                        echo $order_data->first_name." ".$order_data->last_name;
                      }
                       ?> </td>
                      <td><?php echo $order_data->street_address ?> </td>
                      <td>
                        <?
                        $this->db->select('*');
                        $this->db->from('all_states');
                        $this->db->where('id',$order_data->state);
                        $state_data= $this->db->get()->row();
                        echo $state_data->state_name;?>
                      </td>
                      <td><?php echo $order_data->post_code ?> </td>
                      <td><?php $p_id=$data->product_id;
                                         $this->db->select('*');
                                                     $this->db->from('tbl_products');
                                                     $this->db->where('id',$p_id);
                                                     $get_pname= $this->db->get()->row();
                                                     if(!empty($get_pname)){
                                                    echo $get_pname->productname;
                                                  }else{
                                                    echo "";
                                                  }
                                                      ?></td>
                            <td><?php $p_id=$data->product_id;
                                               $this->db->select('*');
                                                           $this->db->from('tbl_products');
                                                           $this->db->where('id',$p_id);
                                                           $get_pname= $this->db->get()->row();
                                                           if(!empty($get_pname)){
                                                          echo $get_pname->modelno;
                                                        }else{
                                                          echo "";
                                                        }
                                  ?></td>
                      <td><?php

                      $type_id=$data->type_id;
                                         $this->db->select('*');
                                                     $this->db->from('tbl_type');
                                                     $this->db->where('id',$type_id);
                                                     $get_tname= $this->db->get()->row();

                                                     if(!empty($get_tname)){
                                                         echo $get_tname->name;
                                                     }else{
                                                    echo "";
                                                  }


                            ?></td>

                      <td><?php if(!empty($data->sample)){echo "Yes";}else{ echo "No";}?> </td>
                      <td><?php echo $data->quantity; ?> </td>
                      <td><?php echo $data->type_amt; ?> </td>
                      <td><?php echo $data->date; ?> </td>




                      <!-- <td>
<div class="btn-group" id="btns<?php echo $i ?>">
<div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
<ul class="dropdown-menu" role="menu">

<?php if($data->is_active==1){ ?>
<li><a href="<?php echo base_url() ?>admin/home/updateteamStatus/<?php echo base64_encode($data->id) ?>/inactive">Inactive</a></li>
<?php } else { ?>
<li><a href="<?php echo base_url() ?>admin/course/updateteamStatus/<?php echo base64_encode($data->id) ?>/active">Active</a></li>
<?php		}   ?>
<li><a href="<?php echo base_url() ?>admin/home/update_team/<?php echo base64_encode($data->id) ?>">Edit</a></li>
<li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
</ul>
</div>
</div>

<div style="display:none" id="cnfbox<?php echo $i ?>">
<p> Are you sure delete this </p>
<a href="<?php echo base_url() ?>admin/home/delete_team/<?php echo base64_encode($data->id); ?>" class="btn btn-danger" >Yes</a>
<a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>" >No</a>
</div>
</td> -->
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
  label {
    margin: 5px;
  }
</style>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  $(document.body).on('click', '.dCnf', function() {
    var i = $(this).attr("mydata");
    console.log(i);

    $("#btns" + i).hide();
    $("#cnfbox" + i).show();

  });

  $(document.body).on('click', '.cans', function() {
  var i = $(this).attr("mydatas");
  console.log(i);

  $("#btns" + i).show();
  $("#cnfbox" + i).hide();
  })

  });
</script>
<script type="text/javascript">
  $('#userTable').dataTable({
    responsive: true,
    "bStateSave": true,
    "fnStateSave": function(oSettings, oData) {
      localStorage.setItem('offersDataTables', JSON.stringify(oData));
    },
    "fnStateLoad": function(oSettings) {
      return JSON.parse(localStorage.getItem('offersDataTables'));
    }
  });
</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->
