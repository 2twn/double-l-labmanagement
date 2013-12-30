<script>
	function check_all() {
		var e = $("#TrainingUserCheckAll")[0].checked;
        $(".checkin_box > input[type=checkbox]").each(function(){               
            this.checked = e;
        });
	}
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回教育訓練列表', array('controller'=>'training', 'action' =>'training_list'), array('class' => 'button')); 
?></div>
<table>
    <tr>
        <th>代號</th>
        <th>上課日期</th>
        <th>開始時間</th>
        <th>結束時間</th>
        <th>上課地點</th>
        <th>授課人員</th>
        <th>上課人數</th>
        <th>有效</th>
        <th>建立時間</th>
    </tr>
    <tr>
        <td><?php echo $training['Training']['id']; ?></td>
        <td>
            <?php echo substr($training['Training']['start_time'],0,10); ?>
        </td>
        <td>
            <?php echo substr($training['Training']['start_time'],11,5); ?>
        </td>
        <td>
            <?php echo substr($training['Training']['end_time'],11,5); ?>
        </td>
        <td>
            <?php echo $training['MeetingRoom']['mr_name']; ?>
        </td>
        <td>
            <?php echo $training['Training']['instructor']; ?>
        </td>
        <td>
            <?php echo sizeof($training['TrainingUser']); ?>
        </td>
        <td>
            <?php if ($training['Training']['valid']) { echo 'Y'; } else {echo 'N';}; ?>
        </td>
        <td>
            <?php echo $training['Training']['create_time']; ?>
        </td>
    </tr>
</table>
<?php echo $this->Form->create('TrainingUser', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table>
    <tr>
        <th>上課學員</th>
        <th><?php echo $this->Form->checkbox('checkAll', array('onchange'=>'check_all()'));?></th>
    </tr>
    <?php $i=0; ?>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?php echo $item['User']['name']; ?>
        </td>
        <td class="checkin_box">
			<?php echo $this->Form->hidden($i.'.id',array('value'=>$item['TrainingUser']['id'])); ?>
			<?php
				if ($item['TrainingUser']['checkin']) {
					echo $this->Form->checkbox($i.'.checkin', array('checked'));
				} else {
					echo $this->Form->checkbox($i.'.checkin', array());
				}
			?>
		</td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
	<td colspan=2>
		<?php echo $this->Form->submit('儲存');?>
	</td>
</table>
<?php echo $this->Form->end(); ?>