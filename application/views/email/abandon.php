<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Important</title>
</head>
<body style="font-family: sans-serif;">

	<div style="width:100%">
		<div>
			<h3>Still interested?</h3>
			<p>Your cart has items left in it. Check 'em out now!</p>
		</div>
		<div>
			<table style="border: 1px solid lightgrey; border-collapse: collapse;width: 100%;text-align: left;">
				<tr style="border: 1px solid lightgrey; border-collapse: collapse;text-align: left;">
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Image</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Product</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Type</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Quantity</th>
					<th style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Price</th>
				</tr>
				<?
				$subtotal=0;
				$this->db->select('*');
$this->db->from('tbl_cart');
$this->db->where('user_id',$user_id);
$this->db->where('abandon',0);
$c_data= $this->db->get();
				foreach($c_data->result() as $data) {
					$total = 0;
				$this->db->select('*');
				$this->db->from('tbl_products');
				$this->db->where('id',$data->product_id);
				$pro_data= $this->db->get()->row();
				if(!empty($pro_data)){
					$pname = $pro_data->productname;
				}else{
					$pname = "";
				}
					$this->db->select('*');
					$this->db->from('tbl_type');
					$this->db->where('id',$data->type_id);
					$type_data= $this->db->get()->row();

					if(!empty($type_data)){
						if(!empty($type_data)){
							$tname = $type_data->name;
						}else{
							$tname = "";
						}

					}
					$total = $type_data->spgst * $data->quantity;
					// $subtotal = $subtotal  + $total;
			?>
				<tr style="border: 1px solid lightgrey; border-collapse: collapse;">
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><img src="<?=base_url().$pro_data->image?>" width="50%"/></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><?php echo $pname; ?></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><?php echo $tname; ?></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><?php echo $data->quantity; ?></td>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><b>Rs.</b><?php echo $total; ?></td>
					</tr>
				<?

					 } ?>
				<!-- <tr style="border: 1px solid lightgrey; border-collapse: collapse;">
					<th colspan="2" style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;">Total:</th>
					<td style="border: 1px solid lightgrey; border-collapse: collapse;padding: 10px;"><b>Rs.</b><?php echo $subtotal; ?></td>
				</tr> -->

			</table>
			<div style="margin-top: 10px;width:100%;">
				<p>
					Special coupon for you. Apply this promocode on checkout and get flat <?=$discount?>% discount on cart value.
				</p>
				<h3 style="text-align:center"><?=$promocode?></h3>
			</div>
			<div style="margin-top: 10px;width:100%;">
				<!-- <p>Thank you for ordering with us, </p> -->
				<p>Team Create Spaces</p>
				<!-- <p>Stay Safe, Stay Fashionable</p> -->
				<p><b>For any support,</b> feel free to email us at <a href="#">info@createspace.in</a> or ring us on +919620986386</p>
			</div>
		</div>

	</div>

</body>
</html>
