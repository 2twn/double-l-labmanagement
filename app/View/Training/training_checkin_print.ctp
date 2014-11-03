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
<div class="pageheader_div">
	<h1 id="pageheader">教育訓練簽到表</h1>
</div>
<div class="pagemenu_div">
<?php
echo $this->Html->link ( '回教育訓練列表', array (
		'controller' => 'training',
		'action' => 'training_list' 
), array (
		'class' => 'button' 
) );
echo '&nbsp;';
echo $this->Html->link ( '列印', 'javascript:printDiv("print_area");', array (
		'class' => 'button' 
) );
?>
</div>
<div id="print_area" style="background-color: white;">
	<STYLE TYPE="text/css">
.tb_border {
	border: 1px solid;
	padding: 0px;
	height: 30px
}

.tb_blank {
	border: 1px solid;
	padding: 0px;
	height: 30px;
	border:none;
	background-color:#FFFFFF;
}
</STYLE>
	<table style="width: 800px;">
		<tr>
			<td colspan="3" class="tb_border">代號:<?php echo $training['Training']['id']; ?></td>
		</tr>
		<tr class="tb_border">
			<td colspan="3" class="tb_border">授課人員：<?php echo $training['Training']['instructor']; ?>
			
			</th>
		</tr>
		<tr class="tb_border">
			<td class="tb_border">地點:<?php echo $training['MeetingRoom']['mr_name']; ?>
			
			</th>
			<td class="tb_border">日期:<?php echo substr($training['Training']['start_time'],0,10); ?></td>
			<td class="tb_border">時間:<?php echo substr($training['Training']['start_time'],11,5); ?>~<?php echo substr($training['Training']['end_time'],11,5); ?></td>
		</tr>
		<tr class="tb_border">
			<td class="tb_border" colspan=3>文件列表</td>
		</tr>
    <?php
				$introw = 0;
				foreach ( $doc_items as $doc_item ) :
					?>
    <tr class="tb_border">
			<td class="tb_border" colspan=3> <?php echo $doc_item["TrainingDocument"]["TrainingDocument"]["doc_code"]."-".$doc_item["TrainingDocument"]["TrainingDocument"]["document_name"]; ?></td>
		</tr>
    <?php
					$introw ++;
				endforeach
				;
				?>
    	<?php for($i=$introw;$i<32;$i++): ?>
    	    <tr class="tb_blank">
			<td class="tb_blank" colspan=3></td>
		</tr>
    	<?php  endfor;?>
    </table>
	<table style="width: 800px;">
		<tr>
			<td colspan="5" class="tb_border">代號:<?php echo $training['Training']['id']; ?></td>
		</tr>
		<tr class="tb_border">
			<td colspan="5" class="tb_border">授課人員：<?php echo $training['Training']['instructor']; ?>
			
			</th>
		</tr>
		<tr style="height: 30px">
			<th style="width: 100px" class="tb_border">部門</th>
			<th style="width: 100px" class="tb_border">員工編號</th>
			<th style="width: 150px" class="tb_border">姓名</th>
			<th class="tb_border">簽名</th>
			<th style="width: 250px" class="tb_border">評核結果</th>
		</tr>
    <?php $i=0; ?>
    <?php foreach ($items as $item): ?>
    <tr style="height: 60px">
			<td class="tb_border">
            <?php echo $item['Department']['dep_name']; ?>
        </td>
			<td class="tb_border">
            <?php echo $item['User']['username']; ?>
        </td>
			<td class="tb_border">
            <?php echo $item['User']['name']; ?>
        </td>
			<td class="tb_border">&nbsp;</td>
			<td class="tb_border">□合格(Pass)&nbsp;□不合格(Fail)&nbsp;□N/A</td>
		</tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>
</div>
