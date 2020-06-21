<?php
$this->load->view('header');
?>

<style>
.solid-green{
background:#008000;
color:#FFFFFF;
font-weight:bold;
padding:4px;
text-align:center;
margin: auto;
}
#popUpDeleteTriggerNew{width:600px;}

</style>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/index.css" />
<div id="content">
    <div class="box">
    <div class="heading">
    <h1>Sentbox</h1>
      <?php if($gmail_exits) {?>
      <div class="buttons">
	<a class="button"  title="click here to retrive new email" href="<?php echo site_url().'/mail/sync_sentbox'; ?>">Sentbox Sync</a>
    
    
                
	</div> <?php } ?>
    </div>
	
<div class="content">
<div id="newEntries"></div>
<div id="firstEntries">
  <?php if($gmail_exits) {?>
<div align="center">

	<div id="container">
	<?php if($this->session->flashdata('success')){ ?>
<div class="solid-green" style="width:400px;">
<?php echo $this->session->flashdata('success'); ?>
</div>
<?php } ?>
<?php if($this->session->flashdata('error')){ ?>
<div style="width:350px;background:#FF0000;color:#FFFFFF;font-weight:bold;padding:4px;text-align:center;margin:auto;height:15px;">
<?php echo $this->session->flashdata('error'); ?>
</div><?php }?>
		
      <table class="list">
            <thead>
              <tr>
                <td width="1" style="text-align: center;" rowspan="2">
			  <input type="checkbox" onclick="$(&#39;input[name*=\&#39;selected\&#39;]&#39;).attr(&#39;checked&#39;, this.checked);"/></td>
            <th class="left arrow" style="width: 10%;background-color:#DDDDDD;border:1px solid #EFEFEF;background-image:none !important;cursor:text"> <span class="table-arrowleft" style="width:89px;">To</span> <span class="table-arrowright"><a href="<?php echo site_url() .'/mail/sorting/from/Desc/sent_box'; ?>" style="color: #000;"><span class="table-arrowrighttop_blue"></span></a><a href="<?php echo site_url() .'/mail/sorting/from/ASC/sent_box'; ?>" style="color: #000;"><span class="table-arrowrightbottom_blue"></span></a></span></th>
                 <td class="left">Subject</td>
                  <th class="left arrow" style="width: 10%;background-color:#DDDDDD;border:1px solid #EFEFEF;background-image:none !important;cursor:text"> <span class="table-arrowleft">Date</span> <span class="table-arrowright"><a href="<?php echo site_url() .'/mail/sorting/last_sync_date/Desc/sent_box'; ?>" style="color: #000;"><span class="table-arrowrighttop_blue"></span></a><a href="<?php echo site_url() .'/mail/sorting/last_sync_date/ASC/sent_box'; ?>" style="color: #000;"><span class="table-arrowrightbottom_blue"></span></a></span></th>
           <td class="left" style="width:100px;">Action</td>    </tr>
          </thead>
		<!--  <div class="search-background">
			<label>
			<img src="<?php echo base_url(); ?>image/loader.gif"  />
			</label>
		</div>-->
          <tbody>
          <?php
          
        if ($query->num_rows() > 0)
        {
        $i = 0;
        foreach($query->result() as $row) 
		{
		 $i++;
        ?>
<td style="text-align: center;">
			  <input type="checkbox" name="selected[]" value="30"></td>
             
              <td class="left">	<?php if($row->read == "1") {echo $row->to ; } else { ?><strong><?php echo $row->to; } ?></strong> </td>
               <td class="left">
               <a id="popUpDeleteTriggerNew" return="<?php echo site_url() . '/mail/sent_entries'; ?>" href="<?php echo site_url() .
                 '/mail/inbox_content/' . $row->id; ?>">
		
				<?php if($row->read == "1") {echo $row->subject ; } else { ?><strong><?php echo $row->subject; } ?></strong> 	  </a>
			  </td>
		
    <td>	<?php if($row->read == "1") {echo $row->last_sync_date ; } else { ?><strong><?php echo $row->last_sync_date; } ?></strong> 
   </td>
         
			    <td class="left"><a id="popUpDeleteTrigger" return="<?php echo site_url().'/mail/sent_entries'; ?>" href="<?php echo site_url().'/mail/confirm/'.$row->id;?>">
			  <img src="<?php echo base_url(); ?>image/delete.jpg"  height="20" width="20"/></a>
               	<a title="Reply"  id="popUpDeleteTrigger" return="<?php echo
        site_url() .'/mail/sent_entries'; ?>" href="<?php echo site_url() .
        '/mail/reply/' . $row->id; ?>">
			  <img src="<?php echo base_url(); ?>image/reply.png"  height="20" width="20"/></a>
		
              
              </td>
            </tr>
                         <?php
        }
        } else {
        ?>
       
        <tr bgcolor="#ffffff">
            <td colspan="30" align="center">No data!</td>
        </tr>
        <?php
        }
        ?>
		
        </tbody>
        </table>
	</div>
 
      
<div id="paging_button" align="right">
		<ul>
			<?php
//echo $this->table->generate($records);
echo $this->pagination->create_links();

?>

		</ul>
	</div>
	</div>
      <div class="pagination"><div class="results"></div>
    <?php } else { echo "Please Add Gmail Credentials First !";?> <a title="Google Add"  href="<?php echo site_url() . '/dash/login_details/'?>">
			 Add Gmail credentials. </a><?php }?> 
      </div>
    </div>
  </div>
</div>

</div>
<?php
$this->load->view('footer');
?>
