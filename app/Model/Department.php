<?php
class Department extends AppModel {
    public $name = 'Department';
    public $validate = array(
        'dep_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Departmrnt name is required'
            )
        ),  		
    );
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
