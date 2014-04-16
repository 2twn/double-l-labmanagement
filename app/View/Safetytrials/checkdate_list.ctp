<h2>安定性樣品檢驗時間到期清單（<?php echo $sel_date;?>）</h2>
<table>
    <tr>
        <th>樣品批號</th>
        <th>樣品名稱</th>
        <th>所屬專案</th>
        <th>狀態</th>
        <th>樣品時間</th>
        <th>儲存位置</th>
        <th>檢核週期</th>
        <th>檢核時間</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['SafetyTrial']['trial_lot']; ?></td>
        <td>
            <?php echo $item['SafetyTrial']['trial_name']; ?>
        </td>
        <td>
            <?php echo $item['SafetyTrial']['Project']['prj_name'];  ?>
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
            <?php echo $item['SafetyTrialCheckdate']['check_date'];  ?>
        </td>                  
    </tr>
    <?php endforeach; ?>
</table>
