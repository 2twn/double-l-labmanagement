<script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練列表</h1></div>
<div class="pagemenu_div"><?php 
  	//echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增教育訓練', array('action' => 'training_edit'), array('class' => 'button')); ?>
</div>
<?php echo $this->Form->create('Training', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table>
    <tr>
    	<th></th>
        <th>
		<?php echo $this->Form->text('search_start_date', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date', 'readonly'=>true, 'size'=>8, 'style'=>'width:150px'));?>
       	</th>
       	<th colsapan=7>
        	<?php echo $this->Form->submit('搜尋');?>
        </th>
    </tr>
    <tr>
        <th class="text10">代號</th>
        <th class="date">上課日期</th>
        <th class="text10">開始時間</th>
        <th class="text10">結束時間</th>
        <th class="text20">上課地點</th>
        <th class="text20">授課人員</th>
        <th class="text10">上課人數</th>
        <th class="state">有效</th>
        <th></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Training']['id']; ?></td>
        <td>
            <?php echo substr($item['Training']['start_time'],0,10); ?>
        </td>
        <td>
            <?php echo substr($item['Training']['start_time'],11,5); ?>
        </td>
        <td>
            <?php echo substr($item['Training']['end_time'],11,5); ?>
        </td>
        <td>
            <?php echo $item['MeetingRoom']['mr_name']; ?>
        </td>
        <td>
            <?php echo $item['Training']['instructor']; ?>
        </td>
        <td>
            <?php echo sizeof($item['TrainingUser']); ?>
        </td>
        <td>
            <?php if ($item['Training']['valid']) { echo 'Y'; } else {echo 'N';}; ?>
        </td>
        <td><div style="width:130px;margin:0px;padding:0px;clear:none">
            <?php 
				$delbtn = '生效';
				if ($item['Training']['valid']) {
					echo '<div style="float:left;width:50px;margin:0px;padding:6px;clear:none">'
                                             .$this->Html->link('修改', array('action' => 'training_edit', $item['Training']['id']), array('class' => 'button'))
                                             .'</div>';
					//echo '&nbsp';
					echo '<div style="float:left;width:50px;margin:0px;padding:6px;clear:none">'
                                             .$this->Html->link('通知', array('action' => 'training_checkin_send', $item['Training']['id']), array('class' => 'button'))
                                             .'</div>';
					//echo '&nbsp';
					echo '<div style="float:left;width:50px;margin:0px;padding:6px;clear:none">'
                                             .$this->Html->link('列印', array('action' => 'training_checkin_print', $item['Training']['id']), array('class' => 'button'))
                                             .'</div>';;
					//echo '&nbsp';
					echo '<div style="float:left;width:50px;margin:0px;padding:6px;clear:none">'
                                             .$this->Html->link('出席', array('action' => 'training_checkin', $item['Training']['id']), array('class' => 'button'))
                                             .'</div>';;
					//echo '&nbsp';
					$delbtn = '失效';
				}
				echo '<div style="float:left;width:50px;margin:0px;padding:6px;clear:none">'
                                     .$this->Html->link(
							$delbtn,
							array('action' => 'training_del', $item['Training']['id']),
							array('class'=>'button'),'確認變更?')
                                     .'</div>';;
            ?>
	</div>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="10">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
<?php echo $this->Form->end(); ?>
