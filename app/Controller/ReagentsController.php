<?php
class ReagentsController extends AppController {
	public $uses = array (
			'Reagent',
			'ReagentLevel',
			'ReagentLocation',
			'ReagentRecord',
			'Company',
			'Chemical',
			'Project',
			'User' 
	);
	public $helpers = array (
			'Html',
			'Form',
			'Session',
			'Paginator' 
	);
	public $components = array (
			'Session',
			'Formfunc',
			'Reagentfunc',
			'Util' 
	);
	public $paginate = array (
			'limit' => 10 
	);
	public function chemical_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'Chemical' ) );
	}
	public function chemical_edit($id = null) {
		if ($id != null) {
			$this->Chemical->id = $id;
		} else {
			$this->request->data ['Chemical'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->Chemical->read ();
		} else {
			if ($this->Chemical->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'chemical_list' 
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'status', $this->Formfunc->status () );
	}
	public function company_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'Company' ) );
	}
	public function company_edit($id = null) {
		if ($id != null) {
			$this->Company->id = $id;
		} else {
			$this->request->data ['Company'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->Company->read ();
		} else {
			if ($this->Company->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'company_list' 
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'status', $this->Formfunc->status () );
	}
	public function level_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'ReagentLevel' ) );
	}
	public function level_edit($id = null) {
		if ($id != null) {
			$this->ReagentLevel->id = $id;
		} else {
			$this->request->data ['ReagentLevel'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->ReagentLevel->read ();
		} else {
			if ($this->ReagentLevel->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'level_list' 
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'status', $this->Formfunc->status () );
	}
	public function location_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'ReagentLocation' ) );
	}
	public function location_edit($id = null) {
		if ($id != null) {
			$this->ReagentLocation->id = $id;
		} else {
			$this->request->data ['ReagentLocation'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->ReagentLocation->read ();
		} else {
			if ($this->ReagentLocation->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'location_list' 
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'status', $this->Formfunc->status () );
	}
	public function reagent_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'Reagent' ) );
	}
	public function reagent_edit($id = null) {
		if ($id != null) {
			$this->Reagent->id = $id;
		} else {
			$this->request->data ['Reagent'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->Reagent->read ();
		} else {
			if ($this->Reagent->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'reagent_list' 
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'chemicals', $this->Chemical->find ( 'list', array (
				'conditions' => array (
						'status' => 1 
				),
				'order' => array (
						'name asc'
				),
				'fields' => array (
						'id',
						'name' 
				) 
		) ) );
		$this->set ( 'reagent_levels', $this->ReagentLevel->find ( 'list', array (
				'conditions' => array (
						'status' => 1
				),
				'order' => array (
						'id asc'
				),
				'fields' => array (
						'id',
						'id'
				)
		) ) );		
		$this->set ( 'status', $this->Formfunc->status () );
	}
	public function record_list() {
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 4 
		);
		$this->set ( 'locations', $this->ReagentLocation->find ( 'list', array (
				'order' => array (
						'name asc'
				),
				'fields' => array (
						'id',
						'name'
				)
		) ) );
		$this->set ( 'companys', $this->Company->find ( 'list', array (
				'order' => array (
						'id asc'
				),
				'fields' => array (
						'id',
						'name'
				)
		) ) );		
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'items', $this->paginate ( 'ReagentRecord' ) );
	}
	public function record_edit($id = null) {
		if ($id != null) {
			$this->ReagentRecord->id = $id;
		} else {
			$this->request->data ['ReagentRecord'] ['create_time'] = date ( 'Y-m-d H:i:s' );
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->ReagentRecord->read ();
		} else {
			$this->request->data ['ReagentRecord'] ['id'] =$this->Reagentfunc->create_record_id();
			if ($this->ReagentRecord->save ( $this->request->data )) {
				$this->Session->setFlash ( '儲存成功.' );
				$this->redirect ( array (
						'action' => 'record_list'
				) );
			} else {
				$this->Session->setFlash ( '儲存失敗.' );
			}
		}
		$this->set ( 'locations', $this->ReagentLocation->find ( 'list', array (
				'conditions' => array (
						'status' => 1
				),
				'order' => array (
						'name asc'
				),
				'fields' => array (
						'id',
						'name'
				)
		) ) );
		$this->set ( 'companys', $this->Company->find ( 'list', array (
				'conditions' => array (
						'status' => 1
				),
				'order' => array (
						'id asc'
				),
				'fields' => array (
						'id',
						'name'
				)
		) ) );
		$this->set ( 'status', $this->Formfunc->status () );
	}	
	public function test(){
		
		$id =$this->Reagentfunc->create_record_id();
		var_dump($id);
	}
}
?>