<p>您好：</p>
<p></p>
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
            <?php echo $item['SafetyTrial']['humiture'];  ?>
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
            <?php echo $sel_date;  ?>
        </td>     
         <td>
            <?php echo$item['SafetyTrialCheckdate']['check_date'];  ?>
        </td>            
    </tr>
    <?php endforeach; ?>
</table>