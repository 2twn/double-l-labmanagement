<div class="pageheader_div"><h1 id="pageheader">文件列表</h1></div>
<div class="pagemenu_div"><?php 
  	//echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增文件', array('action' => 'document_edit'), array('class' => 'button')); ?>
</div>
<?php echo $this->Form->create('TrainingDocument', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table>
   <tr>
        <th>
        <?php echo $this->Form->text('search_doc_code', array('style'=>'width:150px'));?>
        </th>
        <th>
            <?php echo $this->Form->submit('搜尋');?>
        </th>
    </tr>
</table>
<table class="fixreport">
	<tr>
        <th class="text10">文件編號</th>
        <th class="text40">文件名稱</th>
		<th class="text10">文件版本</th>
        <th class="timestamp">建立時間</th>
        <th class="state1">狀態</th>
        <th class="command3"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['TrainingDocument']['doc_code']; ?></td>
        <td>
            <?php echo $item['TrainingDocument']['document_name']; ?>
        </td>
        <td>
            <?php echo $item['TrainingDocument']['document_version']; ?>
        </td>
        <td>
            <?php echo $item['TrainingDocument']['create_time']; ?>
        </td>
        <td>
            <?php echo $document_status[$item['TrainingDocument']['valid']]; ?>
        </td>
        <td>
            <?php 
				$delbtn = '生效';
				if ($item['TrainingDocument']['valid']) {
					echo $this->Html->link('修改', array('action' => 'document_edit', $item['TrainingDocument']['id']), array('class' => 'button'));
					$delbtn = '失效';
					echo '&nbsp';
				}
				echo $this->Form->postLink(
				$delbtn,
				array('action' => 'document_del', $item['TrainingDocument']['id']),
				array('class'=>'button','confirm' => '確認變更?'));
				echo '&nbsp';
				echo $this->Html->link('訓練', array('action' => 'training_result_by_docid', $item['TrainingDocument']['id']), array('class' => 'button'));
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
<?php echo $this->Form->end(); ?>
