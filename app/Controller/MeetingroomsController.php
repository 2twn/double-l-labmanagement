<?php
class MeetingroomsController extends AppController {
	public $uses = array('MeetingRoom');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');
	public $paginate = array('limit' => 10,);       

    public function mr_list() {
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('MeetingRoom.mr_name' => 'asc', 'valid' => 'desc','id' => 'asc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('MeetingRoom'));
    }
	
	public function mr_edit($id = null) {
		if ($id != null){$this->MeetingRoom->id = $id;} else {$this->request->data['MeetingRoom']['create_time'] = date('Y-m-d H:i:s');}
		if ($this->request->is('get')) {
			$this->request->data = $this->MeetingRoom->read();
		} else {
			$this->MeetingRoom->set($this->request->data);
			if ($this->MeetingRoom->validates()) {
				if ($this->MeetingRoom->save($this->request->data)) {
					$this->Session->setFlash('儲存成功.');
					$this->redirect(array('action' => 'mr_list'));
				} else {
					$this->Session->setFlash('儲存失敗.');
				}
			}
			else {
				$errors = $this->MeetingRoom->validationErrors;
				$this->Session->setFlash($this->Formfunc->validate_errors($errors));
			}
		}
	}
	
	public function mr_del($id) {
		$this->MeetingRoom->id = $id;
		$this->request->data = $this->MeetingRoom->read();
		$this->request->data['MeetingRoom']['valid'] = ($this->request->data['MeetingRoom']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->MeetingRoom->save($this->request->data)) {
			$this->Session->setFlash('會議室狀態已變更.');
			$this->redirect(array('action' => 'mr_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
}
?>