<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/onewoorks.css">

        <style>
           * {
               margin:0px;
               padding:5px;
           }
           body {
               color: #000 !important;
           }
           table {
               width:100%;
           }
           #header table {
               width:100%;
               padding: 0px;
           }
           #header table td, .amount-summary td {
               vertical-align: text-top;
               padding: 5px;
           }
           #company-name{
               color:#000;
               font-size: 18px;
           }
           #invoice-to td {
               text-align: left
           }
           #invoice-to {
               margin-bottom: 15px;
           }
           #invoice-to-right-table td {
               padding-right: 5px;
               padding-left: 5px;
               text-align: right;
           }
           .seperator {
               height: 25px
           }
           .top-border {
               border-top: none;
           }
           .no-bottom-border {
               border:none !important;
               background-color: white !important;
           }
        </style>

	</head>
        <body>
            <div id="header">
                <table>
                    <tr>
                        <td colspan="2"><img src="https://invoice.onewoorks-solutions.com/uploads/onewoorks120.jpg" /></td>
                        <td colspan="2" class="text-right" style="vertical-align: bottom;">
                            Your partner for web solutions! <br />
                            +6019.669.3481 | sales@onewoorks.com |  www.onewoorks.com
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background-color: #B7CEEC; color:#fff;">
                            Invoice
                        </td>
                    </tr>
                    <tr>
                        <td style="width:10%">
                            Issued to :
                            <div class="hidden">
                                <div class='font-size-11em'><?php echo lang('amount_due'); ?> : </div>
                                <div class='font-size-14em'><?php echo format_currency($invoice->invoice_balance); ?></div>
                            </div>
                        </td>
                        <td style="width: 40%;">
                            <h3><?php echo $invoice->client_name; ?></h3>
                            <?php
                            if ($invoice->client_address_1) {
                                echo $invoice->client_address_1 . '<br>';
                            }

                            if ($invoice->client_address_2) {
                                echo $invoice->client_address_2 . ', ';
                            }

                            if ($invoice->client_city) {
                                echo $invoice->client_city . ', <br /> ';
                            }

                            if ($invoice->client_zip) {
                                echo $invoice->client_zip . ' ';
                            }

                            if ($invoice->client_state) {
                                echo $invoice->client_state . '<br /> ';
                            }

                            if ($invoice->client_country):
                                echo $invoice->client_country . '<br />';
                            endif;

                            if ($invoice->client_phone) {
                                echo "<span class='icon-phone'>" . $invoice->client_phone . "</span>";
                            }
                            ?>
                        </td>
                        <td style="width: 10%;">From :</td>
                        <td>
                            <h3><?php echo $invoice->user_name; ?></h3>
                            <?php
                            if ($invoice->user_address_1) {
                                echo $invoice->user_address_1 . ',<br /> ';
                            }
                            ?>
                            <?php
                            if ($invoice->user_address_2) {
                                echo $invoice->user_address_2 . ', <br />';
                            }
                            ?>
                            <?php
                            if ($invoice->user_city) {
                                echo $invoice->user_city . ', <br />';
                            }
                            ?>
                            <?php
                            if ($invoice->user_zip) {
                                echo $invoice->user_zip . ' ';
                            }
                            ?>
                            <?php
                            if ($invoice->user_state) {
                                echo $invoice->user_state . ', ';
                            }

                            if ($invoice->user_country):
                                echo $invoice->user_country;
                            endif;
                            ?>

                            <?php if ($invoice->user_phone) { ?><abbr>P:</abbr><?php echo $invoice->user_phone; ?><br><?php } ?>
                            <?php if ($invoice->user_fax) { ?><abbr>F:</abbr><?php echo $invoice->user_fax; ?><?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="invoice-line">&nbsp;</td>
                    </tr>
                </table>
                <table style="table-layout: fixed;">
                    <tr >
                        <td style="width: 25%;" class="invoice-line"><span class='icon-terminal'> </span> <b>Project Code :</b> </td>
                        <td style="width: 25%;" class="invoice-line"><span class='icon-tag'> </span> <b><?php echo lang('invoice'); ?> :</b> <?php echo $invoice->invoice_number; ?> </td>
                        <td style="width: 25%;" class="invoice-line"><span class='icon-calendar'> </span><b><?php echo lang('invoice_date'); ?> :</b> <?php echo date_from_mysql($invoice->invoice_date_created); ?></td>
                        <td style="width: 25%;" class="invoice-line"><span class='icon-calendar'> </span><b><?php echo lang('due_date'); ?> :</b><?php echo date_from_mysql($invoice->invoice_date_due); ?></td>
                    </tr>
                </table>
            </div>

          
            <div id="invoice-items">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo lang('qty'); ?></th>
                            <th><?php echo lang('item'); ?></th>
                            <th><?php echo lang('description'); ?></th>
                            <th><?php echo lang('price'); ?></th>
                            <th><?php echo lang('total'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = 0;
                        foreach ($items as $item) :
                            ?>
                            <tr>
                                <td><?php echo format_amount($item->item_quantity); ?></td>
                                <td><?php echo $item->item_name; ?></td>
                                <td><?php echo nl2br($item->item_description); ?></td>
                                <td><?php echo format_currency($item->item_price); ?></td>
                                <td><?php echo format_currency($item->item_subtotal); ?></td>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach ?>

                        <?php while ($row < 10): $row++; ?>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3"></td>
                            <td><?php echo lang('subtotal'); ?>:</td>
                            <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_subtotal); ?></td>
                        </tr>
                        <?php if ($invoice->invoice_item_tax_total > 0) { ?>
                            <tr>
                                <td class="no-bottom-border" colspan="3"></td>
                                <td><?php echo lang('item_tax'); ?></td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_tax_total); ?></td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
                            <tr>
                                <td class="no-bottom-border" colspan="3"></td>
                                <td><?php echo $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice_tax_rate->invoice_tax_rate_amount); ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td><?php echo lang('total'); ?>:</td>
                            <td style="text-align: right;"><?php echo format_currency($invoice->invoice_total); ?></td>
                        </tr>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td><?php echo lang('paid'); ?></td>
                            <td style="text-align: right;"><?php echo format_currency($invoice->invoice_paid) ?></td>
                        </tr>
                        <?php if(strpos($invoice->invoice_number, '.') !== FALSE):?>
                        <?php $getPercent =explode('.',$invoice->invoice_number);?>

                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td>Amount To Be Paid</td>
                            <td style="text-align: right;"><strong><?php echo format_currency($invoice->invoice_total*($getPercent[1]/100)); ?></strong></td>
                        </tr>
                        <?php endif;?>
                        <tr>
                            <td class="no-bottom-border" colspan="3"></td>
                            <td><?php echo lang('balance'); ?></td>
                            <td class="text-right" style="text-align: right;"><strong><?php echo format_currency($invoice->invoice_balance) ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <table>
                    <tr>
                        <td colspan="3">
                            <?php if ($invoice->invoice_terms) { ?>
                                <h4><?php echo lang('terms'); ?></h4>
                                <p><?php echo nl2br($invoice->invoice_terms); ?></p>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> For customer service, billing, technical enquiries and payment please email us at hello@onewoorks.com</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="invoice-line">Please make a payment to : Maybank 163055019303 (Irwan Ibrahim)</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <div class="seperator"></div>

            </div>
        </body>
</html>