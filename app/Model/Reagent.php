<?php
class Reagent extends AppModel {
    public $name = 'Reagent';
    public $belongsTo = 'Chemical';
    public $validate = array(
    		'id' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '試藥代號請勿空白'
    				),			
    				'maxLength' => array(
                		'rule'    => array('maxLength', '20'),
                		'message' => '試藥代號不可超過20字元'
            		),
    				'unique' => array(
    					'rule'    => 'isUnique',
    					'message' => '試藥代號不可重複'
    				),
    		),
    		'name' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '試藥名稱請勿空白'
    				),
    				'maxLength' => array(
    						'rule'    => array('maxLength', '40'),
    						'message' => '試藥名稱不可超過40字元'
    				),
    		),    		

    );    
	public function beforeSave($options = array()) {
		parent::beforeSave();
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>