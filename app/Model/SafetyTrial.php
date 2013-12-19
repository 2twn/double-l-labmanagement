<?php
class SafetyTrial extends AppModel {
    public $name = 'SafetyTrial';
    public $belongsTo = array(
    		'Project' => array(
            	'className' => 'Project',
            	'foreignKey' => 'project_id'),
        );
    public $validate = array(
    		'trial_lot' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '請填寫樣品批號'
    				)
    		),
    		'trial_name' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '請填寫樣品名稱'
    				)
    		),    		
    		'humiture' => array(
    				'required' => array(
    						'rule' => array('notEmpty'),
    						'message' => '請選擇溫濕度'
    				)
    		),
    );    
	public function beforeSave($options = array()) {

	}
}
?>