<div class="pageheader_div"><h1 id="pageheader">文件列表</h1></div>
<div class="pagemenu_div"><?php 
  	//echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
</div>
<table>
	<tr>
		<td>人員姓名</td><td><?php if (!empty($items)) { echo $items[0]['User']['name'];  }?></td>
	</tr>
</table>
<table>
	<tr>
        <th>文件編號</th>
        <th>文件名稱</th>
		<th>文件版本</th>
        <th>建立時間</th>
        <th>狀態</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Doc_Info']['doc_code']; ?></td>
        <td>
            <?php echo $item['Doc_Info']['document_name']; ?>
        </td>
        <td>
            <?php echo $item['Doc_Info']['document_version']; ?>
        </td>
        <td>
            <?php echo $item['Doc_Info']['create_time']; ?>
        </td>
        <td>
            <?php echo $checkins[$item['TrainingUser']['checkin']]; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
