<?php
class MeetingRoom extends AppModel {
    public $name = 'MeetingRoom';
    public $validate = array(
        'mr_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Meeting Room name is required'
            )
        ),  		
        'mr_capacity' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Meeting Room capacity is required'
            ),
			'Decimal' => array(
                'rule' => array('decimal'),
                'message' => 'A Meeting Room capacity is decimal'
            )
        ),  		
    );
}
?>