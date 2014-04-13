<script>
	function check_all() {
		var e = $("#TrainingUserCheckAll")[0].checked;
        $(".checkin_box > input[type=checkbox]").each(function(){               
            this.checked = e;
        });
	}
	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;
		 document.body.innerHTML = printContents;
		 body_style = document.body.style;
		 document.body.style = "background-color:white";
		 window.print();
		 document.body.style = body_style;
		 document.body.innerHTML = originalContents;
	}
</script>
<div class="pageheader_div"><h1 id="pageheader">教育訓練結果</h1></div>
<div class="pagemenu_div">
<?php 
  	echo $this->Html->link('回文件列表', array('controller'=>'training', 'action' =>'document_list'), array('class' => 'button'));
//  	echo '&nbsp;';
//  	echo $this->Html->link('列印', 'javascript:printDiv("print_area");', array('class' => 'button')); 
?>
</div>
<div id="print_area" style="background-color:white;">
<STYLE TYPE="text/css">
	.tb_border { 
		border: 1px solid;
		padding: 0px; 
	}
	</STYLE> 
<?php foreach($results as $result): ?>
<table style="width:800px;">
    <?php foreach ($result['doc'] as $doc): ?>
    <tr>
        <td class="tb_border">代號:<?php echo $doc['Doc']['id']; ?></td>
        <td class="tb_border">文件名稱：<?php echo $doc['Doc']['document_name']." (version:".$doc['Doc']['document_version'].")"; ?></th>
    </tr>
    <?php endforeach;?>
</table>
<?php $training = $result['training'];?>
<table style="width:800px;">
    <tr>
        <td colspan="3" class="tb_border">代號:<?php echo $training['Training']['id']; ?></td>
    </tr>
    <tr class="tb_border">
        <td colspan="3" class="tb_border">授課人員：<?php echo $training['Training']['instructor']; ?></th>
    </tr>
    <tr class="tb_border">
        <td class="tb_border">地點:<?php echo $training['MeetingRoom']['mr_name']; ?></th>
        <td class="tb_border">日期:<?php echo substr($training['Training']['start_time'],0,10); ?></td>
        <td class="tb_border">時間:<?php echo substr($training['Training']['start_time'],11,5); ?>~<?php echo substr($training['Training']['end_time'],11,5); ?></td>
    </tr>
</table>
<?php $items = $result['items'];?>
<table style="width:800px;">
    <tr>
        <th style="width:100px" class="tb_border">部門</th>
        <th style="width:100px" class="tb_border">員工編號</th>
        <th style="width:150px" class="tb_border">姓名</th>
        <th style="width:250px" class="tb_border">評核結果</th>
    </tr>
    <?php $i=0; ?>
    <?php foreach ($items as $item): ?>
    <tr>
        <td class="tb_border">
            <?php echo $item['Department']['dep_name']; ?>
        </td>
        <td class="tb_border">
            <?php echo $item['User']['username']; ?>
        </td>
        <td class="tb_border">
            <?php echo $item['User']['name']; ?>
        </td>
        <td class="tb_border"><?php echo $checkins[$item['TrainingUser']["checkin"]]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
<?php endforeach;?>
</table>
</div>
