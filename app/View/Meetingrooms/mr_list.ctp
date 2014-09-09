<div class="pageheader_div"><h1 id="pageheader">會議室資料列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增會議室', array('action' => 'mr_edit'), array('class' => 'button')); ?>
</div>
<table class="fixreport">
    <tr>
        <th class="text20">會議室名稱</th>
        <th class="text10">容納人數</th>
        <th class="state">有效</th>
        <th class="timestamp">建立時間</th>
        <th class="command2"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?php echo $item['MeetingRoom']['mr_name']; ?>
        </td>
        <td>
            <?php echo $item['MeetingRoom']['mr_capacity']; ?>
        </td>
        <td>
            <?php if ($item['MeetingRoom']['valid']) { echo 'Y'; } else {echo 'N';}; ?>
        </td>
        <td>
            <?php echo $item['MeetingRoom']['create_time']; ?>
        </td>
        <td>
            <?php 
				$delbtn = '生效';
				if ($item['MeetingRoom']['valid']) {
					echo $this->Html->link('修改', array('action' => 'mr_edit', $item['MeetingRoom']['id']), array('class' => 'button'));
					$delbtn = '失效';
					echo '&nbsp';
				}
				echo $this->Form->postLink(
				$delbtn,
				array('action' => 'mr_del', $item['MeetingRoom']['id']),
				array('class'=>'button','confirm' => '確認變更?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="6">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
