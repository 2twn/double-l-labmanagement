<style>
table.fixreport {
	table-layout:fixed;
    word-break:break-all;
    word-wrap:break-word;
}

th.command{
	width: 160px;
}
th.command1{
	width: 60px;
}
th.command2{
	width: 120px;
}
th.command3{
	width: 180px;
}
th.command4{
	width: 240px;
}
th.command5{
	width: 300px;
}
th.date  {
	width: 80px;
}

th.timestamp{
	width: 140px;
}

th.timestamp2{
	width: 100px;
}

th.state{
	width: 60px;
}
th.state1{
	width: 30px;
}
th.text5{
	width: 40px;
}
th.text10{
	width: 80px;	
}
th.text15{
	width: 120px;	
}
th.text20{
	width: 160px;	
}
th.text30{
	width: 240px;
}
th.text40{
	width: 320px;	
}
th.text50{
	width: 400px;	
}

table tr:nth-child(2n) {
	background-color:#BCBEC0;
}

th {
	border: 1px solid;
}

td {
	border: 1px solid;
}
</style>
<p>您好：</p>
<p></p>
<?php if (empty($items)): ?>
<p>無安定性試驗樣品到期提醒</p>
<?php else: ?>
<p>安定性試驗樣品到期提醒，詳請見下表</p>
<table class="fixreport">
    <tr>
        <th class="text20">表單編號</th>
        <th class="text20">樣品名稱</th>
        <th class="text30">溫濕度</th>
        <th class="state">批號</th>
        <th class="date">開始時間</th>
        <th class="text10">檢核週期</th>
        <th class="date">提醒時間</th>
        <th class="date">檢核時間</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <?php
        if($item['SafetyTrialCheckdate']['check_date'] == $sel_date) {
            echo "<tr style=\"background:#f2dbdb;\">";
        } else {
            echo "<tr>";
        }
    ?>
        <td><?php echo $item['SafetyTrial']['trial_lot']; ?></td>
        <td>
            <?php echo $item['SafetyTrial']['trial_name']; ?>
        </td>
        <td>
            <?php echo $humitures[$item['SafetyTrial']['humiture']];  ?>
        </td>
        <td>
             <?php echo $item['SafetyTrial']['remark'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['start_date'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrialCheckdate']['check_mode'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrialCheckdate']['remind_date'];  ?>
        </td>
         <td>
            <?php echo$item['SafetyTrialCheckdate']['check_date'];  ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
