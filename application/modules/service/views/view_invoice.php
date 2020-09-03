<!DOCTYPE html>
<html>
<head>
    <title>Tax Invoice</title>
</head>
<style type="text/css">
@media print { 
    @page { 
        margin: 0 2px;
    } 
    body { 
        padding-top: 72px; 
        padding-bottom: 20px ; 
    } 
    .printdiv{page-break-after: always;}
}
*
{
    font-family: segoe ui, sans-serif;

}
body,html
{
    padding: 0px;
    margin: 0px;
}
table
{
    width: 100%;
    border-spacing: 0;
}
table th
{
    font-size: .9em;
}
th,td
{
    padding: 2px;
}
table.item_table tr td,
table.item_table tr th
{
    /*padding: 3px;*/
    border: 1px solid #7d8288;
}

.table th, .table td {
    /*padding: 0.75rem;*/
    vertical-align: top;
    /*border-top: 1px solid #dee2e6;*/
    /*border-right: 1px solid #dee2e6;*/
    text-align: left;
   padding: 3px 10px;
    /*font-size: 1em;*/
    border-collapse: collapse;
}
table td.noborder
{
    font-size: .9em;
}
.item_table tr td:not(:last-child),
.item_table tr th:not(:last-child)
{
    border-right:none;
    /*border-bottom:none;*/
}
.item_table tr td,
.item_table tr th
{
    border-bottom:none !important;
}
.item_table tr:last-child td
{
    border-bottom:1px solid #7d8288 !important;
}
.item_table tr:last-child td
{
    /*border-bottom: 1px solid #dee2e6;*/
}

.text-right
{
    text-align: right;
}
.terms-condition th, .terms-condition td
{
    /*text-align: left !important;*/
}
.app-content p,
.title
{
    padding:0 10px;
}

.table .tbl-row th,
.table .tbl-row td
{
    /*border: none;*/
    /*border-right: 1px solid black;*/
}
.br-bottom
{
    /*border-bottom: black solid 1px !important;*/
}
.br-top
{
    /*border-top: black solid 1px !important;*/
}
.br-right
{
    /*border-right: black solid 1px !important;*/
}
.noborder
{
    /*border: none !important;*/
}
.border
{
    /*border: 1px solid black !important;*/
}
.br-right-none
{
    /*border-right:  none !important;*/
}

.br-left-none
{
    /*border-left:  none !important;*/
}
.br-bottom-none
{
    /*border-bottom:  none !important;*/
}
.main_table th,
.main_table td
{
    text-align: center;
}
.item_table_containetr
{
    /*margin: 0 -12px;*/
}
.text-right
{
    text-align: right !important;
}
.information-div p
{
    /*margin-bottom: 0;*/
    /*margin-top: 2px;*/
    /*line-height: 10px;*/
    /*font-size: 14px;*/
}
b{
    /*font-weight: 800;*/
}

</style>
<body  style="background: lightgray;">
    <main class="app-content printdiv" style="background-color: white;border:#b4b8bb 0px solid;width: 1000px;margin: 0;margin:auto;position: relative;padding: 0;page-break-after:auto;">
        <!-- <br>   -->
        <div class="header_container" style="display: block;padding-top: 20px;width:994px;margin-left: 4px;">
            <center><h1>TAX INVOICE</h1></center>
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td rowspan="3" width="28%" >CIN: <b><?=$cin?></b><br>GST: <b><?=$gst?></b><br>PAN: <?=$pan?><br>MSME: <?=$msme?></td>
                    <td rowspan="3" width="48%"><img style="height: 75px;margin-left: 190px;" src="<?=base_url('assets/images/admin_logo.png')?>"></td>
                    <th style="text-align: left" rowspan="3" width="25%" >Original:   for Recipient<input type="checkbox" name=""><br>
                        Duplicate:  for Transporter<input type="checkbox" name=""><br>
                        Triplicate: for Issuer<input type="checkbox" name=""><br>
                        Extra:  for others<input type="checkbox" name="">
                    </th>
                </tr>
            </table>
        </div>
        <?php 
        if($uri=='invoice_print')
        {?>
        <p style="position: absolute;right: 0px;top: -7px;">
            <input type ="button" value = "Print" id="printbtn"/>
        </p>
        <?php } ?>
        <!-- <center><h3>Title</h3></center> -->
        <!--<div style="border-bottom: #80c9ec solid 2px; width: 99%;margin: auto;">&nbsp;</div>-->
        <div style="padding-top: 10px;width:994px;margin-left:2px;display:block;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td width="15.5%" style="background: transparent;">Invoice No.:</td>
                    <th width="12.5%" style="text-align: left;"><?php echo $invoice_detail->invoice_sequence; ?></th>
                    <td rowspan="6" width="48%">
                        <center>
                            <b style="font-size: 19px"><?=$title?></b>
                            <br>
                            <b  style="font-size: 18px">Plot No.20. Sec -3, IMT Manesar, Gurgaon,<br>Haryana-122050, India<br>Phone: +91-124-4206019, 4317133,</b>
                            <br>Email- <?=$email?>  Web-<?=$website?></center>
                        <!-- </b> -->
                    </td>
                    <td width="10%">PO No.:</td>
                    <th style="text-align: left;" width="20%"><?php echo $invoice_detail->wo_no; ?></th>
                </tr>
                <tr>
                    <td>Invoice Dated:</td>
                    <th style="text-align: left;"><?php echo isset($invoice_detail->invoice_date_time) && strtotime($invoice_detail->invoice_date_time)?date('d/m/Y',strtotime($invoice_detail->invoice_date_time)):'--/--/----' ?></th>
                    <td>WO Dated:</td>
                    <th style="text-align: left;"><?php echo isset($invoice_detail->wo_date) && strtotime($invoice_detail->wo_date)?date('d/m/Y',strtotime($invoice_detail->wo_date)):'--/--/----' ?></th>
                </tr>
                <tr>
                    <td>Delivery Challan:</td>
                    <th style="text-align: left;"><?php echo $invoice_detail->del_challan; ?></th>
                    <td>PR No.:</td>
                    <th style="text-align: left;"><?=$invoice_detail->pr_no?></th>
                </tr>
                <tr>
                    <td>Removal Dated:</td>
                    <th style="text-align: left;"><?php echo isset($invoice_detail->dispatch_date) && strtotime($invoice_detail->dispatch_date)?date('d/m/Y',strtotime($invoice_detail->dispatch_date)):'--/--/----' ?></th>
                    <td>Vendor ID:</td>
                    <th style="text-align: left;"><?=$invoice_detail->vendor_code?></th>
                </tr>
                <tr>
                    <td>Removal Time:</td>
                    <th style="text-align: left;"><?php echo isset($invoice_detail->dispatch_date) && strtotime($invoice_detail->dispatch_date)?date('h:i A',strtotime($invoice_detail->dispatch_date)):'00:00:00' ?></th>
                    <td>Our Ref.:</td>
                    <th style="text-align: left;"><?=$invoice_detail->inquiry_no?></th>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;display:block;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <th colspan="2" style="text-align: left;">Bill to (Buyer Detail)</th>
                    <th colspan="2" style="text-align: left;" >Ship to (Consignee)</th>
                </tr>
                <tr>
                    <td colspan="2"><?=$invoice_detail->company_name?><br><?=$invoice_detail->bill_to_address?></td>
                    <td colspan="2"><?=$invoice_detail->supplier_name?><br><?=$invoice_detail->ship_to_address?>
                    </td>
                </tr>
                <tr>
                    <td>City/State:</td>
                    <td style="text-align: left;"><?=$invoice_detail->city_name.'-'.$invoice_detail->city_code?>, <?=$invoice_detail->state_name?></td>
                    <td>City/State:</td>
                    <td style="text-align: left;"><?=$invoice_detail->second_city_name.'-'.$invoice_detail->second_city_code?>, <?=$invoice_detail->second_state_name?></td>
                </tr>
                <tr>
                    <td>GST</td>
                    <th style="text-align: left;"><?=$invoice_detail->first_gst?></th>
                    <td>GST</td>
                    <th style="text-align: left;"><?=$invoice_detail->second_gst?></th>
                </tr>
                <tr>
                    <?php
                    $salutation = "";
                    $consignee_salutation = "";
                    $second_salutation = "";
                    $second_consignee_salutation = "";
                    $salutation_array  = ['1'=>"Mr. ",'2'=>'Mrs. ','3'=>'Ms. '];
                    ?>
                    <td colspan="2"><?=$salutation_array[$invoice_detail->salutation]?><?=$invoice_detail->client_contact?>, <?=$invoice_detail->first_phone_no?>, <?=$invoice_detail->first_email_id?>
                        <br>
                        <?=$salutation_array[$invoice_detail->second_salutation]?><?=isset($invoice_detail->second_client_contact)&&!empty($invoice_detail->second_client_contact)?$invoice_detail->second_client_contact.',':''?>
                        <?=isset($invoice_detail->second_phone_no)&& !empty($invoice_detail->second_phone_no)?$invoice_detail->second_phone_no.',':''?>
                         <?=$invoice_detail->second_email_id?>
                    </td>
                    <td colspan="2">
                        <?=$salutation_array[$invoice_detail->consignee_salutation]?>
                        <?=isset($invoice_detail->consignee_contact)&& !empty($invoice_detail->consignee_contact)?$invoice_detail->consignee_contact.',':''?>
                        <?=isset($invoice_detail->consignee_phone) && !empty($invoice_detail->consignee_phone)?$invoice_detail->consignee_phone.',':''?>
                        <?=$invoice_detail->consignee_email?>
                        <br>
                        <?=$salutation_array[$invoice_detail->second_consignee_salutation]?>
                        <?=isset($invoice_detail->second_consignee_contact)&& !empty($invoice_detail->second_consignee_contact)?$invoice_detail->second_consignee_contact.',':''?>
                        <?=isset($invoice_detail->second_consignee_phone) && !empty($invoice_detail->second_consignee_phone)?$invoice_detail->second_consignee_phone.',':''?>
                        <?=$invoice_detail->second_consignee_email?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;display:block;">
            <table class="responsive table table-bordered" border="1%" width="100%">
                <tbody>
                    <tr>
                        <th width="5px" rowspan="2">Sr No.</th>
                        <th width="300px" rowspan="2">DESCRIPTION</th>
                        <th width="80px" rowspan="2">Analysis Cost</th>
                        <th width="80px" rowspan="2">Refurbishment Cost</th>
                        <th width="85px" rowspan="2">total</th>
                        <th width="170px" colspan="4"><center>GST</center></th>
                    </tr>
                    <tr>
                        <th width="15px" class="text-center">%</th>
                        <th width="70px"><small>CGST</small></th>
                        <th width="70px"><small>SGST</small></th>
                        <th width="50px"><small>IGST</small></th>
                    </tr>
                    <?php 
                    if(isset($job_details) && !empty($job_details))
                    {
                    $i=1;
                    $total_qty = 0;
                    $total = 0;
                    $state_gst = 0;
                    $igst = 0;
                    foreach ($job_details as $key => $val)
                    { 
                        $total += $val->order_analysis_amount+$val->order_repair_amount;
                        $total_job_amount_tax = ($val->order_analysis_amount+$val->order_repair_amount*0.18);
                        if($invoice_detail->bill_to_state == 1)
                        {
                            $value =  number_format($total_job_amount_tax/2,'2','.',','); 
                        }
                        else
                        { 
                            $value = "0"; 
                        }
                        $state_gst += $value;
                        $igst += $total_job_amount_tax;
                        ?>
                        <tr>
                            <td style="word-break: break-all;"><?php echo $i++; ?></td>
                            <td style="word-break: break-all;text-align: left">
                                <small><?php echo $val->job_card; ?>
                                <br><?php echo $val->card_name; ?>
                                <br><?php echo $val->card_make; ?>
                                <br><?php echo $val->card_model; ?>
                                <br><?php echo $val->sr_no; ?>
                                </small>
                            </td>
                            
                            <td style="word-break: break-all;" class="text-right">
                                <small>
                                    <?php echo number_format($val->order_analysis_amount,'2','.',','); ?>
                                </small>
                            </td>
                            <td style="word-break: break-all;" class="text-right">
                                <small>
                                    <?php echo number_format($val->order_repair_amount,'2','.',','); ?>
                                </small>
                            </td>
                            <td style="word-break: break-all;" class="text-right">
                                <small>
                                    <?php echo number_format($val->order_analysis_amount+$val->order_repair_amount,'2','.',','); ?>
                                </small>
                            </td>
                            <td style="word-break: break-all;" class="text-right">
                                <small>
                                   18
                                </small>
                            </td>
                            <td  style="word-break: break-all;" class="text-right">
                                <small>
                                    <?php echo number_format($value,'2','.',','); ?>
                                </small>
                            </td>
                            <td  style="word-break: break-all;" class="text-right">
                                <small>
                                    <?php echo number_format($value,'2','.',','); ?>
                                </small>
                            </td>
                            <td style="word-break: break-all;" class="text-right">
                                <small>
                                    <?=$invoice_detail->bill_to_state != 1?number_format($total_job_amount_tax,'2','.',','):0?>
                                </small>
                            </td>
                        </tr>
                    <?php }} ?>
                    <tr>
                        <th colspan="4">Total</th>
                        <th><?=number_format($total,'2','.',',')?></th>
                        <th colspan="2" class="text-right"><?=number_format($state_gst,'2','.',',')?></th>
                        <th class="text-right"><?=number_format($state_gst,'2','.',',')?></th>
                        <th class="text-right"><?=$invoice_detail->bill_to_state != 1?number_format($igst,'2','.',','):0?></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;display:block;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <th width="12.5%" style="background: transparent;text-align: left;">Mode of:</th>
                    <td width="25.5%" style="text-align: left;"><?=$invoice_detail->mode_of?></td>
                    <td rowspan="5" width="45%" style="text-align: left;vertical-align: top;">
                        <p style="margin: 0;padding: 0">
                        <b>Payment Terms:</b>
                        <br>
                        <?=isset($invoice_detail->payment_terms) && !empty($invoice_detail->payment_terms)?$invoice_detail->payment_terms:''?></p>  </td>
                    <th style="text-align: left;" width="15%">Taxable Value</th>
                    <td width="12%" class="text-right"><?=number_format($total,'2','.',',')?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Transporter:</th>
                    <td><?=$invoice_detail->transporter?></td>
                    <th style="text-align: left;">CGST</th>
                    <td class="text-right"><?=number_format($state_gst,'2','.',',')?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">GR/LR No.:</th>
                    <td><?=$invoice_detail->lr_no?></td>
                    <th style="text-align: left;">SGST</th>
                    <td class="text-right"><?=number_format($state_gst,'2','.',',')?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">E way bill No.:</th>
                    <td><?=$invoice_detail->eway_bill_no?></td>
                    <th style="text-align: left;">IGST</th>
                    <td class="text-right"><?=$invoice_detail->bill_to_state != 1?number_format($igst,'2','.',','):0?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Insurance:</th>
                    <td><?=$invoice_detail->total_invoice_value?></td>
                    <th style="text-align: left;">Invoice Value</th>
                    <td class="text-right"><?=$invoice_detail->total_invoice_value?></td>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;display:block;">
            <table border="1" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td rowspan="3" width="25%" ><b>Bank Details</b><br>
                    Name‐ <?=$title?>,<br> 
                    Bank A/C No. <?=$account_no?><br> 
                    Bank Name‐ State Bank of India,<br> 
                    Bank Branch- IMT Manesar<br>
                    IFSC Code‐SBIN0016371,<br> 
                    Type of Account- Current
                    </td>
                    <td rowspan="3" width="45%"><b>Others Terms</b><br>
                    <small>a) Interest will be charged @24% in case the payment is not made as per WO.</small><br>
                    <small>b) Any claim regarding this bill will not be entertained after 7 days.</small><br> 
                    <small>c) Goods once sold will not be taken back.</small><br>
                    <small>d) Subject to Gurgaon Jurisdiction only.</small><br> 
                    <small>e) Damage/Short supply shall intimated with in 72 Hrs of delivery at gate. No claim will be consider after this period.</small>
                    </td>
                    <td style="text-align: left" rowspan="3" width="19%" ><b>for <?=$title?> ,<br><br><br><br><br><br>Authorized Signatory</b></td>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;"></div>
    </main>
    
</body>
</html>
<script type="text/javascript">
    var printbtn = document.getElementById("printbtn");
    printbtn.onclick = function(){
        window.print();
    };

    window.onbeforeprint = function() {
        printbtn.style.display = "none";
    }
</script>