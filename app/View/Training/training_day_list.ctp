<h2>教育訓練列表（日期：<?php echo $sel_date;?>）</h2>
<table>
    <tr>
        <th class="text10">代號</th>
        <th class="date">上課日期</th>
        <th class="text10">開始時間</th>
        <th class="text10">結束時間</th>
        <th class="text20">上課地點</th>
        <th class="text20">授課人員</th>
        <th class="text10">上課人數</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Training']['id']; ?></td>
        <td>
            <?php echo substr($item['Training']['start_time'],0,10); ?>
        </td>
        <td>
            <?php echo substr($item['Training']['start_time'],11,5); ?>
        </td>
        <td>
            <?php echo substr($item['Training']['end_time'],11,5); ?>
        </td>
        <td>
            <?php echo $item['MeetingRoom']['mr_name']; ?>
        </td>
        <td>
            <?php echo $item['Training']['instructor']; ?>
        </td>
        <td>
            <?php echo sizeof($item['TrainingUser']); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($items)): ?>
    <tr>
        <td colspan=7>沒有訓練資料</td>
    </tr>
    <?php endif; ?>
</table>
