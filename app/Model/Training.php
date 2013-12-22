<?php
class Training extends AppModel {
    public $name = 'Training';
	public $belongsTo = array('MeetingRoom');
    public $validate = array();
}
?>