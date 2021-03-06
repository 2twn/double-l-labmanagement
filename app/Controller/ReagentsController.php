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
			'Paginator',
			'Formfunc',
			'Reagentfunc',
			'Util' 
	);
	public $paginate = array (
			'limit' => 10 
	);
	public function chemical_list() {

		$this->set ( 'status', $this->Formfunc->status () );
		$this->set( 'items', $this->Chemical->find('all', array('order' => 'Chemical.id')));

	}
	public function chemical_name_search() {
		$this->layout = 'ajax';
		unset($filter_array);
		$filter_array[] = array("Chemical.status"=>1);
		if (isset($this->request->data["name"])) {
			$filter_array[] = array(
					"Chemical.name like '%".$this->request->data["name"]."%'");
		}
	
		$items = $this->Chemical->find('all', array('conditions'=> $filter_array,'order'=>array('name desc')));
		$this->set('items',$items);
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
				'limit' => 10
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
				'limit' => 10
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
		unset($conditions);
		unset($queryCache);
		$keyword='';
		$settings = array (
					'paramType' => 'querystring',
					'conditions' => array ('1 = 1'),
					'order' => 'Reagent.id',
					'limit' => 10
		);
		if($this->request->is ('post' )){
			
			if(!empty($this->request->data['Reagent']['keyword'])){
				$keyword = $this->request->data['Reagent']['keyword'];
				$conditions[] = array ('Reagent.name like ' => '%'.$keyword.'%' );
				$conditions[] = array ('Reagent.id like ' => '%'.$keyword.'%' );
			}
			
			if(isset($conditions)){
				$settings['conditions']['OR'] = $conditions;
				$queryCache['keyword'] = $keyword;
				$queryCache['conditions'] = $conditions;
				$this->Session->write('Reagents.ReagentList.queryCache',$queryCache);				
			}

		} else {		
			if(($queryCache=$this->Session->read('Reagents.ReagentList.queryCache')) != null){
				$keyword = $queryCache['keyword'];
				$conditions = $queryCache['conditions'];
				$settings['conditions']['OR'] = $conditions;
			}
		}
		

		$this->Paginator->settings = $settings;
		$this->set ( 'items', $this->Paginator->paginate ( 'Reagent' ) );	
		$this->set ( 'status', $this->Formfunc->status () );
		$this->set ( 'keyword', $keyword);	
	}
	public function reagent_edit($id = null) {
		$isEdit = false;
		if ($this->request->is ( 'get' )) {
			if ($id != null) {
				$this->Reagent->id = $id;
				$this->request->data = $this->Reagent->read ();
				$isEdit = true;
			} else {
				$this->request->data ['Reagent']['create_time'] = date ( 'Y-m-d H:i:s' );
				$this->request->data ['Chemical']['name'] = '';
				$isEdit = false;
			}
		} else {
			unset($testID);
			if($id == null){
				$testID = $this->Reagent->findAllById($this->request->data['Reagent']['id']);
				$this->request->data ['Reagent']['create_time'] = date ( 'Y-m-d H:i:s' );
			}
			if(!empty($testID)){
				$this->Session->setFlash ( '試藥代號不可重複. ' );
				$isEdit = false;
			} else {
				$isEdit = true;
				if ($this->Reagent->save ( $this->request->data )) {
					$this->Session->setFlash ( '儲存成功.' );
					$this->redirect ( array (
						'action' => 'reagent_list' 
					) );
				} else {
					$errors = $this->Reagent->validationErrors;
					$this->set('errors',$errors);
					$this->Session->setFlash ( '儲存失敗. ' );
				}
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
		$this->set ( 'isedit', $isEdit );
	}
	public function record_list() {
		unset($conditions);
		unset($queryCache);
		$keyword='';
		$settings = array (
				'paramType' => 'querystring',
				'conditions' => array ('1 = 1'),
				'order' => 'ReagentRecord.id',
				'limit' => 10
		);		
		if($this->request->is('post')){
			if(!empty($this->request->data['ReagentRecord']['keyword'])){
				$keyword = $this->request->data['ReagentRecord']['keyword'];
				$conditions[] = array ('ReagentRecord.name like ' => '%'.$keyword.'%' );
				$company_query = $this->_buildCompanySubQuery($keyword);
				if($company_query !=null){
					$conditions[] = $company_query;
				}
			}
			if(isset($conditions)){
				$settings['conditions']['OR'] = $conditions;
				$queryCache['keyword'] = $keyword;
				$queryCache['conditions'] = $conditions;
				$this->Session->write('Reagents.RecordList.queryCache',$queryCache);
			}
			
		} else {		
			if(($queryCache=$this->Session->read('Reagents.RecordList.queryCache')) != null){
				$keyword = $queryCache['keyword'];
				$conditions = $queryCache['conditions'];
				$settings['conditions']['OR'] = $conditions;
			}		
		}
		
		$this->_initRecordPara();
		$this->Paginator->settings = $settings;
		$this->set ( 'items', $this->Paginator->paginate ( 'ReagentRecord' ) );
		$this->set ( 'keyword',$keyword);
	}
	
	private function _buildCompanySubQuery($keyword = null){
		if($keyword==null || trim($keyword)=='') return null;
		unset($conditionsSubQuery);
		$conditionsSubQuery[] = array('Company.name like'=> '%'.$keyword.'%');
		$db = $this->ReagentRecord->getDataSource();
		$subquery = $db->buildStatement(
			array(
				'fields' => array("Company.id"),
				'table'  =>  $db->fullTableName($this->Company),
				'alias'      => 'Company',
				'conditions' => $conditionsSubQuery,
			), 
			$this->Company			
		);
		$subquery = 'ReagentRecord.company_id in ('.$subquery.')';
		return $db->expression($subquery);
	}
	
	public function reagent_name_search($page=1) {
		$this->layout = 'ajax';
		$page_size = 5;
		unset($filter_array);
		$filter_array[] = array("Reagent.status"=>1);
		if (isset($this->request->data["name"])) {			
			$filter_array[] = array(
					"Reagent.name like '%".$this->request->data["name"]."%'");

		}
		$items = $this->Reagent->find('all', array('conditions' =>array($filter_array), 'limit' => $page_size, 'page' => $page));
		$item_cnt = $this->Reagent->find('count', array('conditions' =>array($filter_array)));
		$this->set('items', $items);
		$this->set('item_cnt', ceil($item_cnt/$page_size));
		$this->set('page', $page);
	}	
	
	
	private function _initRecordPara(){
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
	}
	public function record_query(){
		$this->_initRecordPara();
		unset($conditions);
		unset($settings);
		if(($settings=$this->Session->read('Reagents.RecordQuery.paginate')) == null){
			$settings = array (
						'paramType' => 'querystring',
						'conditions' => array ('1 = 2'),
						'order' => array (
								'ReagentRecord.usage desc',
						),
						'limit' => 10
			);		
			$this->Session->write('Reagents.RecordQuery.paginate',$settings);
		}
		if($this->request->is ( 'post' )){
			if(!empty($this->request->data['ReagentRecord']['from'])){
				$conditions[] = array ('ReagentRecord.usage >= ' => $this->request->data['ReagentRecord']['from'] );
			}
			if(!empty($this->request->data['ReagentRecord']['to'])){
				$conditions[] = array ('ReagentRecord.usage <= ' => $this->request->data['ReagentRecord']['to'] );
			}		
			if(!isset($conditions)){
				$conditions[] = array ('1 = 2');
			}
			$settings['conditions'] = $conditions;
			$this->Session->write('Reagents.RecordQuery.paginate',$settings);
		} 
		$this->Paginator->settings = $settings;
		$this->set ( 'items', $this->Paginator->paginate ( 'ReagentRecord') );
	}

	public function record_usage_list($sel_date=null){
		$this->layout = 'ajax';
		$this->_initRecordPara();
		unset($conditions);
		
		if ($sel_date == null) { $sel_date = date('Y-m-d'); }
		$conditions[] = array ('ReagentRecord.usage = ' => $sel_date );
		$items = $this->ReagentRecord->find('all',array('conditions'=> $conditions));
		$this->set('items', $items);		
		$this->set('sel_date', $sel_date);
	}
	
	public function record_edit($id = null) {
		if ($id != null) {
			$this->ReagentRecord->id = $id;
		} else {
			$this->request->data ['ReagentRecord'] ['create_time'] = date ( 'Y-m-d 
		H:
		i:s' );
			$this->request->data ['ReagentRecord'] ['id'] =$this->Reagentfunc->create_record_id();
		}
		if ($this->request->is ( 'get' )) {
			$this->request->data = $this->ReagentRecord->read ();
		} else {
			
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
		$this->set ( 'status', $this->Formfunc->status () )
		;
	}
	public function test() {
		$id = $this->Reagentfunc->create_record_id ();
		var_dump ( $id );
	}
}
?>