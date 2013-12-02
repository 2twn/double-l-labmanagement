<?php
class Equipment extends AppModel {
    public $name = 'Equipment';
	public $useTable = 'equipments';
    public $validate = array(
        'equip_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Equipment name is required'
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
?>