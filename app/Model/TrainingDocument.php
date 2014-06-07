<?php
class TrainingDocument extends AppModel {
    public $name = 'TrainingDocument';
    public $validate = array(
        'doc_code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '文件編號不可空白'
            ),
			'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => '文件編號必須是英數字元'
            ),
			'maxLength' => array(
                'rule'    => array('maxLength', '16'),
                'message' => '文件編號不可超過16字元'
            )
		),
        'document_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => '名稱不可空白'
            ),
			'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => '名稱必須是英數字元'
            ),
			'maxLength' => array(
                'rule'    => array('maxLength', '30'),
                'message' => '名稱不可超過30字元'
            )
        ),		
    );
}
?>