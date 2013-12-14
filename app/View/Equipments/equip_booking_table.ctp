 <script>
    function GetTable() {
       $.ajax({	
			url:'<?php echo $this->html->url(array('controller'=>'equipments', 'action' => 'get_booking_table'));?>', 
			data:{ 	
				equip_id: jQuery('#search_equip_id')[0].value, 
				search_year: jQuery('#search_year')[0].value, 
				search_month: jQuery('#search_month')[0].value }, 
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
<div class="pageheader_div"><h1 id="pageheader">儀器預約紀錄查詢</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<table>	
	<tr>
		<td>
			<?php echo $this->Form->select('search_equip_id', $equips, array('empty'=>false, 'onchange' => 'GetTable();'));?>
			<?php echo $this->Form->select('search_year', $years, array('empty'=>false, 'onchange' => 'GetTable();', 'value' => $search_year));?>
			<?php echo $this->Form->select('search_month', $months, array('empty'=>false, 'onchange' => 'GetTable();', 'value' => $search_month));?>
		</td>
	</tr>
	<tr>
		<td id="table_content">

		</td>
	</tr>
</table>
