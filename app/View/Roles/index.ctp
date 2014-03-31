<div class="pageheader_div"><h1 id="pageheader">角色管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'edit'), array('class' => 'button')); ?>
</div>
<table>
    <tr>
        <th>名稱</th>   
        <th></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Role']['name']; ?></td>
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'edit', $item['Role']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<div align="center">
            <?php echo $this->Paginator->first('<<'); ?>
            <?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
            <?php echo $this->Paginator->last('>>'); ?>
</div>
