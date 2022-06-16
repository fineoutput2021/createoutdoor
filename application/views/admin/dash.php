
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/System/view_team">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ionicons ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Team members</span>
                  <span class="info-box-number"><?$this->db->select('*');
                  $this->db->from('tbl_team');
                  $count_team = $this->db->count_all_results();
                  echo $count_team;
                  ?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Products/view_products">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ionicons ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Products</span>
                  <span class="info-box-number"><?$this->db->select('*');
                  $this->db->from('tbl_products');
                  $tot_prod = $this->db->count_all_results();
                  echo $tot_prod;
                  ?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Abandoncart/view_Abandon_cart">
              <div class="info-box">
                <span class="info-box-icon bg-grey"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Abandoned carts</span>
                  <span class="info-box-number"><?
                   $this->db->select('user_id,token_id');
                   $this->db->distinct();
                   // $this->db->where('user_id is NOT NULL', null, false);
                   $this->db->order_by('id', 'desc');
                   $cart_data = $this->db->get('tbl_cart');
                   $i = 0;
                   foreach($cart_data as $cart){
                     $i++;
                   }
                   echo $i;
                   ?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="javascript:void(0)">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number"><?$this->db->select('*');
                  $this->db->from('tbl_order1');
                  $this->db->where('order_status != ', 0);
                  $order_count = $this->db->count_all_results(); echo $order_count;?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Neworder/view_order">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ionicons ion-bag"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Orders</span>
                  <span class="info-box-number"><?$this->db->select('*');
                  $this->db->from('tbl_order1');
                  $this->db->where('order_status', 1);
                  $order_count = $this->db->count_all_results(); echo $order_count;?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->
