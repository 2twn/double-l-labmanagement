<?php
class Company extends AppModel {
    public $name = 'Company';

	public function beforeSave($options = array()) {

		return true;
	}
}
?>