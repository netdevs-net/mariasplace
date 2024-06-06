<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
defined('ABSPATH') || exit;
?>
<!-- 
<div class="woocommerce-order">

    <?php
    //if ($order) :
    //    $order_id = $order->get_id();
        ?>
        <h2 class="section-main-title text-center mt-3">Order Confirmation</h2>
        <?php //echo do_shortcode('[order_completed id="' . $order_id . '"]'); ?>
        <?php //echo do_shortcode('[order_details id="' . $order_id . '"]'); ?>
    <?php //else : ?>
        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped   ?></p>
    <?php //endif; ?>
</div> -->

<?php
    if ($order) :
    $order_id = $order->get_id();
    //$order_id = $atts['id'];
    $order = new WC_Order($order_id);
    $order_data = $order->get_data();
    $order_key = $order_data['order_key'];
    $customer_id = $order_data['customer_id'];
    $billing_details = $order_data['billing'];
    $shipping_details = $order_data['shipping'];
    $payment_method = $order_data['payment_method'];
    $transaction_id = $order_data['transaction_id'];
    $currency = $order_data['currency'];
    $total = $order_data['total'];
    $total_tax = $order_data['total_tax'];
?>
<article id="post-" class="post-14498 page type-page status-publish hentry">
    
    <div class="entry-content">
        <section class="wpb-content-wrapper"><div data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid thy-top-img vc_custom_1668880822732 vc_row-has-fill vc_row-no-padding" style="position: relative; left: -114px; box-sizing: border-box; width: 1434px; max-width: 1434px;"><div class="thy-btm-img wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill"><div class="vc_column-inner vc_custom_1668880848435"><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  vc_custom_1668880469993 thy-mid-img">
		<div class="wpb_wrapper">
<?php
$downloadable = 0;
foreach ($order->get_items() as $item){
    $product = $item->get_product();
    if($product->downloadable == "yes"){
        $downloadable = 1;
    }
}
?>
<?php if($downloadable == 1){?>
    <h3 style="text-align: center;">Click here to</h3>
<h1 style="text-align: center;"><a href="/my-account/downloads/" style="color: #322876;">Download!</a></h1>
<?php }else{ ?>
    <h3 style="text-align: center;">Welcome to</h3>
    <h1 style="text-align: center; color: #322876;">Maria’s Place!</h1>
<?php } ?>

<h2 style="text-align: center; color: #df005d;">Thank You!</h2>
<h4 style="text-align: center; color: #322876;">Your order has been received.</h4>
<p style="text-align: center;">Thank you for signing up on our new site!<br>
We hope you enjoy the new and improved features.</p>
<p style="text-align: center;">Below are details about your membership account.<br>
A welcome email has been sent to <?php echo $billing_details['email'];?></p>
<div class="container">
<h2 class="font-36 text-center">Order Details</h2>
<?php
echo '<table class="table table-thankyou" style="max-width:500px;margin:auto;">
<tbody> 
 <tr>
  <th scope="col">Order Number</th>
      <td>' . $order->get_id() . '</td>
  </tr>
  <tr>
    <th scope="row">Order Date</th>
  <td>' . $order->get_date_created()->date("F j, Y") . '</td>
  </tr>
  <tr>
  <th scope="row">Total Order</th>
    <td>' . woocommerce_price($order->get_total()) . '</td>
  </tr>
  <tr class="d-none">
    <th scope="row">Payment Method</th>
    <td>' . $payment_method . '</td>
  </tr>
  <tr>
    <th scope="row">Name</th>
    <td><div class="customer-name">' . $billing_details['first_name'] . ' ' . $billing_details['last_name'] . '</div></td>
  </tr>
  <tr>
    <th scope="row">Email</th>
    <td><div class="customer-name">' . $billing_details['email'] . '</div>'
          . '<div class="customer-company d-none">' . $shipping_details['company'] . '</div>'
          . '<div class="customer-address d-none">' . $shipping_details['address_1'] . '</div>'
          . '<div class="customer-address d-none">' . $shipping_details['address_2'] . '</div>'
          . '<div class="customer-address d-none">' . $shipping_details['city'] . ' ' . $shipping_details['state'] . ' ' . $shipping_details['country'] . ' ' . $shipping_details['postcode'] . '</div>'
          . '</td>
  </tr> 
</tbody>
</table>';
?>
</div>
		</div>
	</div>
</div></div></div></div><div class="vc_row-full-width vc_clearfix"></div>
</section>    </div><!-- .entry-content -->

    </article>

<style>
.table-thankyou{
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
}
.vc_custom_1668880822732 {
    background-image: url(/wp-content/themes/MariasPlace/inc/assets/images/thank-you-1.svg) !important;
}    
.vc_custom_1668880848435 {
    background-image: url(/wp-content/themes/MariasPlace/inc/assets/images/thank-you-2.svg) !important;
}
.vc_custom_1668880469993 {
    background-image: url(/wp-content/uploads/2022/11/Vector.png?id=42466) !important;
    background-size:100%;
}
.wpb_text_column.wpb_content_element{
    margin-bottom:0px;
}
.checkout-background{
padding-bottom:0px;
}
#content.site-content{
    padding:0px;
}
.thy-top-img{
background-position: top !important;
background-repeat:repeat-x;
}
.thy-mid-img{
background-position: center !important;
background-size: contain !important;
background-repeat:no-repeat;
padding-top:100px;
padding-bottom:100px;
margin-top:3rem;
margin-bottom:100px !important;
}
.vc_custom_1670683998620{
    background:transparent !important;
}
.vc_column-inner{
    padding-top:0px !important;
}
.thy-btm-img>div{
background-position: bottom !important;
background-repeat:repeat-x;
}
    </style>
    <?php else : ?>
        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped   ?></p>
    <?php endif; ?>