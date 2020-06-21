<!DOCTYPE html>
<html>
<head>
	<title>Offer</title>
</head>
<style type="text/css">
*
{
	font-family: segoe ui, sans-serif;

}
b
{
    font-weight: 600;
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
    color: #444b54
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

</style>
<body style="background: <?php echo isset($_GET['action']) && $_GET['action']=='print'?'lightgray':''; ?>">
	<main class="app-content printdiv" style="background-color: white;border:#b4b8bb 0px solid;width: 815px;margin: 0;margin:auto;position: relative;padding: 0;page-break-after:always;">
		<!-- <br>   -->
        <div class="header_container" style="display: block;padding-top: 20px;">
            <div class="col-sm-6" style="width: 49%;float: left;">
                <p style="margin: 10px;"><img style="height: 70px;padding-top: 10px;" src="<?=base_url('assets/images/admin_logo.png')?>"></p>
            </div>
            <div class="col-sm-6" style="width: 49%;float: left;">
                <div class="information-div">
                    <p class="logo-title" style="font-size: 20px;">INCH ENERGY PVT. LTD.</p>
                    <p><b>Corp. Address:</b> Plot No.20, Sec. 3, IMT Manesar</p>
                    <p>Gurugram - 122050, Haryana (INDIA)</p>
                    <p><b>Tel:</b>+91-1244206019</p>
                    <p><b>E-mail:</b>sales@inchenergy.co.in</p>
                    <p><b>Website:</b>www.inchgroup.co.in/energy</p>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
        <?php 
        if(isset($_GET['action']) && $_GET['action']!='download')
        {?>
		<p style="position: absolute;right: 0px;top: -7px;">
			<input type ="button" value = "Print" id="printbtn"/>
		</p>
        <?php } ?>
		<!-- <center><h3>Title</h3></center> -->
        <div style="border-bottom: #80c9ec solid 2px; width: 99%;margin: auto;">&nbsp;</div>
	    <div class="row">
	        <div class="col-md-12">
		        <div style="min-height: 320px !important;padding: 10px;">
		          	<table class="table noborder" style="border-bottom: 0px solid black;">
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'><b>Offer No:</b> <?=$result->enq_no?> <b>Revision:</b> - <?php echo isset($_GET['rev']) && !empty($_GET['rev'])?$_GET['rev']:'Unknown'; ?> <b>Dated:</b> <?=date('d M Y')?></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'>To,</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'><b><br><?=$result->client_name?><br><?=$result->client_address?></b></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'><br><b>Subject: <?=$result->client_subject?> <br><br>PR/RFQ No.:<?=$result->rfq_pr_no?></b></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'><br><b>Kind Attention: Mr./Mrs./Miss. <?=$result->client_issuer_name?></b></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'><br>Dear Sir,</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td colspan="6" class='noborder'>Thanks a lot for your valuable inquiry as per subject mail dated <?=date('d M Y',strtotime($result->from_client))?>, We are pleased to submit our offer for your consideration as per below details. </td>
		        		</tr>
		        	</table>
                    <div class="item_table_containetr">
    		        	<table class="table item_table">
    		        		<tr class="tbl-row1 noborder1">
    		        			<th class='noborder1' style="width: 8%">Inch ID</th>
    		        			<th class='noborder1 text-center' style="width: 34%;text-align: center;">Description</th>
    		        			<th class='noborder1' style="width: 5%">Qty</th>
    		        			<th class='noborder1' style="width: 5%">UOM</th>
    		        			<th class='noborder1' style="width: 14%">Unit Price (INR)</th>
    		        			<th class='noborder1' style="width: 14%">Total Price (INR)</th>
    		        		</tr>

    		        		<?php 
    						if(isset($offer_list) && !empty($offer_list))
    						{
    						$i=1;
                            $final_price = 0;
    						foreach ($offer_list as $p_key => $offer) {?>
    							<tr>
    								<td><?php echo $result->enq_no.'-'.$i++ ?></td>
    								<td><?php echo $offer->description_issued_by_customer ?>
                                        <br>
                                        <?php echo "HSN-". $offer->hsn_no.' - '.$offer->hsn_gst ?>%
                                    </td>
                                    <td class="text-right"><?php echo $offer->qty ?></td>
    								<td><?php echo $offer->unit_name ?></td>
    								<td class="text-right"><?php echo number_format($offer->unit_offer_price, '2', '.', ',') ?></td>
    								<td class="text-right"><?php $line_final_price = $offer->total_unit_offer_price; echo number_format($line_final_price, '2', '.', ','); $final_price += $line_final_price; ?></td>
    							</tr>
    						<?php }} ?>
                            <tr>
                                <td colspan="5">Total Price</td>
                                <td class="text-right"><?php echo number_format(round($final_price), '0', '.', ',') ?></td>
                            </tr>
                            
    		        	</table>
                    </div>
		        	<table class="table noborder terms-condition" style="border-bottom: 0px solid black;">
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'><b>Note:</b> <?php echo $result->notes ?></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder' style="text-align: center !important;text-decoration: underline;"><b>TERMS & CONDITIONS</b></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>1. PRICE BASIS</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>FOR site (with in India)</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>2. PACKING & FORWARDING</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Inclusive.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>3. Payment Terms</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'><?php echo $result->payment_terms ?></td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>4. FREIGHT</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'><?php echo @$result->freight ?></td>
		        		</tr>
		        		
		        		<!-- ******************** -->
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>5. DELIVERY SCHEDULE</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'><?php echo $result->delivery_days?> days from the date of confirmation of Purchase order and advance receive if applicable</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>6. VALIDITY</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Firm for <?php echo $result->current_price_validity ?> days from the date of offer.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>7. INSURANCE</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Included as price is FOR basis. Any transit damage shall be report to us within three days from the date of delivery at store by transporter.In case of damage in box while delivery by transporter,an open delivery shall be taken.Any damage shall bereport on delivery receipt of transportercopy. Clean delivery to transporter are free from any insurance claim.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>8. UNLOADING</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Excluded.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>9. TAXES</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Excluded- As per GST applicable rates</td>
		        		</tr>
		        		<!-- <tr class="tbl-row1 noborder">
		        			<th class='noborder'>Excluded- As per GST applicable rates</th>
		        		</tr> -->
		        		<!-- <tr class="tbl-row1 noborder">
		        			<td class='noborder'>Excluded- As per GST applicable rates</td>
		        		</tr> -->
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>11. DATA SHEETS (If applicable)</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Approved data sheets shall be attached by you with the PO. However if data sheet approval takes time, delivery period shall be reckoned from the date of approval of data sheet.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>12. WARRANTY & GUARANTEE</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>General Terms- 12 months from the date of shipment or OEM Standard warranty Clause against manufacturing defect. No warranty will be applicable for consumable.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>13. APPROVALS OF DRAWINGS (If applicable)</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Dimensional drawings generally are indicated in Products catalogue. Before items are taken up for ordering. If you wish to approve dimesional drawings, delivery period shall be reckoned from date of drawing approval.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>14. ROAD PERMIT (If applicable)</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Road permit if applicable shall be made available in advance. Suitable delivery extension shall be provided for delay in forwarding us the road permit.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>15. DISPATCH INSTRUCTIONS</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Purchase order should carry clear dispatch instructions giving destination, mode of transport,Shipping Address Etc. If purchase order does not carry any dispatch instructions, it will be presumed that address as given in the purchase order shall be the destination & GST invoice will be prepared reflecting the same.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>16. INSPECTION ( if applicable)</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>a) As our products are of established quality we guarantee fault free performance. Inspection before dispatch by you/your consultants can be done if required. Goods will be offered for inspection within 7 days notice in advance.
		        				<br>
								b) Inspection shall be as per QAP. If QAP approval is a requirement then, delivery period shall be reckoned from the date of QAP approval.<br>

								c) For bought&ndash;out items, inspection clause, and QAP of the sub&ndash;vendor will not be applicable. <br>
								d) Inspection if required shall be carried out within 15 days of Seller intimation to Buyer. In case, Material not inspected within 15 days of seller intimation, alternatively we will assume that inspection have been waived and will have the liberty to dispatch the goods without inspection. <br>
								e) Inspection Place&ndash;China <br>
								f) If Inspection is requiring, it shall be with additional cost mutually decided later. All lodging, boarding, travelling, visa cost etc. shall be borne by Buyer.

							</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>17. ORDER AMENDMENTS</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Any changes in the specifications which amount to change in model and Quantity shall entail revision of delivery</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>18. INSTALLATION, COMMISIONING</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Excluded- If require by buyer then it shall be done at additional cost by buyer to seller and mutually decided later.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>19. CANCELLATIONS</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>In case of cancellation of LOI / PO, following cancellation charges will be paid by the purchaser<br> 
		        			(i) Within 7 days from date of PO, 30% of Contract basis value shall be paid as amount was paid by inch to Supplier.<br>
		        			(ii) 100% of Contract basis value shall be paid by client if inch already shared ready goods picture, as payment to supplier already issued in 100%.<br>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>20. STATUTORY VARIATIONS</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>Actual rate prevailing at the time of dispatch will be applicable. All statutory variations will be to purchasers account</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>21. FORCE MAJEURE</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>No liability shall be attached to us for nonperformance or delayed execution of the order as a result of "force majeure".</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>22. ARBITRATION</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>ALL DISPUTES & DIFFERENCES ARISING OUT OF OR CONNECTED WITH THIS ORDER, FAILING AMICABLE SETTLEMENT, SHALL BE REFERRED TO ARBITRATION UNDER THE INDIAN ARBITRATION ACT 1940 OR ANY STATUTORY MODIFICATION FOR THE TIME BEING IN FORCE & SUCH ARBITRATION SHALL TAKE IN GURGAON, HARYANA ONLY.</td>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<th class='noborder'>23. LIMITATION OF LIABILITY</th>
		        		</tr>
		        		<tr class="tbl-row1 noborder">
		        			<td class='noborder'>OUR RESPONSIBILITY CEASES ON DELIVERING THE GOODS TO THE CARRIERS. ALL CLAIMS FOR SHORTAGE OR DAMAGE MUST REACH US WITHIN 48 HOURS. AFTER THESE PERIODS HAVE ELAPSED, NO CLAIM WILL BE RECOGNISED BY US.<br><br>
		        				FOR ANY OTHER INFORMATION OR CLARIFICATION PLEASE FREE TO CONTACT US OR UNDERSIGNED. LOOK FORWARD TO ACCEPT OUR OFFER.
		        			</td>
		        		</tr>
		        		<!-- <tr class="tbl-row1 noborder">
		        			<td class='noborder'><small>For any other information or clarification please free to contact us or undersigned. Look forward to accept our offer.</small></td>
		        		</tr> -->
                        <tr>
                            <td><i>Warm Regards</i></td>
                        </tr>
		        		<tr>
                            <td><i>for Inch Energy Pvt. Ltd</i></td>
                        </tr>
                        <tr>
                            <td><b><?php echo $result->inch_name ?></b></td>
                        </tr>
                        <tr>
                            <td><p>Plot no-20, Sector-03, IMT Manesar, Gurgaon-122050, Haryana, India <br>Phone: +91-124-4206019, 4317133 (Extension-106); Mob No. +91- <?php echo $result->mobile ?>
                            <br><b>e-mail: sales@inchenergy.co.in<br> web: www.inchgroup.co.in</b>
                             </p></td>
                        </tr>
                        <tr>
                            <td><i><small>Computer generated offer, requires no signature.<br> Please don't print this offer unless you really need to.<br> Go Green. the future will thank you..</small></i></td>
                        </tr>
		        		<!-- ******************** -->
		        	</table>
		        </div>
	        </div>
	    </div> 
	</main>
	<br>
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