 <script>
    $(function() {
        $(".jquery_date" ).datepicker({dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});
        $( "#ReagentRecordFrom" ).datepicker({
//            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
                $( "#ReagentRecordTo" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#ReagentRecordTo" ).datepicker({
  //          defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            onClose: function( selectedDate ) {
                $( "#ReagentRecordFrom" ).datepicker( "option", "maxDate", selectedDate );
            }
        });        
    });
</script>
<div class="pageheader_div"><h1 id="pageheader">試藥使用期限查詢</h1></div>
<div class="pagemenu_div"><?php 
  	echo $this->Html->link('回上一頁', "javascript:history.back();", array('class' => 'button')); 
?></div>
<div class="pagebtn_div">
<?php echo $this->Html->link('新增', array('action' => 'record_edit'), array('class' => 'button')); ?>
<?php
    echo $this->Form->create('ReagentRecord', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
    echo "From";
    echo $this->Form->text('from', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date',  'size'=>8, 'style'=>'width:150px'));
    echo "To";
    echo $this->Form->text('to', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date',  'size'=>8, 'style'=>'width:150px'));
    echo $this->Form->submit('查詢', array('div'=>false));
?>
</div>
<table>
    <tr>
        <th>試藥編號</th>
        <th>試藥名稱</th>
        <th>儲存位置</th>
        <th>製造商</th>
        <th>包裝</th>
        <th>原廠批號</th>
        <th>登錄日期</th>
        <th>有效日期</th>
        <th>開封日期</th>
        <th>使用期限</th>
        <th>建立時間</th>        
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['ReagentRecord']['id']; ?></td>
        <td><?php echo $item['ReagentRecord']['name']; ?></td>
        <td><?php echo $item['ReagentLocation']['name']; ?></td>
        <td><?php echo $item['Company']['name']; ?></td>
        <td><?php echo $item['ReagentRecord']['package']; ?></td>
        <td><?php echo $item['ReagentRecord']['lot']; ?></td>
        <td><?php echo $item['ReagentRecord']['record_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['valid_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['open_date']; ?></td>
        <td><?php echo $item['ReagentRecord']['usage']; ?></td>
        <td><?php echo $item['ReagentRecord']['create_time']; ?></td>        
    </tr>
    <?php endforeach; ?>
	<tr>
	    <td colspan="13">
			<?php echo $this->Paginator->first('<<'); ?>
			<?php echo $this->Paginator->numbers(); ?>
			<?php echo $this->Paginator->last('>>'); ?>
		</td>
    </tr>
</table>
