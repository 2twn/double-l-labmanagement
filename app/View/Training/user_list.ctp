<div class="pageheader_div"><h1 id="pageheader">使用者文件查詢</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('文件列表', "document_list", array('class' => 'button')); 
  	echo "&nbsp";
  	echo $this->Html->link('訓練列表', "training_list", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
</div>
<?php echo $this->Form->create('User', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table style="width:400px">
    <tr>
    	<th>人員姓名</th>
        <th>
       	<?php echo $this->Form->text('search_name', array('style'=>'width:150px'));?>
       	</th>
       	<th colspan=3>
        	<?php echo $this->Form->submit('搜尋');?>
        </th>
    </tr>
</table>
<table>
    <tr>
        <th class="text10">員工編號</th>
        <th class="text20">人員姓名</th>
        <th class="text20">登入名稱</th>
        <th class="text30">電子郵件</th>
        <th class="command"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['User']['employee_id']; ?></td>
        <td>
            <?php echo $item['User']['name']; ?>
        </td>
        <td>
            <?php echo $item['User']['username']; ?>
        </td>
        <td>
            <?php echo $item['User']['email']; ?>
        </td>
        <td>
            <?php echo $this->Html->link('文件列表', array('action' => 'user_doc_list', $item['User']['id']), array('class' => 'button')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
	    <td colspan="5">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
<?php echo $this->Form->end(); ?>