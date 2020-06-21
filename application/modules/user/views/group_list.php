
<script type="text/javascript" src="<?=PUBLIC_URL?>fancybox/jquery.fancybox.js"></script>
 <link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>fancybox/jquery.fancybox.css" media="screen" />
 
    <script type="text/javascript">
    jQuery(document).ready(function($)
    {
        $('#permission').fancybox({
	            'width'				: 820,
        		'height'			: 460,
                'autoScale'     	: false,               
        		'type'				: 'iframe',               
	       });           
    });
    
    </script>
    


        

<div class="grid_10">
    <table class="flexme" style="display: none"></table>
     <?php 
      $this->load->view('kg_grid/grid',$grid);
     ?>             
</div>

             