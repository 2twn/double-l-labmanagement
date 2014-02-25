<?php
class SafetytrialsController extends AppController {
	public $uses = array('SafetyTrial', 'SafetyTrialCheckdate', 'Project', 'User');
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session', 'Formfunc', 'Userfunc','Util','Safetyfunc');
	
	public $check_modes = array(
		'1W'=>array('id'=>'1W','label'=>'1W(3d)','check_day'=>'+7','remind_day'=>-3),
		'2W'=>array('id'=>'2W','label'=>'2W(7d)','check_day'=>'+15','remind_day'=>-7),
		'3W'=>array('id'=>'3W','label'=>'3W(7d)','check_day'=>'+22','remind_day'=>-7),
		'1M'=>array('id'=>'1M','label'=>'1M(14d)','check_day'=>'+30','remind_day'=>-14),
		'5W'=>array('id'=>'5W','label'=>'5W(14d)','check_day'=>'+37','remind_day'=>-14),
		'6W'=>array('id'=>'6W','label'=>'6W(14d)','check_day'=>'+46','remind_day'=>-14),
		'7W'=>array('id'=>'7W','label'=>'7W(14d)','check_day'=>'+53','remind_day'=>-14),
		'2M'=>array('id'=>'2M','label'=>'2M(14d)','check_day'=>'+61','remind_day'=>-14),
		'3M'=>array('id'=>'3M','label'=>'3M(14d)','check_day'=>'+91','remind_day'=>-14),
		'4M'=>array('id'=>'4M','label'=>'4M(14d)','check_day'=>'+90','remind_day'=>-14),
		'5M'=>array('id'=>'5M','label'=>'5M(14d)','check_day'=>'+90','remind_day'=>-14),
		'6M'=>array('id'=>'6M','label'=>'6M(14d)','check_day'=>'+183','remind_day'=>-14),
		'9M'=>array('id'=>'9M','label'=>'9M(30d)','check_day'=>'+274','remind_day'=>-30),
		'12M'=>array('id'=>'12M','label'=>'12M(30d)','check_day'=>'+365','remind_day'=>-30),
		'15M'=>array('id'=>'15M','label'=>'15M(30d)','check_day'=>'+450','remind_day'=>-30),
		'18M'=>array('id'=>'18M','label'=>'18M(30d)','check_day'=>'+548','remind_day'=>-30),
		'20M'=>array('id'=>'20M','label'=>'20M(30d)','check_day'=>'+600','remind_day'=>-30),
		'24M'=>array('id'=>'24M','label'=>'24M(30d)','check_day'=>'+730','remind_day'=>-30),
		'30M'=>array('id'=>'30M','label'=>'30M(30d)','check_day'=>'+913','remind_day'=>-30),
		'36M'=>array('id'=>'36M','label'=>'36M(30d)','check_day'=>'+1095','remind_day'=>-30),			
		'42M'=>array('id'=>'42M','label'=>'42M(30d)','check_day'=>'+1260','remind_day'=>-30),
		'48M'=>array('id'=>'48M','label'=>'48M(30d)','check_day'=>'+1461','remind_day'=>-30),
		'54M'=>array('id'=>'54M','label'=>'54M(30d)','check_day'=>'+1640','remind_day'=>-30),
		'60M'=>array('id'=>'60M','label'=>'60M(30d)','check_day'=>'+1826','remind_day'=>-30),
);
	
	public function index(){
		$options = array (
				'order' => 'SafetyTrial.id' 
		);
		$many_conditions = null;
		if ($this->request->is('post')) {
			$items = $this->Safetyfunc->search ( 
					$this->request->data ['SafetyTrial'] ['status'], 
					$this->request->data ['SafetyTrial'] ['check_start'], 
					$this->request->data ['SafetyTrial'] ['check_end']
			 );

		} else {
			$items = $this->SafetyTrial->find('all', $options);
		}
		$this->set('trial_status', $this->Formfunc->safety_trial_status());
		$this->set('items', $items);
	}
	public function edit($id = null) {
		$this->set('trial_status', $this->Formfunc->safety_trial_status());		
		$this->set('projects', $this->Project->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','prj_name'))));
		$this->set('check_modes', $this->Util->array_column(array_values($this->check_modes), 'label', 'id'));
		$this->set('humitures', $this->Formfunc->safety_trial_humitures());
		$this->set('checktypes',$this->Formfunc->safety_trial_checktypes());
		
		$this->SafetyTrial->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->SafetyTrial->read();
			$this->request->data['check_modes'] = $this->_getCheckModes($id);
 		} else {
			
			if ($this->_save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	private function _getCheckModes($id){
		$options = array(
				'conditions'=>array('SafetyTrialCheckdate.safety_trial_id'=>$id),
				'fields'=>array('check_mode','check_mode')
			);
		return $this->SafetyTrialCheckdate->find('list',$options);
	}
	private function _save($data){
		
		$result = false;
		if($data['SafetyTrial']['id'] == ''){
				$data['SafetyTrial']['create_time'] = date('Y-m-d H:i:s');
		} 
		if ($this->SafetyTrial->save($data)) {
			$id = $this->SafetyTrial->id;
			$checkmodes = $data['check_modes'];
			$this->_saveCheckModes($checkmodes,$id,$data['SafetyTrial']['start_date']);
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
	private function _saveCheckModes($check_modes, $id, $start_date ){
		$this->SafetyTrialCheckdate->deleteAll(array('SafetyTrialCheckdate.safety_trial_id' => $id), false);
		foreach($check_modes as $modeKey=>$modeName){
			$checkData = $this->_buildCheckMode($modeKey,$id,$start_date);
			$this->SafetyTrialCheckdate->create();
			$this->SafetyTrialCheckdate->save($checkData);
		}
		return true;
	}
	private function _buildCheckMode($mode,$id,$start_date){
		$sdate = DateTime::createFromFormat('Y-m-d', $start_date);
		$check_mode = $this->check_modes[$mode];
		$check_date = $sdate->modify($check_mode['check_day'].' days')->format('Y-m-d');
		$remind_date = $sdate->modify($check_mode['remind_day'].' days')->format('Y-m-d');
		$data = null;
		$data['SafetyTrialCheckdate']['id'] = $id.'_'.$mode;
		$data['SafetyTrialCheckdate']['safety_trial_id'] = $id;
		$data['SafetyTrialCheckdate']['check_mode'] = $mode;
		$data['SafetyTrialCheckdate']['check_date'] = $check_date;
		$data['SafetyTrialCheckdate']['remind_date'] = $remind_date;
		return $data;
	}
}	
?>