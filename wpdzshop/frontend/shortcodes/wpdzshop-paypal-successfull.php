<?php//Check if there is a PAYPAL Page, and get the ID of the Page// $whereismypaypalpage = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content = '[wpdzshop_paypal_notify_successfull]' AND post_status='publish'");// $message="";// if ($whereismypaypalpage == null) {	// $message="Vous n'avez pas encore de page de validation pour paypal. Vous pouvez en ajouter en cr�ant une page avec le contenu [wpdzshop_paypal_notify_successfull]";	?>	<!--<span class="message"><?php echo $message; ?></span>-->	<?php$result = whereIsPaypal();if ($result==true) {	$mycart = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user =".$current_user->ID);	$i=0;	$itemname=array();	$itemnumber=array();	$amount=array();	$shipping=array();	$shipping2=array();	$quantity=array();	if ($mycart != null) {		$number=count($mycart);		foreach ($mycart as $product){			++$i;			$item_name="item_name".$i;			$item_number="item_number".$i;			$_amount="amount_".$i;			$_shipping="shipping_".$i;			$_shipping2="shipping2_".$i;			$_quantity="quantity_".$i;			$_quantity="total_product".$i;						$itemname[] = $_POST["$item_name"];			$itemnumber[] = $_POST["$item_number"];			$amount[] = $_POST["$_amount"];			$shipping[] = $_POST["$_shipping"];			$shipping2[] = $_POST["$_shipping2"];			$quantity[] = $_POST["$_quantity"];		}				$amount = $_POST["mc_gross"];		$no_shipping = $_POST["no_shipping"];		$no_note = $_POST["no_note"];		$currency_code = $_POST["currency_code"];		//GET Next purchase ID		$query = mysql_query("SELECT MAX(id_purchase) as max_id_purchase from epay_wpdzshop_purchase");		$row = mysql_fetch_array($query);		$next_id = $row[0];		if ($next_id==null) $next_id=0;		++$next_id;		$mypostid = $product->id_product;		$mypost = get_post($mypostid);		$custom = get_post_custom($mypostid);		$title = $mypost->post_title;		if ($number > 1) $subject="Pack de produits ".get_bloginfo('name'); else $subject = $title;						$amount = $_POST['payment_gross'];		$currency = $_POST['mc_currency'];		$payer_email = $_POST['payer_email'];		$orderid = $next_id;		$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_purchase (id_purchase, subject, amount, currency, id_user, payer_email, date_purchase, payment_method, state_purchase)					VALUES(".$orderid.", '".$subject."', '".$amount."', '".$currency."', ".$current_user->ID.", '".$payer_email."', now(), 'paypal', 'Validated')");		$mycart = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user =".$current_user->ID);			foreach ($mycart as $product){						$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_product_purchase (id_purchase, id_product, quantity)					VALUES(".$orderid.", ".$product->id_product.", ".$product->quantite.")");			}		$delete = $wpdb->query("DELETE FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user = ".$current_user->ID);		$mycart = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user =".$current_user->ID);		$mypostid = $mycart->id_product;		$mypost = get_post($mypostid);		$custom = get_post_custom($mypostid);		$title = $mypost->post_title;		if ($number > 1) $subject="Pack de produits ".get_bloginfo('name'); else $subject = $title;		?>		<h2>Paypal Order</h2>		<br/>		You have order <strong>"<?php echo $subject;?>"</strong> using your Paypal account		<br/><br/>		Any Problem contact us:<br/>		<?php echo get_option('shop_email'); ?>		<br/>		<?php echo get_option('shop_tel'); 	}} else {	?>	<span class="message"><?php echo $result; ?></span>	<?php}?>