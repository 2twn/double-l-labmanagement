<?php
class EquipmentsController extends AppController {
	public $uses = array('Equip', 'EquipBooking', 'Project', 'User');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc');

 	public function equip_list() {
		$this->set('equip_status', $this->Formfunc->equip_status());
        $this->set('items', $this->Equip->find('all', array('order' => 'id')));
    }
	
	public function equip_edit($id = null) {
		$this->Equip->id = $id;
		$this->set('equip_status', $this->Formfunc->equip_status());
		if ($this->request->is('get')) {
			$this->request->data = $this->Equip->read();
		} else {
			if ($id == null) {
				$this->Equip->id == null;
				$this->request->data['Equip']['create_time'] = date('Y-m-d H:i:s');
			}
			if ($this->Equip->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'equip_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function equip_del($id) {
		$this->Equip->id = $id;
		$this->request->data = $this->Equip->read();
		$this->request->data['Equip']['valid'] = ($this->request->data['Equip']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Equip->save($this->request->data)) {
			$this->Session->setFlash('儀器狀態已變更.');
			$this->redirect(array('action' => 'equip_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	public function equip_booking_action($id = null, $sel_date = null) {
		$this->set('equips', $this->Equip->find('list', array('conditions' => array('valid' => 1, 'status' => 1), 'fields' => array('id','equip_name'))));
		$this->set('start_periods', $this->book_periods());
		$this->set('end_periods', $this->book_periods(1));
		$this->set('projects', $this->Project->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','prj_name'))));
		$this->EquipBooking->id = $id;
		// $this->set('equip_status', $this->Formfunc->equip_status());
		if ($this->request->is('get')) {
			$this->request->data = $this->EquipBooking->read();
			if($this->request->data === false) {
				if ($sel_date != null) {
					$this->request->data['EquipBooking']['start_date'] = $sel_date;
				}
				else {
					$this->request->data['EquipBooking']['start_date'] = date('Y-m-d');
				}
			}
			else {
				$this->request->data['EquipBooking']['start_time'] = date('H:i',strtotime($this->request->data['EquipBooking']['book_start_time']));
				$this->request->data['EquipBooking']['end_time'] = date('H:i', strtotime($this->request->data['EquipBooking']['book_end_time']));
				$this->request->data['EquipBooking']['start_date'] = date('Y-m-d',strtotime($this->request->data['EquipBooking']['book_start_time']));
			}
		} else {
			$error_msg = $this->insert_book_record($this->request->data['EquipBooking']);
			if ($error_msg == ''){
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'equip_book_list'));
			}
			else {
				$this->Session->setFlash($error_msg);
			}
		}
	}

 	public function equip_book_list() {
        $this->set('items', $this->EquipBooking->query("Select *
		                                        from equip_bookings EquipBooking,
												     equips Equip,
													 projects Project
											   where EquipBooking.equip_id = Equip.id
											     and EquipBooking.project_id = Project.id
											     and EquipBooking.valid = 1
											   order by Equip.equip_name, EquipBooking.book_start_time desc;"));
    }
	
	public function insert_book_record($book_data) {
		$book_data['book_end_time'] = $book_data['start_date']." ".$book_data['end_time'].":00";
		$book_data['book_end_time'] = date('Y-m-d H:i:s', strtotime($book_data['book_end_time']));
		$book_data['book_start_time'] = $book_data['start_date']." ".$book_data['start_time'].":00";
		if (($book_data['id'] == null) || ($book_data['id'] == "")){
			$book_data['create_time'] = date('Y-m-d H:i:s');
			$book_id = 0;
		}
		else {
			$book_id = $book_data['id'];
		}
		$error_msg = $this->is_equip_book($book_data['equip_id'], $book_data['book_start_time'], $book_data['book_end_time'], $book_id);
		if ($error_msg == ''){
			if (!$this->EquipBooking->save($book_data)) {
				$error_msg = '儲存失敗.';
			}
		}
        
		return $error_msg;
	}
	
	public function is_equip_book($equip_id, $start_time, $end_time, $id=0) {
		$result = '';
		$rlt = $this->EquipBooking->query("Select count(*) as cnt 
		                                        from equip_bookings 
											   where equip_id = '$equip_id' 
											     and valid = 1
												 and id <> $id
											     and ((book_start_time = '$start_time') 
		                                           or (book_end_time = '$end_time')
												   or ((book_start_time < '$start_time') and (book_end_time > '$start_time')) 
												   or ((book_start_time < '$end_time') and (book_end_time > '$end_time')) 
												      );");
		$rlt = $rlt[0][0]['cnt'];
		if ($rlt > 0) {
			$result = '預約衝突';
		}
		if ($start_time >= $end_time) {
			$result = '預約時間有誤';
		}
		return $result;
	}
	
	public function book_periods($type=0,$minutes=240) {
		$result = array();
		$add_minutes = 0; 
		$period_tmp = mktime(0, 0, 0, 1, 1, 2000);
		while ($add_minutes <= 86400) {
			$period_tmp = mktime(0, $add_minutes, 0, 1, 1, 2000);
			$result[date('H:i',$period_tmp)] = date('H:i',$period_tmp); 
			$add_minutes = $add_minutes + $minutes;
		}
		if ($type == 1) {
			$result['24:00'] = '24:00'; 
			unset($result['00:00']);
		}
		return $result;
	}
}
?>