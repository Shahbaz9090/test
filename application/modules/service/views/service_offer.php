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
<body style="background: lightgray;">
  <main class="app-content printdiv" style="background-color: white;border:#b4b8bb 0px solid;width: 815px;margin: 0;margin:auto;position: relative;padding: 0;page-break-after:always;">
    <!-- <br>   -->
        <div class="header_container" style="display: block;padding-top: 20px;">
            <div class="col-sm-6" style="width: 49%;float: left;">
                <p style="margin: 10px;"><img style="height: 70px;padding-top: 10px;" src="<?=base_url('assets/images/admin_logo.png')?>"></p>
            </div>
            <div class="col-sm-6" style="width: 49%;float: left;">
                <div class="information-div">
                    <p class="logo-title" style="font-size: 20px;">INCH DIGITAL TECHNOLOGIES PVT. LTD.</p>
                    <p><b>Corp. Address:</b> Plot No.20, Sec. 3, IMT Manesar</p>
                    <p>Gurugram - 122050, Haryana (INDIA)</p>
                    <p><b>Tel:</b>+91-1244206019</p>
                    <p><b>E-mail:</b>sales.technologies@inchgroup.co.in</p>
                    <p><b>Website:</b>www.inchgroup.co.in/technologies</p>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
    <p style="position: absolute;right: 0px;top: -7px;">
      <input type ="button" value = "Print" id="printbtn"/>
    </p>
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
                  <td colspan="6" class='noborder'><br><b>Subject: Submission of offer against refurbishment of  PR No. :<?=$result->rfq_pr_no?> <br><br>Gate Pass No. :<?=$result->gate_pass?></b></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td colspan="6" class='noborder'><br><b>Kind Attention: Mr./Mrs./Miss. <?=$result->client_issuer_name?></b></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td colspan="6" class='noborder'><br>Dear Sir,</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td colspan="6" class='noborder'>We are thankful for giving us the inquiry for the refurbishment of Electronic card. We have diagnosis the faulty product and pleased to inform you that’s these cards can be refurbished with quality to perform same function as new cards. Here with we are submitting our offer for the refurbishment of Electronic cards as per below : </td>
                </tr>
              </table>
                    <div class="item_table_containetr">
                  <table class="table item_table">
                    <tr class="tbl-row1 noborder1">
                      <th class='noborder1' style="width: 8%">JOB ID</th>
                      <th class='noborder1 text-center' style="width: 18%;text-align: center;">Card Name/Card Make</th>
                      <th class='noborder1' style="width: 15%">Card Model/Sr. No.</th>
                      <th class='noborder1' style="width: 16%">Analysis Cost (INR)</th>
                      <th class='noborder1' style="width: 19%">Refurbishment Cost (INR)</th>
                    </tr>

                    <?php 
                if(isset($offer_list) && !empty($offer_list))
                {
                $i=1;
                $final_price = 0;
                foreach ($offer_list as $p_key => $offer) {
                  $final_price += $offer->analysis_cost+$offer->repairing_cost;
                  ?>
                  <tr>
                    <td><?php echo $offer->job_id ?></td>
                    <td><?php echo $offer->card_name ?>
                        <br>
                    <?php echo $offer->card_make?>
                    </td>
                    <td><?php echo $offer->card_model ?>
                        <br>
                    <?php echo $offer->sr_no?>
                    </td>
                    <td class="text-right"><?php echo number_format($offer->analysis_cost, '2', '.', ',') ?></td>
                    <td class="text-right"><?php echo number_format($offer->repairing_cost, '2', '.', ',') ?></td>
                  </tr>
                <?php }} ?>
                    <tr>
                        <td colspan="4">Total Price</td>
                        <td class="text-right"><?php echo number_format(round($final_price), '0', '.', ',') ?></td>
                    </tr>
                  </table>
                    </div>
              <table class="table noborder terms-condition" style="border-bottom: 0px solid black;">
                <tr class="tbl-row1 noborder">
                  <td class='noborder'><b>Note:</b> Item 1 Warranty 7 Days and its Included as price is FOR basis (Inclusive Store plant). Any transit damage shall be report to us within in one week from the date of delivery at store by transporter.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder' style="text-align: center !important;text-decoration: underline;"><b>TERMS & CONDITIONS</b></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>1. PRICE BASIS</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Applicable to above cards and its refurbishment only.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>2. PACKING & FORWARDING</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>We shall be using the same package box to resend the item to site. In case of package received in damaged and not reusable, we may charge the package cost according to the size and quantity of package</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>3. Payment Terms</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'><?php echo $result->payment_terms ?></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>4. FREIGHT/INSURANCE</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'><?php echo @$result->freight_insurance ?></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>5. DELIVERY SCHEDULE </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'><?php echo @$result->delivery_schedule ?></td>
                </tr>
                
                <!-- ******************** -->
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>6. WARRANTY & GUARANTEE** (Refer detailed clause about Warranty and Guarantee)</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>General Terms for Services- <?php echo $result->warranty_terms?></td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>7. VALIDITY</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Our offer is valid for 15 days from date of first offer & thereafter subject to our confirmation.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>8.UNLOADING</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Excluded. In Client Scope</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>9. TAXES** </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Excluded- Extra at actual. Presently 18% as per Govt. Norms.(HSN CODE 998717)</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>10. OCTROI/ENTRY TAX/ANY OTHER LEVIES </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Extra as applicable to Buyer’s account.</td>
                </tr>
                <!-- <tr class="tbl-row1 noborder">
                  <th class='noborder'>Excluded- As per GST applicable rates</th>
                </tr> -->
                <!-- <tr class="tbl-row1 noborder">
                  <td class='noborder'>Excluded- As per GST applicable rates</td>
                </tr> -->
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>11. DISPATCH INSTRUCTIONS</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Work order should carry clear dispatch instructions giving destination, mode of transport, Shipping address Etc. If work order does not carry any dispatch instructions, it will be presumed that address as given in the work order shall be the destination & GST invoice will be prepared reflecting the same.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>12. ORDER AMENDMENTS </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Any changes in the specifications which amount to change in model and Quantity shall entail revision of delivery & prices.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>13.  INSTALLATION, COMMISIONING</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>The price of installation and commissioning not included.<br>
                  We recommended availing services of our service engineer who will be responsible for healthiness of existing equipment to ensure proper working of refurbishment product. This will be charge extra as per requirement rendered.
                  </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>14.  CANCELLATIONS </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>In case of cancellation of LOI / WO, following cancellation charges will be paid by the purchaser
                    <ol>
                      <li>100% of Analysis Cost+ 10% of repair cost : Within 7 days of LOI / order</li>
                      <li>100% of Analysis Cost+ 30% of repair cost : Within 10 days of LOI / order</li>
                      <li>100% of Analysis Cost+ 50% of repair cost : Within 15 days of LOI / order</li>
                    </ol>
                  </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>15.  STATUTORY VARIATIONS</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>Actual statutory rate prevailing at the time of dispatch will be applicable. All statutory variations will be to purchasers account.</td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>16.  FORCE MAJEURE </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>No liability shall be attached to us for nonperformance or delayed execution of the order as a result of "force Majeure". </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>17.  ARBITRATION </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>ALL DISPUTES & DIFFERENCES ARISING OUT OF OR CONNECTED WITH THIS ORDER, FAILING AMICABLE SETTLEMENT, SHALL BE REFERRED TO ARBITRATION UNDER THE INDIAN ARBITRATION ACT 1940 OR ANY STATUTORY MODIFICATION FOR THE TIME BEING IN FORCE & SUCH ARBITRATION SHALL TAKE IN GURGAON, HARYANA ONLY. </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>18.  LIMITATION OF LIABILITY </th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>OUR RESPONSIBILITY CEASES ON DELIVERING THE GOODS TO THE CARRIERS. ALL CLAIMS FOR SHORTAGE OR DAMAGE MUST REACH US WITHIN 48 HOURS. AFTER THESE PERIODS HAVE ELAPSED, NO CLAIM WILL BE RECOGNISED BY US. </td>
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
                  <td class='noborder'>OUR RESPONSIBILITY CEASES ON DELIVERING THE GOODS TO THE CARRIERS. ALL CLAIMS FOR SHORTAGE OR DAMAGE MUST REACH US WITHIN 48 HOURS. AFTER THESE PERIODS HAVE ELAPSED, NO CLAIM WILL BE RECOGNISED BY US.
                  </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>SPECIAL TERMS FOR SERVICE:-</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>
                    a.  The Refurbishment Services are offered in respect of all Equipment for which we accept your request to conduct the Repair and diagnostic Services.<br>
                    b.   We will provide the Refurbishment Services with due skill and care and we will use reasonable endeavors to repair your Equipment. We can however not guarantee that we will always succeed and when we are unable to repair your Equipment, we will refund you the price paid by you for those particular Repairs Services.<br>
                    c.   Customer should be responsible for Electronic card installation in main equipment. Any damage to refurbished product or/and main equipment due to wrong installation we shall be not responsible. Warranty will not be covered any parts except the repairing parts.<br>
                    d.   Analysis of card before/after refurbishment needs the main equipment in place. In case of requirement of main equipment client shall send us the main equipment or give us access to main equipment for analysis. We confirm to follow the guideline to use /operate of main equipment.
                  </td>
                </tr>
                <tr class="tbl-row1 noborder">
                  <th class='noborder'>SPECIAL TERMS FOR WARRANTY & GUARANTEE:</th>
                </tr>
                <tr class="tbl-row1 noborder">
                  <td class='noborder'>
                    a.   We warrant that all repairs undertaken by us will be free of defects in materials and workmanship for a period of period stated above with starting on the date of return of the Equipment to you after completion of the Repairs Services.<br>
                    b.  Such warranty to be void if any warranty seals, identification placed on the Equipment by us following the Repairs Service are broken or defaced. <br>
                    c.  All water damage Equipment repairs will not be covered by warranty.<br>
                    d.  Should a natural failure recur in same part within 15 days shall be repair free of charge. However should the failure be attributable to wrong usage or abuse, accident, lighting, ingress of water external fire damage, natural disaster, improper ventilation, due to environment conditions, excessive shock, normal wear tear or any external cause than the part and labor will be chargeable.<br>
                    e.  We shall not be liable for any parts of your PCB if you bring in water damage Equipment for repair.<br>
                    f.  We shall not be liable for any failure if you are not following reasonable advice or instructions provided during or after completion of the Repairs Services or instruction of installation & commissioning for main equipment.<br>
                    g.  For Water Damage Equipment, a special charge is applicable for turning on the Equipment, any parts occur faulty after equipment being turned on, and an additional charge for repairing the faulty part will be applied. Water Damage Equipment is under 30 day’s warranty.<br>
                    h.  If we are unable to repair your Equipment, no fault is found on your Equipment or you do not accept our estimate, we will return your Equipment to you un-repaired and we reserve the right to charge you an Analysis fee in accordance with our offered charges.<br>
                    i.  This repair service does not cover liability for loss any data during the repair service.<br><br>
                    For any other information or clarification please free to contact us or undersigned. Look forward to accept our offer.
                  </td>
                </tr>
                <!-- <tr class="tbl-row1 noborder">
                  <td class='noborder'><small>For any other information or clarification please free to contact us or undersigned. Look forward to accept our offer.</small></td>
                </tr> -->
                        <tr>
                            <td><i>Warm Regards</i></td>
                        </tr>
                <tr>
                            <td><i>for Inch Digital Technologies Pvt. Ltd</i></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p><b><?php echo $result->service_lead_name ?></b><br>Plot no-20, Sector-03, IMT Manesar, Gurgaon-122050, Haryana, India <br>Phone: +91-124-4206019, 4317133 (Extension-108); Mob No. +91- <?php echo $result->servie_lead_mobile ?>
                            <br><b>e-mail: sales.technologies@inchgroup.co.in;<br>web: www.inchgroup.co.in</b>
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