<?php
class TrainingUser extends AppModel {
    public $name = 'TrainingUser';
	public $belongsTo = array(
    		'User' => array(
            	'className' => 'User',
            	'foreignKey' => 'user_id'),
        );
	
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>