<?php
class Reagent extends AppModel {
    public $name = 'Reagent';
    public $belongsTo = 'Chemical';
    public $validate = array(
    		'id' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '試藥代號請勿空白'
    				)
    		),
    		'name' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '試藥名稱請勿空白'
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