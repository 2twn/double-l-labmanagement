<?php
class RolesController extends AppController {
	public $uses = array('Role','RoleMenu', 'User','Menu', 'UserRole');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc','Util');
    
    
    public function index(){
		$this->paginate = array (
				'conditions' => array (),
				'order' => array (
						'valid desc',
						'id asc' 
				),
				'limit' => 10
		);
		$this->set ( 'items', $this->paginate ( 'Role' ) );
		$this->set ( 'valids', $this->Formfunc->status () );
    }
    
    public function edit($id = null) {
    	if ($id != null) {
    		$this->Role->id = $id;
    	} else {
    		$this->request->data ['Role'] ['create_time'] = date ( 'Y-m-d H:i:s' );
    	}
    	if ($this->request->is ( 'get' )) {
    		$this->request->data = $this->Role->read ();
    		$this->request->data['RoleMenus'] = $this->_getRoleMenus($this->request->data['RoleMenu']);
    	} else {
    		if ($this->_save($this->request->data)) {
    			$this->Session->setFlash('儲存成功.');
    			$this->redirect(array('action' => 'index'));
    		} else {
    			$this->Session->setFlash('儲存失敗.');
    		}    		
    	}
    	$this->set ( 'status', $this->Formfunc->status () );
    	$this->set('menus',$this->_getMenus());
    }    
 
    public function delete($id=null){
    	if($id!==null){
    		$this->Role->deleteAll(array('Role.id'=>$id));
    		$this->RoleMenu->deleteAll(array('RoleMenu.role_id'=>$id));
    		$this->UserRole->deleteAll(array('UserRole.role_id'=>$id));
    	}
    	$this->Session->setFlash('刪除成功.');
    	$this->redirect(array('action' => 'index'));
    }
    
    private function _save($data){
    	$result = false;
    	if($data['Role']['id'] == ''){
    		$data['Role']['create_time'] = date('Y-m-d H:i:s');
    	}    	
    	if ($this->Role->save($data)) {
    		$id = $this->Role->id;
    		$rolemenus = isset($data['RoleMenus'])?$data['RoleMenus']:array();
    		$this->_saveRoleMenus($id,$rolemenus);
    		$result = true;
    	} else {
    		$result = false;
    	}  
    	return $result;  	
    }
    private function _getMenus(){
    	return $this->Menu->find('all',array('order' => array('Menu.view_order')));
    }
    private function _getRoleMenus($rolemenus){
    	$tmp =$this->Util->array_column($rolemenus,'menu_id','menu_id');
    	return $tmp;
    }

	private function _saveRoleMenus($role_id, $menus ){
		$this->RoleMenu->deleteAll(array('RoleMenu.role_id' => $role_id), false);
		foreach($menus as $menu){			
			$data  = null;
			$data['RoleMenu']['id'] = $role_id.'.'.$menu;
			$data['RoleMenu']['role_id'] = $role_id;
			$data['RoleMenu']['menu_id'] = $menu;
			$this->RoleMenu->create();
			$this->RoleMenu->save($data);
		}
		return true;
	}   
}
?>