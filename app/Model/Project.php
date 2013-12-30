<?php
class Project extends AppModel {
    public $name = 'Project';
    public $validate = array(
        'id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Project code is required'
            ),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'on' => 'create',
                'message' => 'A Project code are existed'
			)
        ),  		
        'prj_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Project name is required'
            )
        ),  		
    );
}
?>