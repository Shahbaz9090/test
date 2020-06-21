<!-- Essential javascripts for application to work-->
    <!-- <script src="<?=base_url()?>assets_admin/js/jquery-3.2.1.min.js"></script> -->
    <script src="<?=base_url()?>assets_admin/js/popper.min.js"></script>
    <script src="<?=base_url()?>assets_admin/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets_admin/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url()?>assets_admin/js/plugins/pace.min.js"></script>

    <!-- Page specific javascripts-->
    <script src="<?=base_url()?>assets_admin/js/plugins/chart.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets_admin/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".chosen-select").chosen();
        var val = 1;
        if(val=='asuccess')
        {
          setTimeout(addNotify,500);
        }
        else if(val=="success")
        {
          setTimeout(updateNotify,500);
        }
         else if(val=="pdeleted")
        {
          setTimeout(deleteNotify,500);
        }
        
      });
      /* for add data */
      function addNotify()
      {
        $.notify({
          title: "Add Complete : ",
          message: "Something cool is just submitted!",
          icon: 'fa fa-check' 
        },{
          type: "success"
        });
      }
      /* for add data */
      function updateNotify()
      {
        $.notify({
          title: "Update Complete : ",
          message: "Something cool is just updated!",
          icon: 'fa fa-check' 
        },{
          type: "info"
        });
      }
      
      /* for delete data */
      function deleteNotify()
      {
        $.notify({
          title: "Record Deleted : ",
          message: "Something cool is just Deleted!",
          icon: 'fa fa-check' 
        },{
          type: "danger"
        });
      }
      
      var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56]
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
          }
        ]
      };
      var pdata = [
        {
          value: 300,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Complete"
        },
        {
          value: 50,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "In-Progress"
        }
      ]
      
      /*var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata); */


function validateImage(obj,error_msg,requestWidth="",requestHeight="")   
{
    // alert(error_msg);
    var status = 0;
    var avatar = $(obj).val();
    var extension = avatar.split('.').pop().toUpperCase();
    var file, img;
    var file = obj.files[0];
    var img = new Image();
    img.src = window.URL.createObjectURL( file );
    
    if( extension != "JPG" && extension != "PNG" && extension != "JPEG") 
    {
        // alert($('#'+error_msg))
        status++;
        // $("#"+obj.id+"_preview").hide();
        $(obj).val('');
        $(obj).attr('src','');
        $('#'+error_msg).text('Invalid file extension.');
    } 

    img.onload = function() {
      var width = img.naturalWidth, height = img.naturalHeight;
      window.URL.revokeObjectURL(img.src);
      if(requestWidth!='' && requestHeight!='')
      {
        if( !(width == requestWidth && height==requestHeight))
        {
          status++;
          // alert(error_msg);
          // $("#"+obj.id+"_preview").hide();
          $('#'+error_msg).text('Image file should be  '+requestWidth+'px X '+requestHeight+'px');
          $(obj).val('');
          $(obj).attr('src','');
        }
        
      }

      if(status>0) 
      {
        // $("#"+obj.id+"_preview").hide();
        $(obj).val('');
        $(obj).attr('src','');
        // $('#'+error_msg).text('');
        setTimeout(function () {
        $('#'+error_msg).text('');
        }, 10000);
        return false;
      } 
      else
      {
        $('#'+error_msg).text('');
        readURL(obj,obj.id+"_preview");
      }
    };
}

function readURL(input,id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
              $('#'+id).show();
              $('#'+id).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
    }
 }
 
    </script>
    
  </body>
</html>