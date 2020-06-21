<script>

$(document).ready(function () {
   //getNotification();
   setInterval(function(){ getNotification();  }, 60*1000);
});

function getNotification(){
    
     /********************Socket to set notification*******************************/
       var str = token_name+'='+token_hash;
        $.ajax({
           type:"POST", 
           url:"<?=base_url()?>notification/getNotification",
           data:str,
           success:function(data){
            //alert(data);
            var jobj=JSON.parse(data);
            for(p in jobj){
                //alert(jobj[p]['msg']);
                var date = new Date();
                //var currTime = Math.floor(date.getTime() / 1000);
                //alert(jobj[p]['msg']);
                
                var msgObj=JSON.parse(jobj[p]['msg']);
                var emailObj=JSON.parse(jobj[p]['emailData']);
                var notificationTime = msgObj.notificationTime;
                //console.log(currTime);
                //var timeToRun = notificationTime - currTime;
                var timeToRun = msgObj.timeToRun;
                console.log(timeToRun);
                if(timeToRun>0 && timeToRun<60){
                    console.log(msgObj.notificationType);
                    console.log(msgObj.description);
                    appendNotification(msgObj);
                    sendMail(emailObj);
                    /*setTimeout(function(){
                    //var msg=JSON.parse(jobj[p]['msg']);
                        sendMail(emailObj);
                    //alert(msg);
                    //alert(JSON.stringify(msg));
                    //socket.send(JSON.stringify(msg));
                    console.log(msgObj.description);
                    appendNotification(msgObj);
                    },timeToRun*1000);*/
                }
            }
            //return false;
                /*var date = new Date();
                var currTime = Math.floor(date.getTime() / 1000);
                var notificationTime = "<?php  echo $notificationTime  ?>";
                console.log("<?php  echo $v->date ?>");
                console.log(currTime);
                var timeToRun = notificationTime - currTime;
                console.log(timeToRun);
                if(timeToRun>0){
                    setTimeout(function(){
                        sendMail('<?php  echo $emailData;  ?>');
                    var msg = <?php  echo $msg  ?>;
                    //alert(JSON.stringify(msg));
                    //socket.send(JSON.stringify(msg));
                    appendNotification(msg);
                    },timeToRun*1000);
                }*/  
           } 
        });
    /*****************************************************************************/  
}


function sendMail(emailData){
    //alert(emailData);
    var str = token_name+'='+token_hash+'&emailData='+emailData;
    $.ajax({
       type:"POST", 
       url:"<?=base_url()?>notification/sendNotification",
       data:str,
       success:function(data){
         
       } 
    });
}

function appendNotification(obj){
    var controller='opportunity';
    if(obj.notificationType == 'task'){
       controller='task';    
    }
    $("#notification"+obj.rid).prepend('<li style="background-color:#fcf4f9">\
    	<a href="<?php echo SITE_PATH  ?>'+controller+'/view/'+obj.id+'" class="clearfix">\
    		<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart msg-photo"></i>\
    		<span class="msg-body">\
    			<span class="msg-title">\
    				'+capitalize(obj.notificationType)+': '+obj.description+
    			'</span>\
    			<span class="msg-time">\
    				<i class="ace-icon fa fa-clock-o"></i>\
    				<span>'+obj.date+'</span>\
    			</span>\
    		</span>\
    	</a>\
    </li>');
    var notificationCount = $(".notificationCount"+obj.rid).html();
    notificationCount = +notificationCount+1;
    $(".notificationCount"+obj.rid).html(notificationCount);
    $(".title"+obj.rid).html(capitalize(obj.notificationType)+': '+obj.description);
    playSound();
}

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}


function playSound(){
   var filename = "<?php  echo SITE_PATH  ?>assets/music/bell-ringing-01.mp3";
   $('<audio id="chatAudio"><source src="'+filename+'" type="audio/mpeg"></audio>').appendTo('body');
   $('#chatAudio')[0].play();
}


$(function(){
    var notificationIndex = $("#notificationIndex").val();
    $(".notificationCount"+"<?php echo currentuserinfo()->id;  ?>").html(notificationIndex);//set notification count
    
    $('#notificationIcon').blur(function(){
        $(".notificationCount"+"<?php echo currentuserinfo()->id;  ?>").html(0);
        setNotification();//set notification time when user hits on notification icon
    });
    
    
});


function setNotification(){
    var str = token_name+'='+token_hash;
    $.ajax({
       type:"POST", 
       url:"<?=base_url()?>notification/setNotificationTime",
       data:str,
       success:function(data){
         
       } 
    });
}

</script>
