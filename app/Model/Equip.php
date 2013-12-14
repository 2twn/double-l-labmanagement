<?php
class Equip extends AppModel {
    public $name = 'Equip';
    public $validate = array(
        'id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '儀器編號不可空白'
            ),
			'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => '儀器編號必須是英數字元'
            ),
			'maxLength' => array(
                'rule'    => array('maxLength', '8'),
                'message' => '儀器編號不可超過8字元'
            )
		),
        'equip_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '儀器名稱不可空白'
            ),
			'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => '儀器名稱必須是英數字元'
            ),
			'maxLength' => array(
                'rule'    => array('maxLength', '30'),
                'message' => '儀器名稱不可超過30字元'
            )
        ),
        'location' => array(
			'maxLength' => array(
                'rule'    => array('maxLength', '60'),
                'message' => '儀器名稱不可超過30中文字元'
            )
        ),
        'equip_desc' => array(
			'between' => array(
                'rule'    => array('maxLength', '60'),
                'message' => '儀器名稱不可超過30中文字元'
            )
        ),  		
    );
	public function beforeSave($options = array()) {
		if (!isset($this->data[$this->alias]['id'])) {
			$this->data[$this->alias]['create_time'] = date();
		}
		return true;
	}
}
?>