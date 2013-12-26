<?php
class ReagentRecord extends AppModel {
    public $name = 'ReagentRecord';
    public $belongsTo = array('Company','ReagentLocation');
	
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>