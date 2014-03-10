<?php
class UsersController extends AppController {
	public $uses = array('Department', 'User');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');
    
    public function login() {
    	$this->layout = 'login';
    	if ($this->request->is('post')) {
    		if ($this->Auth->login()) {
    			//$this->Session->write('user',$this->Auth->user());
    			$this->redirect('/users/index');
    		}
    		$this->Session->setFlash(__('Invalid username or password, try again'));
    	}
    }
    
    public function logout() {
    	$this->Session->destroy();
    	return $this->redirect($this->Auth->logout());
    }
    
    public function index(){
    	//var_dump($this->Session->read('user.name'));
    }
    
    public function dep_list() {
        $this->set('items', $this->Department->find('all', array('order' => 'Department.valid DESC, Department.id')));
    }
	
	public function dep_edit($id = null) {
		$this->Department->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Department->read();
		} else {
			if ($this->request->data['Department']['id'] == ''){
				$this->request->data['Department']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'dep_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function dep_del($id) {
		$this->Department->id = $id;
		$this->request->data = $this->Department->read();
		$this->request->data['Department']['valid'] = ($this->request->data['Department']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Department->save($this->request->data)) {
			$this->Session->setFlash('部門狀態已變更.');
			$this->redirect(array('action' => 'dep_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	public function user_list() {
        $this->set('items', $this->User->find('all', array('order' => 'User.valid DESC, User.id')));
        $this->_initUserViewItems();
    }
	
	public function user_edit($id = null) {
		$this->_initUserViewItems();
		
		$this->User->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->User->read();

		} else {
			if ($this->request->data['User']['id'] == ''){
				$this->request->data['User']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'user_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function user_del($id) {
		$this->User->id = $id;
		$this->request->data = $this->User->read();
		$this->request->data['User']['valid'] = ($this->request->data['User']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->User->save($this->request->data)) {
			$this->Session->setFlash('人員狀態已變更.');
			$this->redirect(array('action' => 'user_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	private function _initUserViewItems(){
			$this->set('departments', $this->Department->find('list', array('conditions' => array('Department.valid' => 1), 
			                                                          'fields' => array('Department.id','Department.dep_name'),
																	  'order' => 'Department.dep_name')));
			$this->set('groups', $this->Userfunc->getGroupOptions());
	}
}
?>