<style>
.vertical-scroller {
	height: 250px;
	width: 289px;
	overflow-y: auto;
}	


.document-wrapper
	{
		min-height: 185px;
		max-height: 145px;
		overflow: auto;
	}
	.width-header h4
	{
		font-weight: bold;
		font-size: .9em;
		background: #ecf3f7;
		padding: 5px;
		margin-bottom: 0px;
	}
	.color-file
	{
		color: #f0da86;
	}
	.document-wrapper .document-list ul
	{
		margin:0;
		/*max-height: 145px;
		min-height: 145px;
		overflow-y: auto;*/
	}

	.document-wrapper .document-list ul li
	{
		position: relative;
		padding: 2px 8px;
		margin-bottom: 0px;
	    border-bottom: 1px solid #f3eded;
	    cursor: pointer;
	}
	.document-wrapper .document-list ul li .file-title
	{
	    display: -webkit-box;
	    max-height: 3.2rem;
	    -webkit-box-orient: vertical;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: normal;
	    -webkit-line-clamp: 1;
	    line-height: 1.6rem;
	    max-height: 4.4rem;
	    margin-left: 15px;
	    width: 85%;
	}
	.document-wrapper .document-list ul li .fa
	{
		position: absolute;
	}

	.document-wrapper .document-list ul li .fa.fa-file
	{
		left: 5px;
		top: 7px;
	}
	.document-wrapper .document-list ul li .fa.fa-trash-o
	{
		left: 487px;
		top: 24px;
	}
	.document-wrapper .document-list ul li .fa.fa-download
	{
		right: 22px;
		top: 7px;
	}
	.file-action
	{
		cursor: pointer;
	}
	.overflow-box
	{
		width: 100%;
		max-height: 400px;
		overflow: auto;
	}
	.document-info
	{
		display: none;
		position: absolute;
		left: 20px;
		border:gray solid 1px;
		z-index: 999999999999;
		background: white;
	}
	.document-wrapper .document-list ul li:hover .document-info
	{
		display: block;
	}
    .table tbody tr th {
        background-color: #ececec !important;
    }
    .table tbody tr.released td {
        background-color: #c0ffc0 !important;
    }						
</style>					
					<?php if(!empty($notes)){   ?>
								<div class="span6">
									<div class="row-fluid" style="width:289px; margin-left:235px;">
										<div class="widget-box widget-color-blue box">
												<div class="widget-header widget-header-small">
													<h5 class="widget-title bigger lighter" style='display:inline-block'>
														<i class="ace-icon fa fa-rss"></i>Old Notes 
													</h5>
													<span style='float:right' onclick="$('.widget-body').slideToggle();"><a class="minimize" href="#" style="display: ;"><i class='fa fa-minus' style='color:white;margin:8px 10px 0 0'></i></a></span>
												</div>
												
												<div class="widget-body vertical-scroller">
													<div class="widget-main">
														<div class="row-fluid">
															<div class="span12">
																<div class="widget-box transparent">
																	<div class="widget-body">
																		<div class="widget-main padding-8">
																			<div  class="profile-feed my-scroll">
																				<?php if(isset($notes) && is_array($notes)){ $i=1;
																				foreach($notes as $i_key => $i_val){ ?>
																					<div class="boxes">
																						<p style="float:left"><b><?=$i++.":"?></b></p>
																						<p style="float:left; padding-left: 2em; "><?=ucwords($i_val->note)?></p></br>
																						<p style="float:right;"><font size="0"><?=$i_val->first_name . " " . $i_val->last_name;?></font></p><font style="float:right;" size="1">Added By:</font></br>
																						<div style="margin-left:88px"><p style="margin-left:20px"><p style="float:right;"><font size="0"><?=$i_val->created_time?></font></p><font style="float:right;" size="1">Time:</font></div>
																					</div>
																					<?php //echo "</br>";
																					} }  ?>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
										</div>
									</div>
								<?php } ?>