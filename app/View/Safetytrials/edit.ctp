 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
        $("input[name='data[SafetyTrial][check_type]']").click( 
        	function() { 
        		
        		$("input[class='checkmode']:checkbox").attr('checked',false);
        		switch($(this).val()){
        			case "1":
        				$.each(['1M','2M','3M','6M','9M','12M','18M','24M'], function(index, val){
        					
        					$("input[class='checkmode'][name='data[check_modes]["+val+"]']:checkbox").attr('checked',true).click();
        				});
        				break;
        			case "2":
        				 $.each(['1M','2M','3M','6M'], function(index, val){
        					
        					$("input[class='checkmode'][name='data[check_modes]["+val+"]']:checkbox").attr('checked',true).click();
        				});
        				break;
        			case 3:
        				break;
        		}
        	}
        );
    });
</script>
<style>
.input_label {
	width: 120px;
}

.checkmode  {
	width: 60px;
}
input[type="radio"] {
    display:inline-block;
}

label {
    display:inline-block;
}
</style>
<div class="pageheader_div"><h1 id="pageheader">安定性樣品資料</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<?php 
	echo $this->Form->create('SafetyTrial', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
	echo $this->Form->hidden('id');
?>
	<table>
		<tr>
			<td class="input_label">樣品批號</td><td><?php echo $this->Form->input('trial_lot',array('maxlength'=>12,'size'=>'13'));?></td>
		</tr>
		<tr>
			<td class="input_label">樣品名稱</td><td><?php echo $this->Form->input('trial_name',array('maxlength'=>16,'size'=>'17	'));?></td>
		</tr>		
		<tr>
			<td class="input_label">所屬專案</td><td><?php echo $this->Form->select('project_id', $projects, array('empty'=>false));?></td>
		</tr>		
		<tr>
			<td class="input_label">儲存位置</td><td><?php echo $this->Form->input('location',array('maxlength'=>20,'size'=>'21'));?></td>
		</tr>

		<tr>
			<td class="input_label">狀態</td><td><?php echo $this->Form->select('status', $trial_status, array('empty'=>false));?></td>
		</tr>
		<tr>
			<td class="input_label">開始時間</td><td><?php echo $this->Form->text('start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?></td>
		</tr>		
		<tr>
			<td class="input_label">檢核時間點</td>
			<td><label>
				<?php 
					echo $this->Form->radio('check_type', $checktypes, 
							array('empty'=>false,'legend' => false,'hiddenField'=>false,'label'=>false,
								'separator'=>'</label>    <label>'
								)
						);
				?>

			</label></td>
		</tr>
		<tr>
			<td class="input_label"></td>
			<td>
				<table>
			<?php 
				$count = 0;
				foreach($check_modes as $key=>$value){
					if($count == 0) {
						echo '<tr>';
					}
					echo '<td class="checkmode">';
					echo $this->Form->input('check_modes.'.$key, 
						array('type'=>'checkbox','hiddenField'=>false, 'value'=>$key, 'class'=>'checkmode')
						);
					echo $value;
					echo '</td>';
					$count++;
					if($count>3){
						echo '</tr>';
						$count = 0;
					}
				}
				
			?>
				</table>
			</td>
		</tr>		
		<tr>
			<td class="input_label">樣品溫濕度</td>
			<td><label>
				<?php 
					echo $this->Form->radio('humiture', $humitures, 
							array('empty'=>false,'legend' => false,'hiddenField'=>false,'label'=>false,
								'separator'=>'</label>    <label>'
								)
						);
				?>
				</label>
			</td>
		</tr>
		<tr>
			<td class="input_label">說明：(最多30個中文字)</td>
			<td><?php echo $this->Form->textarea('remark',array('cols'=>'30','rows'=>'3'));?></td>
		</tr>									
		<tr>
			<td colspan=2><?php echo $this->Form->submit('儲存');?></td>
		</tr>
	</table>
<?php echo $this->Form->end(); ?>