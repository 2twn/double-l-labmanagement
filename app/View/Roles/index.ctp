<div class="pageheader_div"><h1 id="pageheader">角色管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'edit'), array('class' => 'button')); ?>
</div>
<table class="fixreport">
    <tr>
        <th class="text20">名稱</th>   
        <th class="command2"></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Role']['name']; ?></td>
        <td class="command2">
            <?php 
				echo $this->Html->link('修改', array('action' => 'edit', $item['Role']['id']), array('class' => 'button'));
                echo $this->Html->link(
                    '刪除', array('action' => 'delete', $item['Role']['id']), 
                    array('class' => 'button'),
                    '你確定要刪除['.$item['Role']['name'].']角色'
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="2">
            <?php echo $this->Paginator->first('<<'); ?>
            <?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2)); ?>
            <?php echo $this->Paginator->last('>>'); ?>
        </th>
    </tr>
</table>

