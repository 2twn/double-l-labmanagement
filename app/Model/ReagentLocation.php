<?php
class ReagentLocation extends AppModel {
    public $name = 'ReagentLocation';

	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>