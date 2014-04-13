<div class="pageheader_div"><h1 id="pageheader">人員資料列表</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('文件列表', "documsnt_list", array('class' => 'button')); 
  	echo "&nbsp";
  	echo $this->Html->link('訓練列表', "training_list", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
</div>
<?php echo $this->Form->create('User', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); ?>
<table>
    <tr>
    	<th></th>
        <th>
       	<?php echo $this->Form->text('search_name', array('style'=>'width:150px'));?>
       	</th>
       	<th colspan=3>
        	<?php echo $this->Form->submit('搜尋');?>
        </th>
    </tr>
    <tr>
        <th>員工編號</th>
        <th>人員姓名</th>
        <th>登入名稱</th>
        <th>電子郵件</th>
        <th></th>
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