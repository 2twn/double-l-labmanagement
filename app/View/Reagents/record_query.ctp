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
<?php
    echo $this->Form->create('ReagentRecord', array('div'=>false, 'inputDefaults' => array('label' => false,'div' => false))); 
    echo "From";
    echo $this->Form->text('from', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date',  'size'=>8, 'style'=>'width:150px'));
    echo "To";
    echo $this->Form->text('to', array('dateFormat' => 'Y-M-D', 'class' =>'jquery_date',  'size'=>8, 'style'=>'width:150px'));
    echo $this->Form->submit('查詢', array('div'=>false));
?>
</div>
<table class="fixreport">
    <tr>
        <th class="text20">試藥編號</th>
        <th class="text20">試藥名稱</th>
        <th class="text20">儲存位置</th>
        <th class="text20">製造商</th>
        <th class="text20">包裝</th>
        <th class="text20">原廠批號</th>
        <th class="date">登錄日期</th>
        <th class="date">有效日期</th>
        <th class="date">開封日期</th>
        <th class="date">使用期限</th>      
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
