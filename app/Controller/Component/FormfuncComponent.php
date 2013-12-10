<?php
	App::uses('Component', 'Controller');
	class FormfuncComponent extends Component {
		public $adminRoles = array(
				'admin'=>'總管理員',
				'localadmin' => '分校管理員',
				'localmanager' => '分校經理'
				);
		
		public function convert_options($result, $model, $key=id, $label='name') {
			$rt = array();
			foreach($result as $item) {
				$rt[$item[$model][$key]] = $item[$model][$label];
			}
			return $rt;
		}
		
		public function equip_status() {
			return array(1=>"正常使用",0=>"暫停預約");
		}
		
		public function person_gender() {
			return array(0=>"女",1=>"男");
		}
		
		public function person_valid(){
			return array(1=>"生效",0=>"未生效",-1=>"停權");
		}
	}
?>