<?php
class Project extends AppModel {
    public $name = 'Project';
    public $validate = array(
        'id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Project code is required'
            )
        ),  		
        'prj_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Project name is required'
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
