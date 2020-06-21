<!DOCTYPE html>
<html>
<head>
	<title>Purchage Order </title>
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
b
{
    font-weight: 600;
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

.main_table th,
.main_table td
{
	text-align: center;
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
<body style="background: <?php echo isset($_GET['action']) && $_GET['action']!='download'?"lightgray":'white'; ?>">
	<main class="app-content printdiv" style="background-color: white;border:#b4b8bb 0px solid;width: 815px;margin: 0;margin:auto;position: relative;padding: 0;page-break-after:always;margin-top: 10px;">
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
                    <p><b>E-mail:</b>sales@energy.co.in</p>
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
        <div style="border-bottom: #80c9ec solid 2px; width: 99%;margin: auto;">&nbsp;</div>
	    <div>
            <div style="min-height: 320px !important;padding: 10px;">
                <table style="border-bottom: 0px solid black;width: 100%; border-spacing: 0;">
                    <tr>
                        <td colspan="6"><h3 style="text-align: center;margin-top: 0px;">PURCHAGE ORDER</h3></td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid gray;border-right: 1px solid gray;border-top: 1px solid gray"><b>P.O. Number:</b> <?php echo $result->po_no ?></td>
                        <td style="text-align: right;border-top: 1px solid gray;border-right: 1px solid gray"><b>DATE:</b> <?php echo date("d/m/Y", strtotime($result->po_date)) ?></td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid gray;border-right: 1px solid gray;border-top: 1px solid gray">
                            <p style="margin-top: 0px;"><b>SHIP TO</b></p>
                            <p style="margin-top: 0px;">Gurugram - 122050, Haryana (INDIA) <br>
                            Tel:+91-1244206019 <br>
                            E-mail:sales@energy.co.in</p>
                        </td>
                        <td style="border-top: 1px solid gray;border-right: 1px solid gray">
                            <p style="margin-top: 0px;"><b>BILL TO</b></p><br>
                            <p style="margin-top: 0px;">Gurugram - 122050, Haryana (INDIA) <br>
                            Tel:+91-1244206019 <br>
                            E-mail:sales@energy.co.in</p>
                        </td>
                        
                    </tr>
                </table>
                <div class="item_table_containetr">
                    <table class="table item_table">
                        <tr class="tbl-row1 noborder1">
                            <th>Sr. No</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>Unit Price (INR</th>
                            <th>Total Price (INR</th>
                        </tr>

                        <?php 
                        if(isset($product_list) && !empty($product_list))
                        {
                        $i=1;
                        $final_price = 0;
                        foreach ($product_list as $p_key => $offer) {?>
                            <tr>
                                <td><?php echo $result->po_no.'-'.$i++ ?></td>
                                <td><?php echo $offer->description_issued_by_inch ?>
                                    <br>
                                    <?php echo $offer->hsn_name.' - '.$offer->hsn_gst ?>%
                                </td>
                                <td class="text-right"><?php echo $offer->qty ?></td>
                                <td><?php echo $offer->unit_name ?></td>
                                <td class="text-right"><?php echo number_format($offer->unit_offer_price, '2', '.', ',') ?></td>
                                <td class="text-right"><?php $line_final_price = $offer->total_unit_offer_price; echo number_format($line_final_price, '2', '.', ','); $final_price += $line_final_price; ?></td>
                            </tr>
                        <?php }} ?>
                        <tr>
                            <td colspan="5">Total Price</td>
                            <td class="text-right"><?php echo number_format($final_price, '2', '.', ',') ?></td>
                        </tr>

                    </table>
                </div>
                <br>
                <br>
                <table>
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
                        <td><p>Plot no-20, Sector-03, IMT Manesar, Gurgaon-122050, Haryana, India Phone: +91-124-4206019, 4317133 (Extension-106); Mob No. +91- <?php echo $result->mobile ?> </p></td>
                    </tr>
                    <tr>
                        <td><i>e-mail: sales@inchenergy.co.in; web: www.inchgroup.co.in</i></td>
                    </tr>
                </table>
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