<?php
class MeetingroomsController extends AppController {
	public $uses = array('MeetingRoom');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');

    public function mr_list() {
        $this->set('items', $this->MeetingRoom->find('all', array('order' => 'valid DESC, id')));
    }
	
	public function mr_edit($id = null) {
		$this->MeetingRoom->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->MeetingRoom->read();
		} else {
			if ($this->request->data['MeetingRoom']['id'] == ''){
				$this->request->data['MeetingRoom']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->MeetingRoom->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'mr_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
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