<script>
	function check_all() {
		var e = $("#TrainingUserCheckAll")[0].checked;
        $(".checkin_box > input[type=checkbox]").each(function(){               
            this.checked = e;
        });
	}
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練簽到表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回教育訓練列表', array('controller'=>'training', 'action' =>'training_list'), array('class' => 'button')); 
?></div>
<div id="print_area">
<table style="width:800px">
    <tr>
        <td colspan="3">代號:<?php echo $training['Training']['id']; ?></td>
    </tr>
    <tr>
        <td colspan="3">訓練類別:</td>
    </tr>
    <tr>
        <td colspan="3">授課人員：<?php echo $training['Training']['instructor']; ?></th>
    </tr>
    <tr>
        <td>地點:<?php echo $training['MeetingRoom']['mr_name']; ?></th>
        <td>日期:<?php echo substr($training['Training']['start_time'],0,10); ?></td>
        <td>時間:<?php echo substr($training['Training']['start_time'],11,5); ?>~<?php echo substr($training['Training']['end_time'],11,5); ?></td>
    </tr>
</table>
<?php echo $this->Form->create('TrainingUser', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table style="width:800px">
    <tr>
        <th>部門</th>
        <th>工號</th>
        <th>姓名</th>
        <th>簽名</th>
        <th>評核結果</th>
    </tr>
    <?php $i=0; ?>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?php echo $item['Department']['dep_name']; ?>
        </td>
        <td>
            <?php echo $item['User']['username']; ?>
        </td>
        <td>
            <?php echo $item['User']['name']; ?>
        </td>
        <td></td>
        <td>合格(Pass) 不合格(Fail) N/A</td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
	<td colspan=2>
		<?php echo $this->Form->submit('儲存');?>
	</td>
</table>
<?php echo $this->Form->end(); ?>