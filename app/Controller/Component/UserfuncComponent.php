<?php
App::uses('Component', 'Controller');
class UserfuncComponent extends Component {
	public $components = array('Session','Formfunc');
	
	public $user_roles = array(
			'admin'=>'總部管理員', 
			'localadmin'=>'分校管理員', 
			'localmanager'=>'分校經理'
		);
	public $user_groups = array(
			0=>'管理者',
			1=>'使用者',
			2=>'儀器管理',
			3=>'安定性樣品管理',
			4=>'教育訓練管理',
			5=>'試藥管理',
			
	);

	public function getGroupOptions(){
		return $this->user_groups;
	}
	public function getRoleOptinons(){
		$modelName = 'Role';
		$model = ClassRegistry::init($modelName);
		
		$items = $model->find('list',
				array(
					'order' => array($modelName.'.id '),
					'fields' => array($modelName.'.id', $modelName.'.name')		
				)
		);
		return $items;
	}
	
	public function getLocationOptions($prearray=null,$postarray=null){
		$modelName = 'System_Location';
		$conditions = array('1' => '1',$modelName.'.valid' => 1);
		if($this->Session->read('user_role') !== 'admin'){
			$conditions = array(
					$modelName.'.id' => $this->Session->read('user_location'),
					$modelName.'.valid' => 1
				);
		}
		$items = ClassRegistry::init($modelName)->find('list',
				array(
					'conditions' => $conditions,
					'order' => array($modelName.'.id '),
					'fields' => array($modelName.'.id', $modelName.'.location_name')		
				)
		);
		if(isset($prearray)){
			$items = array_merge((array)$prearray, (array)$items);			
		}
		if(isset($postarray)){
			$items = array_merge((array)$items, (array)$postarray);
		}
		return $items;
	}
	
	public function getLocationCondition($model='User', $condition=null){
		if($condition == null)
			$condition = array();
		if($this->Session->read('user_role') !== 'admin'){
			$t = array($model.'.location_id' => $this->Session->read('user_location'));
			$condition = array_merge($condition, $t);
		}
		return $condition;
	}
	
	public function buildUserMenu($user){
		
		$db = ClassRegistry::init("User")->getDataSource();
		$sql ="Select * from menus as Menu 
				where 
					id in ( 
						select menu_id from role_menus 
						where role_id in (
							select role_id from user_roles where user_id = :user_id
						)
					) 
				order by view_order";
 		$items = $db->fetchAll($sql,array('user_id'=>$user['id']));
 		//return $items;
		$menus = null;
		$catalog_name = count($items)>0?$items[0]['Menu']['catalog']:null;
		$catas = array();
		foreach($items as $item){
			if($catalog_name !== $item['Menu']['catalog']){
				$menus[$catalog_name] = $catas;
				$catas = array();
				$catalog_name = $item['Menu']['catalog'];
			}
			$catas[] = $item['Menu'];
		}
		if($catalog_name !== null){
			$menus[$catalog_name] = $catas;
		}
		return $menus;
		
	}
}
?>