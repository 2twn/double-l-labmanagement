<?php
class SystemsController extends AppController {
	public $uses = array('SystemLog');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session', 'Formfunc', 'Userfunc');
	public $paginate = array('limit' => 10,);             

 	public function log_list() {
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('id' =>'desc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('SystemLog'));
    }
}
?>