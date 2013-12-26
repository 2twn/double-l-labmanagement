<div class="pageheader_div"><h1 id="pageheader">教育訓練列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
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
        <th><?php echo $this->Html->link('新增教育訓練', array('action' => 'training_edit'), array('class' => 'button')); ?></th>
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
        <td>
            <?php echo $item['Training']['create_time']; ?>
        </td>
        <td>
            <?php 
				$delbtn = '生效';
				if ($item['Training']['valid']) {
					echo $this->Html->link('修改', array('action' => 'training_edit', $item['Training']['id']), array('class' => 'button'));
					$delbtn = '失效';
					echo '&nbsp';
				}
				echo $this->Form->postLink(
				$delbtn,
				array('action' => 'training_del', $item['Training']['id']),
				array('class'=>'button','confirm' => '確認變更?'));
            ?>
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
