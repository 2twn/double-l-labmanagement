<h2>安定性樣品檢核時間到期清單（<?php echo $sel_date;?>）</h2>
<table class="fixreport">
    <tr>
        <th class="text20">表單編號</th>
        <th class="text20">樣品名稱</th>
        <th class="text30">專案代碼</th>
        <th class="state">狀態</th>
        <th class="date">開始時間</th>
        <th class="text20">儲存位置</th>
        <th class="text10">檢核週期</th>
        <th class="date">提醒時間</th>
        <th class="date">檢核時間</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['SafetyTrial']['trial_lot']; ?></td>
        <td>
            <?php echo $item['SafetyTrial']['trial_name']; ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['Project']['prj_code'];  ?>
        </td>
        <td>
            <?php echo $trial_status[$item['SafetyTrial']['status']];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['start_date'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['location'];  ?>
        </td>   
        <td>
            <?php echo $item['SafetyTrialCheckdate']['check_mode'];  ?>
        </td>
        <td>
            <?php echo $item['SafetyTrialCheckdate']['remind_date'];  ?>
        </td>               
        <td>
            <?php echo $item['SafetyTrialCheckdate']['check_date'];  ?>
        </td>                  
    </tr>
    <?php endforeach; ?>
</table>
