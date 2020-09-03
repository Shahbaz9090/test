<!DOCTYPE html>
<html>
<head>
    <title>Packing List</title>
</head>
<style type="text/css">
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
    margin-bottom: 0;
    margin-top: 2px;
    /*line-height: 10px;*/
    font-size: 14px;
}
@media print { 
    @page { 
        margin-top: 0; 
        margin-bottom: 0; 
    } 
    body { 
        padding-top: 72px; 
        padding-bottom: 72px ; 
    } 
    
}

</style>
<body style="background: <?php $uri = $this->uri->segment('3'); echo $uri=='invoice_print'?'black':''; ?>">
    <main class="app-content printdiv" style="background-color: white;border:#b4b8bb 0px solid;width: 1000px;margin: 0;margin:auto;position: relative;padding: 0;page-break-after:auto;">
        <!-- <br>   -->
        <div class="header_container" style="display: block;padding-top: 20px;width:994px;margin-left: 4px;">
            <center><h1>DELIVERY CHALLAN/PACKING LIST</h1></center>
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td rowspan="3" width="28%" >CIN: <b style="font-weight: 800;">U29307HR2017PTC070634</b></br>GST: <b style="font-weight: 800;">06AAECI6178C1ZN</b></br>PAN: AAECI6178C</br>MSME: HR05A0008820</td>
                    <td rowspan="3" width="48%"><img style="height: 75px;margin-left: 190px;" src="<?=base_url('assets/images/admin_logo.png')?>"></td>
                    <th style="text-align: left" rowspan="3" width="25%" >Original:   for Recipient<input type="checkbox" name=""></br>
                        Duplicate:  for Transporter<input type="checkbox" name=""></br>
                        Triplicate: for Issuer<input type="checkbox" name=""></br>
                        Extra:  for others<input type="checkbox" name="">
                    </th>
                </tr>
            </table>
        </div>
        <?php 
        if($uri=='packing_invoice_print')
        {?>
        <p style="position: absolute;right: 0px;top: -7px;">
            <input type ="button" value = "Print" id="printbtn"/>
        </p>
        <?php } ?>
        <!-- <center><h3>Title</h3></center> -->
        <!--<div style="border-bottom: #80c9ec solid 2px; width: 99%;margin: auto;">&nbsp;</div>-->
        <div style="padding-top: 10px;width:994px;margin-left:2px;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td width="15.5%" style="background: transparent;">Invoice No.:</td>
                    <th width="12.5%" style="text-align: left;"><?php echo $challan_details->invoice_no; ?></th>
                    <td rowspan="6" width="48%"><b style="font-size: 22px;"><center>Inch Digital Technologies Pvt Ltd.</b></br><b style="font-weight: 800;">Plot No.20. Sec -3, IMT Manesar, Gurgaon,</br>Haryana-122050, India</br>Phone: +91-124-4206019, 4317133,</b></br>Email- sales.technologies@inchgroup.co.in  Web-www.inchgroup.co.in</center></td>
                    <td width="10%">WO No.:</td>
                    <th style="text-align: left;" width="20%"><?php echo $challan_details->po_no; ?></th>
                </tr>
                <tr>
                    <td>Invoice Dated:</td>
                    <th style="text-align: left;"><?php echo isset($challan_details->invoice_date_time) && strtotime($challan_details->invoice_date_time)?date('d/m/Y',strtotime($challan_details->invoice_date_time)):'--/--/----' ?></th>
                    <td>WO Dated:</td>
                    <th style="text-align: left;"><?php echo isset($challan_details->po_date) && strtotime($challan_details->po_date)?date('d/m/Y',strtotime($challan_details->po_date)):'--/--/----' ?></th>
                </tr>
                <tr>
                    <td>Delivery Challan:</td>
                    <th style="text-align: left;"><?php echo $challan_details->awb_no; ?></th>
                    <td>PR No.:</td>
                    <th style="text-align: left;"><?=$challan_details->pr_no?></th>
                </tr>
                <tr>
                    <td>Removal Dated:</td>
                    <th style="text-align: left;"><?php echo isset($challan_details->dispatch_date) && strtotime($challan_details->dispatch_date)?date('d/m/Y',strtotime($challan_details->dispatch_date)):'--/--/----' ?></th>
                    <td>Vendor ID:</td>
                    <th style="text-align: left;"><?=$challan_details->vendor_code?></th>
                </tr>
                <tr>
                    <td>Removal Time:</td>
                    <th style="text-align: left;"><?php echo isset($challan_details->dispatch_date) && strtotime($challan_details->dispatch_date)?date('h:i A',strtotime($challan_details->dispatch_date)):'00:00:00' ?></th>
                    <td>Our Ref.:</td>
                    <th style="text-align: left;"><?=$challan_details->enq_no?></th>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <th colspan="2" style="text-align: left;">Bill to (Buyer Detail)</th>
                    <th colspan="2" style="text-align: left;" >Ship to (Consignee)</th>
                </tr>
                <tr>
                    <td colspan="2"><?=$challan_details->company_name?><br><?=$challan_details->bill_to_address?></td>
                    <td colspan="2"><?=$challan_details->supplier_name?><br><?=$challan_details->ship_to_address?>
                    </td>
                </tr>
                <tr>
                    <td>City/State:</td>
                    <td style="text-align: left;"><?=$challan_details->city_name.'-'.$challan_details->city_code?>, <?=$challan_details->state_name?></td>
                    <td>City/State:</td>
                    <td style="text-align: left;"><?=$challan_details->second_city_name.'-'.$challan_details->second_city_code?>, <?=$challan_details->second_state_name?></td>
                </tr>
                <tr>
                    <td>GST</td>
                    <th style="text-align: left;"><?=$challan_details->first_gst?></th>
                    <td>GST</td>
                    <th style="text-align: left;"><?=$challan_details->second_gst?></th>
                </tr>
                <tr>
                    <?php
                    $salutation = "";
                    $second_salutation = "";
                    $consignee_salutation = "";
                    if(isset($challan_details->salutation) && !empty($challan_details->salutation))
                    {
                        if($challan_details->salutation == '1')
                        {
                            $salutation = "Mr. ";
                        }
                        elseif($challan_details->salutation == '2')
                        {
                            $salutation = "Mrs. ";
                        }
                        elseif($challan_details->salutation == '3')
                        {
                            $salutation = "Ms. ";
                        }
                    }
                    if(isset($challan_details->second_salutation) && !empty($challan_details->second_salutation))
                    {
                        if($challan_details->second_salutation == '1')
                        {
                            $second_salutation = "Mr. ";
                        }
                        elseif($challan_details->second_salutation == '2')
                        {
                            $second_salutation = "Mrs. ";
                        }
                        elseif($challan_details->second_salutation == '3')
                        {
                            $second_salutation = "Ms. ";
                        }
                    }

                    if(isset($challan_details->consignee_salutation) && !empty($challan_details->consignee_salutation))
                    {
                        if($challan_details->consignee_salutation == '1')
                        {
                            $consignee_salutation = "Mr. ";
                        }
                        elseif($challan_details->consignee_salutation == '2')
                        {
                            $consignee_salutation = "Mrs. ";
                        }
                        elseif($challan_details->consignee_salutation == '3')
                        {
                            $consignee_salutation = "Ms. ";
                        }
                    }
                    ?>
                    <td colspan="2"><?=$salutation?><?=$challan_details->client_contact?>, <?=$challan_details->first_phone_no?>, <?=$challan_details->first_email_id?>
                    </br>
                    <?=$second_salutation.' '.$challan_details->second_client_contact?>, <?=$challan_details->second_phone_no?>, <?=$challan_details->second_email_id?></td>
                    <td colspan="2"><?=$consignee_salutation?><?=$challan_details->consignee_contact?>, <?=$challan_details->consignee_phone?>, <?=$challan_details->consignee_email?></br><?=$challan_details->second_consignee_contact?>, <?=$challan_details->second_consignee_phone?>, <?=$challan_details->second_consignee_email?></td>
                </tr>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;">
            <table class="responsive table table-bordered" border="1%" width="100%">
                <tbody>
                    <tr style="font-size: 20px;">
                        <th rowspan="2" width="1%">No.</th>
                        <th rowspan="2" width="34%">DESCRIPTION</th>
                        <th rowspan="2" width="6%">QTY.</th>
                        <th width="9%">NW</th>
                        <th width="9%">GW</th>
                        <th width="8%">L</th>
                        <th width="8%">W</th>
                        <th width="8%">H</th>
                        <th width="8%">Vol</th>
                    </tr>
                    <tr>
                        <th>kg</th>
                        <th>kg</th>
                        <th>cm</th>
                        <th>cm</th>
                        <th>cm</th>
                        <th>cbm</th>
                    </tr>
                    <?php  //pr($challan_details);die;
                    if(isset($challan_details) && !empty($challan_details))
                    {
                    $i=1;
                    $total_qty = 0;
                    $gw = 0;
                    $vol = 0;
                    $boxes = 1;
                    // $state_gst = 0;
                    // $igst = 0;
                    foreach ($challan_details as $key => $val) { 
                            $total_qty += $val->total_packed_qty;
                            $gw += $val->gw;
                            $vol += ($val->length*$val->weight*$val->height)/1000000;
                            $boxes += $key;
                        ?>
                        <tr>
                            <td style="word-break: break-all;text-align: left"><?php echo ""; ?>
                            <td style="word-break: break-all;"><?php echo $val['box_name']; ?></td>
                            </td>
                            <td style="word-break: break-all;" class="text-right"><?php echo ""; ?></td>
                            <td style="word-break: break-all;"><?php echo $val['nw']; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo $val['gw']; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo $val['length']; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo $val['weight']; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo $val['height']; ?></td>
                            <td  style="word-break: break-all;" class="text-right"><?php echo number_format(($val['length']*$val['weight']*$val['height'])/1000000,'2','.',','); ?></td>
                        </tr>
                        <?php $jobs = $val['jobs'];?>
                        <?php foreach ($jobs as $key => $value) { ?>
                        <tr>
                           <td style="word-break: break-all;"><?php echo $i++; ?></td>
                            <td style="word-break: break-all;text-align: left">
                                <?php echo $value['inquiry_no'].'-'.$value['job_sequence']; ?>
                                </br>
                                <?php echo ucfirst($value['card_name']); ?>
                                </br>
                                <?php echo ucfirst($value['card_make']); ?>
                                </br>
                                <?php echo ucfirst($value['card_model']); ?>
                                </br>
                                <?php echo ucfirst($value['sr_no']); ?>
                            </td>
                            <td style="word-break: break-all;" class="text-right"><?php echo $value->main_packed_qty; ?></td>
                            <td style="word-break: break-all;"><?php echo ""; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo ""; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo ""; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo ""; ?></td>
                            <td style="word-break: break-all;" class="text-right"><?php echo ""; ?></td>
                            <td  style="word-break: break-all;" class="text-right"><?php echo ""; ?></td> 
                        </tr>
                    <?php } ?>
                    <?php }} ?>
                    <tr>
                        <th>Total</th>
                        <th>No of Boxes:<?=$boxes;?></th>
                        <th class="text-right"><?=$total_qty?></th>
                        <th colspan="2" class="text-right"><?=$gw?></th>
                        <th colspan="4" class="text-right"><?=number_format($vol,'2','.',',')?></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="padding-top: 10px;width:994px;margin-left:2px;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <th width="11%" style="background: transparent;text-align: left;">Mode of:</th>
                    <td width="18%" style="text-align: left;"><?=$challan_details->mode_of?></td>
                    <td rowspan="5" width="50%" style="text-align: left;">
                        <p style="padding-left: 5px;margin-top: 0px;">
                            <b style="font-weight: 600;">Payment Terms:</b>
                            <br><?=isset($challan_details->payment_terms) && !empty($challan_details->payment_terms)?$challan_details->payment_terms:''?>
                        </p>
                    </td>
                    <td style="text-align: right" rowspan="5" width="24%" ><b style="font-weight: 700;">for Inch Digital Techologies Pvt,</br></br></br></br></br></br>Authorized Signatory</b></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Transporter:</th>
                    <td><?=$challan_details->transporter?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">GR/LR No.:</th>
                    <td><?=$challan_details->lr_no?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">E way bill No.:</th>
                    <td><?=$challan_details->eway_bill_no?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Insurance:</th>
                    <td><?=$challan_details->total_invoice_value?></td>
                </tr>
            </table>
        </div>
        <!-- <div style="padding-top: 10px;width:994px;margin-left:2px;">
            <table border="1%" style="solid black;width: 100%; border-spacing: 0;">
                <tr>
                    <td rowspan="3" width="25%" ><b style="font-weight: 800;">Bank Details</b></br>
                    Name‐ Inch Energy Pvt Ltd.,</br> 
                    Bank A/C No. 37986959278</br> 
                    Bank Name‐ State Bank of India,</br> 
                    Bank Branch- IMT Manesar</br>
                    IFSC Code‐SBIN0016371,</br> 
                    Type of Account- Current
                    </td>
                    <td rowspan="3" width="45%"><b style="font-weight: 800;">Others Terms</b></br>
                    <small>a) Interest will be charged @24% in case the payment is not made as per PO.</small></br>
                    <small>b) Any claim regarding this bill will not be entertained after 7 days.</small></br> 
                    <small>c) Goods once sold will not be taken back.</small></br>
                    <small>d) Subject to Gurgaon Jurisdiction only.</small></br> 
                    <small>e) Damage/Short supply shall intimated with in 72 Hrs of delivery at gate. No claim will be consider after this period.</small>
                    </td>
                    <td style="text-align: left" rowspan="3" width="19%" ><b style="font-weight: 800;">for Inch Energy Pvt Ltd. ,</br></br></br></br></br></br>Authorized Signatory</b></td>
                </tr>
            </table>
        </div> -->
        <div style="padding-top: 10px;"></div>
    </main>
    <br>
    <?php if($uri!='packing_invoice_print'){ ?>
    <div class="center" style="margin-top:30px">
        <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
    </div>
    <?php } ?>
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