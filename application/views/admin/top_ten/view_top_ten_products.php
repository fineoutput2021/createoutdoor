<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Products
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View products</h3>
          </div>
          <div class="panel panel-default">
            <?php if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo $this->session->flashdata('smessage'); ?>
            </div>
            <?php }
        if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <?php echo $this->session->flashdata('emessage'); ?>
            </div>
            <?php } ?>


            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="userTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Product Name</th>
                      <th>Category Name</th>
                      <th>Subcategory Name</th>
                      <th>Image</th>
                      <th>Sequence</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
         foreach ($products_data->result() as $data) {
             $a=0;
             $sub = json_decode($data->subcategory);
             $count = count($sub);
             if ($count>1) {
                 foreach ($sub as $value) {
                     if ($value==base64_decode($id)) {
                         $a=1;
                     }
                 }
             } else {
                 if ($sub[0]==base64_decode($id)) {
                     $a=1;
                 }
             }
             if ($a==1) {
                 ?>
                    <tr>
                      <td><?php echo $i ?> </td>
                      <td><?php echo $data->productname?></td>

                      <td><?php $category_id=json_decode($data->category);
                 foreach ($category_id as $value) {
                     $this->db->select('*');
                     $this->db->from('tbl_category');
                     $this->db->where('id', $value);
                     $category_data= $this->db->get()->row();

                     if (!empty($category_data)) {
                         echo $category_name=$category_data->title;
                         echo ", ";
                     } else {
                         echo "No Category";
                     }
                 } ?></td>
                      <td><?php $subcategory_id=json_decode($data->subcategory);
                 if (!empty($subcategory_id)) {
                     foreach ($subcategory_id as $value1) {
                         $this->db->select('*');
                         $this->db->from('tbl_subcategory');
                         $this->db->where('id', $value1);
                         $subcategory_data= $this->db->get()->row();
                         if (!empty($subcategory_data)) {
                             echo $subcategory_name=$subcategory_data->subcategory;
                             echo ", ";
                         } else {
                             echo "";
                         }
                     }
                 } else {
                     echo "No Subcategory";
                 } ?></td>

                      <td>
                        <?php if ($data->image!="") { ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->image
        ?>">
                        <?php } else { ?>
                        Sorry No File Found
                        <?php } ?>
                      </td>

                      <td><?=$data->top_ten; ?></td>
                      <td>
                        <div class="btn-group" id="btns<?php echo $i ?>">
                          <div class="btn-group">
                            <?if (!empty($data->top_ten)) {?>
                    <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>dcadmin/Top_ten/remove_top_ten/<?=base64_encode($data->id)?>'">Remove</button>
                          <?} else {?>
                <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>dcadmin/Top_ten/add_top_ten/<?=$id?>/<?=base64_encode($data->id)?>'">Add</button>
                <?} ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php $i++;
             }
         }?>
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
  $(document).ready(function() {


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

<!-- <script type="text/javascript" src="<?php echo base_url()
        ?>assets/slider/ajaxupload.3.5.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script> -->
