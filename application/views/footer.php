                </div>
             </div><!-- End #content -->
        </div><!-- End #wrapper -->
        
    </body>
	
</html>

<!-- bootstrap processing modal-->
<div class="modal fade" id="myProcessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:100%;left:21%;border-radius:0px !important;">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-body" style="text-align:center;"><br />
<i class="fa fa-spinner fa-spin fa-2x" ></i> &nbsp;&nbsp;&nbsp;<strong>Processing...</strong>
</div>

</div>
</div>
</div>
<div class="ajax-process-modal"><br /><i class="fa fa-spinner fa-spin fa-2x" ></i> &nbsp;&nbsp;&nbsp;<strong>Processing...</strong></div>
<!-- end of modal -->
<script src="<?=PUBLIC_URL?>plugins/chosen/chosen.jquery.js"></script> 
 <script type="text/javascript">
 
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:15},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    
     $(document).on('keypress','.validate_input',function(event){
   
            var ew = event.which;
            var num=[46,48,49,50,51,52,53,54,55,56,57];
          
           if($.inArray( ew, num ) > -1) 
           {
             return true;
           }
           
           return false;
    });

 </script>
  
<!-- <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.scrollbars.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.normal').scrollbars();
        $('.normal').scrollbars1();
    });		
</script> -->

<!-- Choosen -->
<div class="footer">
<h1>Copyright &#169; <?php echo date('Y');?> InchGroup-Erp</h1>

</div>
<!-- <script type="text/javascript" src="<?=PUBLIC_URL?>js/main.js"></script>-->