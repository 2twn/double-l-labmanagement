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
    	'dep_code' => array(
    		'required' => array(
    			'rule' => array('notEmpty'),
    			'message' => 'A Departmrnt code is required'
    		)
    	),    
				
    );
}
?>