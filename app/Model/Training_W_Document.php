<?php
class TrainingWDocument extends AppModel {
    public $name = 'TrainingWDocument';

	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>