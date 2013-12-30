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
}
?>