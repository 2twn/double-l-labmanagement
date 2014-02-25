<?php
class User extends AppModel {
    public $name = 'User';
	public $useTable = 'users';
    public $validate = array(
        'username' => array(
				'alphaNumeric' => array(
					'rule'     => 'alphaNumeric',
					'required' => true,
					'message'  => '只可是英數',
				),
				'between' => array(
					'rule'    => array('between', 2, 20),
					'message' => '長度在2-20字元',
				),
				'unique' => array(
					'rule' => 'isUnique',
					'required' => 'create',
					'message' => '人員帳號使用者重複',
				)
        ),
    	'name' => array(
    		'valid' => array(
    		'rule' => array('notEmpty'),
    		'message' => 'Please enter a name',
    		)
    	), 
    	'email' => array(
    		'valid' => array(
    		'rule' => array('email'),
    		'message' => 'Please enter a valid email',
    		)
    	),      		
    );
	public $belongsTo = 'Department';
}
?>