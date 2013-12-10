<?php
class EquipmentsController extends AppController {
	public $uses = array('Equipment', 'EquipBooking', 'Project');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');

 	public function equip_list() {
		$this->set('equip_status', $this->Formfunc->equip_status());
        $this->set('items', $this->Equipment->find('all', array('order' => 'id')));
    }
	
	public function equip_edit($id = null) {
		$this->Equipment->id = $id;
		$this->set('equip_status', $this->Formfunc->equip_status());
		if ($this->request->is('get')) {
			$this->request->data = $this->Equipment->read();
		} else {
			if ($this->Equipment->id == null){
				$this->request->data['Equipment']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->Equipment->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'equip_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function equip_del($id) {
		$this->Equipment->id = $id;
		$this->request->data = $this->Equipment->read();
		$this->request->data['Equipment']['valid'] = ($this->request->data['Equipment']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Equipment->save($this->request->data)) {
			$this->Session->setFlash('儀器狀態已變更.');
			$this->redirect(array('action' => 'equip_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	public function equip_booking_action($id = null, $sel_date = null) {
		$this->set('equips', $this->Equipment->find('all', array('conditions' => array('valid' => 1, 'status' => 1), 'fields' => array('id','equip_name'))));
		$this->set('start_periods', $this->book_periods());
		$this->set('end_periods', $this->book_periods());
		$this->set('projects', $this->Project->find('all', array('conditions' => array('valid' => 1), 'fields' => array('id','prj_name'))));
		$this->EquipBooking->id = $id;
		// $this->set('equip_status', $this->Formfunc->equip_status());
		if ($this->request->is('get')) {
			$this->request->data = $this->EquipBooking->read();
			if($this->request->data === false) {
				if ($sel_date != null) {
					$this->request->data['EquipBooking']['start_date'] = $sel_date;
					$this->request->data['EquipBooking']['end_date'] = $sel_date;
				}
				else {
					$this->request->data['EquipBooking']['start_date'] = date('Y-m-d');
					$this->request->data['EquipBooking']['end_date'] = date('Y-m-d');
				}
			}
		} else {
			$this->request->data['EquipBooking']['end_date'] = $this->request->data['EquipBooking']['start_date'];
			if ($this->EquipBooking->id == null){
				$this->request->data['EquipBooking']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->EquipBooking->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'equipbook_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function is_equip_book($equip_id, $start_date, $start_time, $end_date, $end_time) {
		$result = false;
		return $result;
	}
	
	public function book_periods($minutes=240) {
		$result = array();
		$add_minutes = 0; 
		$period_tmp = mktime(0, 0, 0, 1, 1, 2000);
		while ($add_minutes <= 86400) {
			$period_tmp = mktime(0, $add_minutes, 0, 1, 1, 2000);
			$result[date('H:i',$period_tmp)] = date('H:i',$period_tmp); 
			$add_minutes = $add_minutes + $minutes;
		}
		return $result;
	}
}
?>