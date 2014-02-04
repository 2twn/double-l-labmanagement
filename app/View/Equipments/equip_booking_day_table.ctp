 <script>
    function GetTable() {
       $.ajax({	
			url:'<?php echo $this->html->url(array('controller'=>'equipments', 'action' => 'get_booking_day_table'));?>', 
			data:{ }, 
			type: "post", 
			success: function(response){
				jQuery('#table_content')[0].innerHTML = response;
			}
		});
    };
	$(document).ready(function() {
        GetTable();
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">當日儀器預約紀錄</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<table>	
	<tr>
		<td id="table_content">

		</td>
	</tr>
</table>
