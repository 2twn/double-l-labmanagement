<?php
class ProjectsController extends AppController {
	public $uses = array('Project');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session', 'Formfunc', 'Userfunc');
	public $paginate = array('limit' => 10,);             

 	public function prj_list() {
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('prj_code' =>'asc', 'valid desc','id asc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('Project'));
    }
	
	public function prj_edit($id = null) {
		if ($id != null){
			$this->Project->id = $id;
		} 
		else {
			$this->request->data['Project']['create_time'] = date('Y-m-d H:i:s');
		}
		if ($this->request->is('get')) {
			$this->request->data = $this->Project->read();
		} else {
			$this->Project->set($this->request->data);
			if ($this->Project->validates()) {
				$prj_existed = $this->Project->find('count', array('conditions' => array('prj_code' => $this->request->data['Project']['prj_code'])));
				if ($this->request->data['Project']['id'] != null) {
					$prj_existed = $this->Project->find('count', array('conditions' => array('prj_code' => $this->request->data['Project']['prj_code'], 'id != '.$this->request->data['Project']['id'])));
				}
				if ($prj_existed == 0){
					if ($this->Project->save($this->request->data)) {
						$this->Session->setFlash('儲存成功.');
						$this->redirect(array('action' => 'prj_list'));
					} else {
						$this->Session->setFlash('儲存失敗.');
					}
				}
				else {
					$this->Session->setFlash('專案代號已存在.');
				}
			}
			else {
				$errors = $this->Project->validationErrors;
				$this->Session->setFlash($this->Formfunc->validate_errors($errors));
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