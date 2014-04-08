<h2>當日儀器預約</h2>
<div id="equip_table_content">

</div>
 <script>
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
</script>
 <div id="equip_today_content">

</div>
<script>
 $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'equipments', 'action' => 'equip_book_day_list'));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#equip_today_content')[0].innerHTML = response;
		}
	});
</script>
 <div id="equip_tomorrow_content">

</div>
<script>
 $.ajax({	
		url:'<?php echo $this->html->url(array('controller'=>'equipments', 'action' => 'equip_book_day_list', 
				                                 date('Y-m-d',mktime(date('H'),date('i'),date('s'),date('m'),date('d')+1,date('Y')))));?>', 
		data:{ }, 
		type: "post", 
		success: function(response){
			$('#equip_tomorrow_content')[0].innerHTML = response;
		}
	});
</script>