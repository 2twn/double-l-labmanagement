<?php
class Reagent extends AppModel {
    public $name = 'Reagent';
    public $belongsTo = 'Chemical';
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>