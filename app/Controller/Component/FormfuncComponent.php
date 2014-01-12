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
		
		public function status(){
			return array(1=>"生效",0=>"未生效");
		}
		public function equip_status() {
			return array(1=>"正常使用",0=>"暫停預約");
		}
		
		public function safety_trial_status() {
			return array(1=>"進行中",0=>"已終止");
		}
		public function safety_trial_checktypes(){
			return array(1=>"Long term",2=>"Accelerate",3=>"自定義");
		}
		public function safety_trial_humitures(){
			return array(-20=>"-20°C",2=>"2~8°C",25=>"25°C/60%RH",30=>"30°C/65%RH",40=>"40°C/75%RH");
					}
		public function person_gender() {
			return array(0=>"女",1=>"男");		
		}
		
		public function person_valid(){
			return array(1=>"生效",0=>"未生效",-1=>"停權");
		}

		public function document_status(){
			return array(1=>"生效",0=>"未生效");
		}
		
		public function training_status(){
			return array(1=>"生效",0=>"未生效");
		}
		
		public function validate_errors($errors) {
			$result = '';
			foreach($errors as $error1) {
				foreach($error1 as $error_msg) {
					$result = $result.','.$error_msg;
				}
			}
			return substr($result,1);
		}
		
		public function checkin_status(){
			return array(0=>"合格(Pass)",1=>"不合格(Fail)", 2=>"N/A");
		}
	}
?>