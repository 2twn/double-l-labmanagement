<?php
class EquipmentsController extends AppController {
	public $uses = array('Equip', 'EquipBooking', 'Project', 'User');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session', 'Formfunc', 'Userfunc');
	public $paginate = array('limit' => 10,);

 	public function equip_list() {
		$this->set('equip_status', $this->Formfunc->equip_status());
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('Equip.valid'=>'desc','Equip.equip_code'=>'asc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('Equip'));
    }
	
	public function equip_edit($id = null) {
		if ($id != null) {
			$this->Equip->id = $id;
		} else {
			$this->request->data['Equip']['create_time'] = date('Y-m-d H:i:s');
		}
		$this->set('equip_status', $this->Formfunc->equip_status());
		$this->set('id', $id);
		if ($this->request->is('get')) {
			$this->request->data = $this->Equip->read();
		} else {
			$this->Equip->set($this->request->data);
			if ($this->Equip->validates()) {
				$equip_existed = $this->Equip->find('count', array('conditions' => array('id' => $this->request->data['Equip']['id'])));
				if ($this->request->data['Equip']['id'] != null) {
					$equip_existed = $this->Equip->find('count', array('conditions' => array('equip_code' => $this->request->data['Equip']['equip_code'], 'id != '.$this->request->data['Equip']['id'])));
				}
				if (($id == null) || (!$equip_existed)){
					if ($this->Equip->save($this->request->data)) {
						$this->Session->setFlash('儲存成功.');
						$this->redirect(array('action' => 'equip_list'));
					} else {
						$this->Session->setFlash('儲存失敗.');
					}
				}
				else {
					$this->Session->setFlash('儀器代號已存在.');
				}
			}
			else {
				$errors = $this->Equip->validationErrors;
				$this->Session->setFlash($this->Formfunc->validate_errors($errors));
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
		$this->set('equips', $this->genValidEquip());
		$this->set('start_periods', $this->Formfunc->book_periods());
		$this->set('end_periods', $this->Formfunc->book_periods(1));
		$this->set('projects', $this->Project->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','prj_name'))));
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
			else {
				$this->request->data['EquipBooking']['start_time'] = date('H:i',strtotime($this->request->data['EquipBooking']['book_start_time']));
				$this->request->data['EquipBooking']['end_time'] = date('H:i', strtotime($this->request->data['EquipBooking']['book_end_time']));
				$this->request->data['EquipBooking']['start_date'] = date('Y-m-d',strtotime($this->request->data['EquipBooking']['book_start_time']));
				$this->request->data['EquipBooking']['end_date'] = date('Y-m-d',strtotime($this->request->data['EquipBooking']['book_end_time']));
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
	
	public function equip_booking_delete($id = null) {
 		$this->EquipBooking->id = $id;
 		$this->request->data = $this->EquipBooking->read();
 		$this->request->data['EquipBooking']['valid'] = ($this->request->data['EquipBooking']['valid'] + 1)%2;
//  		if ($this->request->is('get')) {
//  			throw new MethodNotAllowedException();
//  		}
 		if ($this->EquipBooking->save($this->request->data)) {
 			$this->Session->setFlash('儀器預約已取消.');
 			$this->redirect(array('action' => 'equip_book_list'));
 		} else {
			$this->Session->setFlash('作業失敗.');
		}
	}
	
 	public function equip_book_list() {
		// $this->EquipBooking->find('all');
        // $this->set('items', $this->EquipBooking->query("Select *
		                                        // from equip_bookings EquipBooking,
												     // equips Equip,
													 // projects Project
											   // where EquipBooking.equip_id = Equip.id
											     // and EquipBooking.project_id = Project.id
											     // and EquipBooking.valid = 1
											   // order by Equip.equip_name, EquipBooking.book_start_time desc;"));
		$this->paginate = array(
			'conditions' => array('EquipBooking.valid'=>1),
			'order' => array('EquipBooking.valid'=>'desc','EquipBooking.id'=>'desc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('EquipBooking'));
    }
	
	public function insert_book_record($book_data) {
		$this->set('equips', $this->genValidEquip());
		$book_data['book_end_time'] = $book_data['end_date']." ".$book_data['end_time'].":00";
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
		if ($book_data['book_start_time'] >= $book_data['book_end_time']) {
			$error_msg = '起訖日期錯誤';
		}
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
	
// 	public function book_periods($type=0,$minutes=240) {
// 		$result = array();
// 		$add_minutes = 0; 
// 		$period_tmp = mktime(0, 0, 0, 1, 1, 2000);
// 		while ($add_minutes <= 86400) {
// 			$period_tmp = mktime(0, $add_minutes, 0, 1, 1, 2000);
// 			$result[date('H:i',$period_tmp)] = date('H:i',$period_tmp); 
// 			$add_minutes = $add_minutes + $minutes;
// 		}
// 		if ($type == 1) {
// 			$result['24:00'] = '24:00'; 
// 			unset($result['00:00']);
// 		}
// 		return $result;
// 	}
	
	public function equip_booking_table() {
		$this->set('equips', $this->genValidEquip(1));
		$this->set('years', $this->genYears(2, 2));
		$this->set('search_year', date('Y'));
		$this->set('months', array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06',
		                          '07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12'));
		$this->set('search_month', date('m'));
		$YM = date('Y-m'); 
        $items= $this->EquipBooking->query("Select *
		                                        from equip_bookings EquipBooking,
												     equips Equip,
													 projects Project
											   where EquipBooking.equip_id = Equip.id
											     and EquipBooking.project_id = Project.id
											     and EquipBooking.valid = 1
        		                                 and ((substring(EquipBooking.book_start_time,1,6) = '$YM')
        		                                      or (substring(EquipBooking.book_start_time,1,6) = '$YM'))
											   order by Equip.equip_name, EquipBooking.book_start_time desc;");
        $this->set('items', $items);
    }
	
	public function genYears($count_f = 2, $count_p =5) {
		$result = array();
		$cur_year = date('Y');
		for($i= $cur_year + $count_f; $i > $cur_year; $i--) {
			$result[$i] = $i;
		}
		for($i= $cur_year; $i > $cur_year - $count_p; $i--) {
			$result[$i] = $i;
		}
		return $result;
	}
	
	public function genValidEquip($etype=0) {
		if ($etype=1) {
			return $this->Equip->find('list', array('conditions' => array('valid' => 1, 'status' => 1), 'fields' => array('id','equip_code')));
		}
		else {
			return $this->Equip->find('list', array('conditions' => array('valid' => 1, 'status' => 1), 'fields' => array('id','equip_name')));
		}
	}
	
	public function get_booking_table() {
		$this->layout = 'ajax';
		$equip_id = $this->request->data['equip_id'];
		$s_year = $this->request->data['search_year'];
		$s_month = $this->request->data['search_month'];
		$s_wday = date('w', strtotime($s_year."-".$s_month."-01"));
		$week_table = array();
		$line = 1;
		for ($i=$s_wday; $i > 0; $i--) {
			$line_date = date('Y-m-d', mktime(0, 0, 0, $s_month, 1 - $i, $s_year));
			$week_table[$line][$line_date] = array('class' => 'pre', 'booking' => array());
		}
		$cur_day = 1;
		$line_date = date('Y-m-d', mktime(0, 0, 0, $s_month, $cur_day, $s_year));
		while ($s_month == date('m', strtotime($line_date))) {
			if (date('w', strtotime($line_date)) == '0' && (date('d', strtotime($line_date)) != '01')) {
				$line++;
			}
			$week_table[$line][$line_date] = array('class' => 'current', 'booking' => $this->get_book_by_date($equip_id, $line_date));
			$cur_day++;
			$line_date = date('Y-m-d', mktime(0, 0, 0, $s_month, $cur_day, $s_year));
		}
		while (date('w', strtotime($line_date)) > 0) {
			$week_table[$line][$line_date] = array('class' => 'future', 'booking' => array());
			$cur_day++;
			$line_date = date('Y-m-d', mktime(0, 0, 0, $s_month, $cur_day, $s_year));
		}
// 		var_dump($week_table);
		$this->set('week_table', $week_table);
	}
	
	public function get_book_by_date($equip_id, $start_date) {
		$start_periods= $this->Formfunc->book_periods();
		$end_periods = $this->Formfunc->book_periods(1);
		$result = array();
		$booking = $this->EquipBooking->find('all', array('conditions' => array('EquipBooking.valid' => 1, 
																				'EquipBooking.equip_id' => $equip_id,
																				"substr(EquipBooking.book_start_time,1,10) <= '".$start_date."'",
		                                                                        "substr(EquipBooking.book_end_time,1,10) >= '".$start_date."'")));
		for($i=0; $i<sizeof($booking);$i++) {
			if ((substr($booking[$i]["EquipBooking"]["book_start_time"],0,10) == $start_date) &&
			   (substr($booking[$i]["EquipBooking"]["book_end_time"],0,10) == $start_date)) {
				$result[] = $booking[$i];
			}
			else if (substr($booking[$i]["EquipBooking"]["book_start_time"],0,10) == $start_date) {
				$booking[$i]["EquipBooking"]["book_end_time"] = substr($booking[$i]["EquipBooking"]["book_start_time"],0,10).' 24:00:00';
				$result[] = $booking[$i];
			}
			else if (substr($booking[$i]["EquipBooking"]["book_end_time"],0,10) == $start_date) {
				$booking[$i]["EquipBooking"]["book_start_time"] = substr($booking[$i]["EquipBooking"]["book_end_time"],0,10).' 00:00:00';
				$result[] = $booking[$i];
			}
			else {
				$booking[$i]["EquipBooking"]["book_start_time"] = $start_date.' 00:00:00';
				$booking[$i]["EquipBooking"]["book_end_time"] = $start_date.' 24:00:00';
				$result[] = $booking[$i];
			}
		}
		$booking = $result;
		$result = array();
		for($i=0; $i<sizeof($booking);$i++) {
			$s_periods = array();			
			foreach ($start_periods as $start_period) {
				if ((substr($booking[$i]["EquipBooking"]["book_start_time"],11,5) <= $start_period) 
				 	&& (substr($booking[$i]["EquipBooking"]["book_end_time"],11,5) > $start_period)) {
					$s_periods[]=  $start_period;
				}
			}
			$e_periods = array();
			foreach ($end_periods as $end_period) {
				if ((substr($booking[$i]["EquipBooking"]["book_start_time"],11,5) < $end_period)
				&& (substr($booking[$i]["EquipBooking"]["book_end_time"],11,5) >= $end_period)) {
					$e_periods[]=  $end_period;
				}
			}
			for ($j=0;$j<sizeof($s_periods);$j++) {
				$booking[$i]["EquipBooking"]["book_start_time"] = $start_date." ".$s_periods[$j].":00";
				$booking[$i]["EquipBooking"]["book_end_time"] = $start_date." ".$e_periods[$j].":00";
				$result[] = $booking[$i];
			}
		}
		return $result;
	}
	
	public function equip_booking_day_table($sel_date='') {
		if ($sel_date == '') {
			$sel_date = date('Y-m-d');
		}
		$this->set("sel_date", $sel_date);
	}
	
	public function get_booking_day_table($sel_date='') {
		$this->layout = 'ajax';
		if ($sel_date == '') {
			$sel_date = date('Y-m-d');
		}
		$this->set('equips', $this->genValidEquip());
		$start_periods = $this->Formfunc->book_periods();
		$i = 0;
		foreach ($start_periods as $start_period) {
			$start_periods[$i] = $start_period;
			unset($start_periods[$start_period]);
			$i++;
		}
		$this->set('start_periods', $start_periods);
		$end_periods = $this->Formfunc->book_periods(1);
		$i = 0;
		foreach ($end_periods as $end_period) {
			$end_periods[$i] = $end_period;
			unset($end_periods[$start_period]);
			$i++;
		}
		$this->set('end_periods', $end_periods);
		$bookings = $this->EquipBooking->query("Select *
													from equip_bookings EquipBooking,
													equips Equip,
													projects Project
													where EquipBooking.equip_id = Equip.id
													and EquipBooking.project_id = Project.id
													and EquipBooking.valid = 1 "
												  ."and substr(EquipBooking.book_start_time,1,10) = '$sel_date' "
												  ."order by Equip.equip_name, EquipBooking.book_start_time desc;");
		$items = array();
		foreach ($bookings as $book) {
			$items[$book['EquipBooking']['equip_id']][substr($book['EquipBooking']['book_start_time'],11,5)] = $book;		
		}
		$this->set('items', $items);
	}
	
	function index() {
		
	}
	
	public function equip_book_day_list($sel_date=null) {
		$this->layout = 'ajax';
		if ($sel_date == null) { $sel_date = date('Y-m-d'); }
		$items =$this->EquipBooking->find("all", array(
				'conditions' => array("substr(EquipBooking.book_start_time,1,10) = '".substr($sel_date,0,10)."'", 'EquipBooking.valid' => 1),
		        'order' => array('EquipBooking.valid'=>'desc','EquipBooking.id'=>'desc'),
		        'limit' => 100
		));
		$this->set('sel_date', $sel_date);
		$this->set('items', $items);
    }
}
?>