<div class="pageheader_div"><h1 id="pageheader">化學名稱管理</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'chemical_edit'), array('class' => 'button')); ?>
</div>
<table>
    <tr>
        <th class="text20">代號</th>
        <th class="text40">名稱</th>
		<th class="text20">CAS#</th>
		<th>別名一</th>
        <th>別名二</th>
        <th class="state1">有效</th>
        <th class="timestamp">建立時間</th>        
        <th></th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Chemical']['id']; ?></td>
        <td>
            <?php echo $item['Chemical']['name']; ?>
        </td>
        <td>
            <?php echo $item['Chemical']['cas']; ?>
        </td>
        <td>
            <?php echo $item['Chemical']['alias_name1']; ?>
        </td>
        <td>
            <?php echo $item['Chemical']['alias_name2']; ?>
        </td>    
        <td>
            <?php echo $status[$item['Chemical']['status']]; ?>
        </td>
        <td>
            <?php echo $item['Chemical']['create_time']; ?>
        </td>        
        <td>
            <?php 
				echo $this->Html->link('修改', array('action' => 'chemical_edit', $item['Chemical']['id']), array('class' => 'button'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
