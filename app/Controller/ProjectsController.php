<?php
class ProjectsController extends AppController {
	public $uses = array('Project');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');

 	public function prj_list() {
        $this->set('items', $this->Project->find('all', array('order' => 'valid DESC, id')));
    }
	
	public function prj_edit($id = null) {
		$this->Project->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Project->read();
		} else {
			if ($this->Project->id == null){
				$this->request->data['Project']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'prj_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function prj_del($id) {
		$this->Project->id = $id;
		$this->request->data = $this->Project->read();
		$this->request->data['Project']['valid'] = ($this->request->data['Project']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Project->save($this->request->data)) {
			$this->Session->setFlash('專案狀態已變更.');
			$this->redirect(array('action' => 'prj_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
}
?>