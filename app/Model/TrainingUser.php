<?php
class TrainingUser extends AppModel {
    public $name = 'TrainingUser';
	public $belongsTo = array(
    		'User' => array(
            	'className' => 'User',
            	'foreignKey' => 'user_id'),
        );
}
?>