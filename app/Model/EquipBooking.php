<?php
class EquipBooking extends AppModel {
    public $name = 'EquipBooking';
	public $belongsTo = array('Equip','Project');
    public $validate = array(
        'equip_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '儀器編號不可空白'
            ),
		),
        'project_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '專案編號不可空白'
            ),
		),
        'booking_desc' => array(
			'maxLength' => array(
                'rule'    => array('maxLength', 60),
                'message' => '簡述不可超過30字元'
            )
        ),
    );

}
?>