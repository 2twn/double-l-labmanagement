<?php
class EquipBooking extends AppModel {
    public $name = 'EquipBooking';
    public $validate = array(
        'equipment_id' => array(
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
			'between' => array(
                'rule'    => array('maxLength', 60),
                'message' => '簡述不可超過30字元'
            )
        ),
    );
	
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
	public $belongsTo = 'Equipment';
	public $belongsTo = 'Project';
	public $belongsTo = 'User';
}
?>