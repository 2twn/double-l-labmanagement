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
                'message' => '儀器編號不可空白'
            ),
		),
        'booking_desc' => array(
			'maxLength' => array(
                'rule'    => array('maxLength', 60),
                'message' => '簡述不可超過30字元'
            )
        ),
    );
	
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date('Y-m-d H:i:s');
		}
		return true;
	};
	
}
?>