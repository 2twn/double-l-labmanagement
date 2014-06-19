 
<h2>試藥使用期限到期清單（<?php echo $sel_date;?>）</h2>
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
        <!-- <th>建立時間</th>       -->  
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
        <!-- <td><?php echo $item['ReagentRecord']['create_time']; ?></td>     -->    
    </tr>
    <?php endforeach; ?>
</table>
