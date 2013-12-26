<?php
class Training extends AppModel {
    public $name = 'Training';
	public $belongsTo = array('MeetingRoom');
	public $hasMany = array('TrainingWDocument' => array(	'className' => 'TrainingWDocument',
															'foreignKey' => 'training_id',
												//            'conditions' => array('Comment.status' => '1'),
												//            'order' => 'Comment.created DESC',
												//            'limit' => '5',
												//            'dependent' => true
												),
							'TrainingUser' => array(	'className' => 'TrainingUser',
															'foreignKey' => 'training_id',
												//            'conditions' => array('Comment.status' => '1'),
												//            'order' => 'Comment.created DESC',
												//            'limit' => '5',
												//            'dependent' => true
												),
						);
    public $validate = array();
}
?>