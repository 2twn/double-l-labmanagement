 <script>
  $(function() {
$( "#tabs" ).tabs();
});
 $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'equipments', 'action' => 'get_booking_day_table'));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#equip_table_content')[0].innerHTML = response;
			$(function() {
			 	$( document ).tooltip({
			 		items: "[title]",
			 		content: function() {
			 			var element = $( this );
			 			if ( element.is( "[title]" ) ) {
			 				return element.attr( "title" );
			 			}
			 		}
			 	});
			 });
		}
	});

  $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'training', 'action' => 'training_day_list'));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#training_today_content')[0].innerHTML = response;
		}
	});

   $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'training', 'action' => 'training_day_list', 
				                                 date('Y-m-d',mktime(date('H'),date('i'),date('s'),date('m'),date('d')+1,date('Y')))));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#training_tomorrow_content')[0].innerHTML = response;
		}
	});

    $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'safetytrials', 'action' => 'checkdate_list'));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#safetytrials_checkdate_list')[0].innerHTML = response;
		}
	});  

    $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'reagents', 'action' => 'record_usage_list'));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#reagents_record_usage_list')[0].innerHTML = response;
		}
	});  	
</script>
<div id="tabs">
	<ul>
	<li><a href="#equip_table_content">當日儀器預約</a></li>
	<li><a href="#training_today_content">本日教育訓練列表</a></li>
	<li><a href="#training_tomorrow_content">次日教育訓練列表</a></li>
	<li><a href="#safetytrials_checkdate_list">安定性樣品檢驗時間到期清單</a></li>
	<li><a href="#reagents_record_usage_list">試藥使用期限到期清單</a></li>
	</ul>
	<div id="equip_table_content"></div>
	<div id="training_today_content"></div>
	<div id="training_tomorrow_content"></div>
	<div id="safetytrials_checkdate_list"></div>
	<div id="reagents_record_usage_list"></div>	
</div>


