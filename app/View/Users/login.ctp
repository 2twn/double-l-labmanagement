<table>
<tr><td width='300px'>
<?php echo $this->Html->image('TLC_Color.jpg', array('alt' => 'TLC Lab Management', 'border' => '0'));?>
</td>
<td>
<?php echo $this->Html->image('tlc_login.gif', array('alt' => 'TLC Lab Management', 'border' => '0'));?>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('請輸入你的帳號與密碼'); ?></legend>
    <?php
        echo $this->Form->input('username', array('label'=>'帳號'));
        echo $this->Form->input('password', array('label'=>'密碼'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</td>
</tr></table>
