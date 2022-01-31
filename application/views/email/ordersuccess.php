<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order Sucesss</title>
</head>
<body style="font-family: sans-serif;">

	<div style="width:100%">
		<!-- <div style="display: flex;">
			<h3>Order</h3>
		</div> -->
		<div>
			<p>Hi <?php echo $name; ?>,</p>
			<p>Welcome to Create Spaces family!</p>
			<p>Here are the details of your order placed on Date:</p>
													 <? $newdate = new DateTime($date);?>
			<h2 style="color: #ff700a;">[Order ID - <?php echo $order1_id; ?>] (<?php echo  $newdate->format('F j, Y'); ?>)</h2>
		</div>
		<div>
			<table style="border: 1px solid lightgrey; border-collapse: collapse;width: 100%;text-align: left;">
				<tr style="border: 1px solid lightgrey; border-collapse: collapse;text-align: left;">
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Product</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Quantity</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Price</th>
				</tr>
				<?
      			$this->db->select('*');
$this->db->from('tbl_order2');
$this->db->where('main_id',$order1_id);
$order_tbl= $this->db->get();
$sub_total=0;
				?>
				<?php foreach ($order_tbl->result() as $order) {
					      			$this->db->select('*');
					$this->db->from('tbl_products');
					$this->db->where('id',$order->product_id);
					$product= $this->db->get()->row();
					$pname=$product->productname;
					$total_amt=$order->total_amount;

			?>
				<tr style="border: 1px solid lightgrey; border-collapse: collapse;">
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><?php echo $pname; ?></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><?php echo $order->quantity; ?></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><b>Rs.</b><?php echo $total_amt; ?></td>
					</tr>
				<?

				$sub_total=$sub_total + $total_amt;
					 } ?>
				<tr style="border: 1px solid lightgrey; border-collapse: collapse;">
					<th colspan="2" style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Total:</th>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><b>Rs.</b><?php echo $sub_total; ?></td>
				</tr>

			</table>

			<div style="margin-top: 10px;width:100%;display: flex;border: 1px solid lightgrey;border-collapse: collapse;">
				<div style="width: 100%;border: 1px solid lightgrey;border-collapse: collapse;padding: 10px;">
					<h3 style="color: #ff700a;">Shipping address</h3>
					<?      			/*$this->db->select('*');
					$this->db->from('tbl_users');
					$this->db->where('id',$order1_id);
					$user= $this->db->get()->row();
					$user_id=$user->id;
					$user_mail=$user->email;*/

					      			$this->db->select('*');
					$this->db->from('tbl_order1');
					$this->db->where('id',$order1_id);
					$user_address= $this->db->get()->row();
					$add=$user_address->street_address;
					$zip=$user_address->post_code;
					$city=$user_address->city;

					$this->db->select('*');
					$this->db->from('all_states');
					$this->db->where('id',$user_address->state);
					$Statedata= $this->db->get()->row();
					$state=$Statedata->state_name;
					$mobile=$user_address->phone;
					$email=$user_address->email;

					?>
					<p><?php echo $name; ?></p>
					<p><?php echo $add; ?></p>
					<p<?php echo $city,$zip; ?></p>
					<p><?php echo $state; ?></p>
					<p><?php echo $mobile; ?></p>
					<p><?php echo $email; ?></p>
				</div>
			</div>

			<div style="margin-top: 10px;width:100%;">
				<p>Thank you for ordering with us, </p>
				<p>Team Create Spaces</p>
				<p>Stay Safe, Stay Fashionable</p>
				<p><b>For any support,</b> free to email us at <a href="#">connect@createspaces.com</a> or ring us on +919620986386</p>
			</div>
		</div>

	</div>

</body>
</html>
