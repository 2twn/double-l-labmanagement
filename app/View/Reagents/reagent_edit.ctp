 <script>


    function open_name_window() { 
        $.blockUI({ css:{width:'700px',height:'300px'}, message: $('#query_name_window') }); 
    }; 
    function close_name_window(){
		$.unblockUI();
    }
   		
	function search_chemical_name() {
		doc_topic = $("#doc_topic")[0].value;
		$.ajax(
				{	
					url:'<?php echo $this->html->url(array('controller'=>'reagents', 'action' => 'chemical_name_search'));?>', 
					data:{ name: doc_topic }, 
					type: "post", 
					success: function(response){
						$("#select_doc_tbl")[0].innerHTML = response;
						$('tr[name=chemical_item]').click(function(){
							$('#ReagentChemicalId').val($(this).attr('chemical_id'));
							$('#edit_chemical_name').val($(this).attr('chemical_name'));
							
							close_name_window();
						});
					}
				}
			);
		return false;
//		$.unblockUI();						
	}    
</script>
<style>
.input_label {
	width: 120px;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">試藥資訊管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('Reagent', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 

?>
	<table>
		<tr>
			<td class="input_label">試藥代號</td>
			<td><?php 
				if($this->request->data['Reagent']['id'] == null)
					echo $this->Form->text('id', array('size'=>20, 'maxlength'=>20));
				else
					echo $this->Form->text('id', array('readonly'=>true, 'size'=>20, 'maxlength'=>20));

			?></td>
		</tr>
		<tr>
			<td class="input_label">試藥名稱</td><td><?php echo $this->Form->input('name', array('size'=>20, 'maxlength'=>20));?></td>
		</tr>		
		<tr>
			<td class="input_label">化學名稱</td>
				
			<td>
				<input id="edit_chemical_name" type="text" readonly value='<?php echo $this->request->data['Chemical']['name']?>' "/>
				<?php
				 echo $this->Form->hidden('chemical_id');
				 echo $this->Html->link('選擇化學名稱', 'javascript:open_name_window()',array('onclick'=>''));
			?></td>
		</tr>
		<tr>
			<td class="input_label">等級</td><td><?php echo $this->Form->select('reagent_level_id', $reagent_levels, array('empty'=>false));?></td>
		</tr>	
		<tr>
			<td class="input_label">狀態</td><td><?php echo $this->Form->select('status', $status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">說明：<br>(最多30個中文字)</td>
			<td valign="top"><?php 
				echo $this->Form->textarea('memo',array('cols'=>'30','rows'=>'3'));
				if(!empty($errors['memo']))
					echo $this->Html->tag('span',$errors['memo'][0],array('class'=>'message'));
			?></td>
			</td>
		</tr>									
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>		

<div id="query_name_window" style="display: none; cursor: default;"> 
	關鍵字：
	<?php echo $this->Form->text('doc_topic', array('size'=>8, 'style'=>'width:150px') );?>
    <?php echo $this->Html->link('搜尋', 'javascript:void(0);',array('onclick'=>'search_chemical_name();'));?>
     <?php echo $this->Html->link('取消', 'javascript:void(0);',array('onclick'=>'close_name_window();'));?>
    <div id="select_doc_tbl" style="width:700px;height:270px;overflow:auto;"></div>
   
</div>
