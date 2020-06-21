
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
 </script>
  
<!-- <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.scrollbars.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.normal').scrollbars();
        $('.normal').scrollbars1();
    });		
</script> -->

<!-- Choosen -->
  