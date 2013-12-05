<?php
class EquipmentsController extends AppController {
	public $uses = array('Equipment', 'EquipBooking');
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
	
	public function equip_booking_action($id = null) {
	var_Dump($this->post);
		// $this->Equipment->id = $id;
		// $this->set('equip_status', $this->Formfunc->equip_status());
		// if ($this->request->is('get')) {
			// $this->request->data = $this->Equipment->read();
		// } else {
			// if ($this->Equipment->id == null){
				// $this->request->data['Equipment']['create_time'] = date('Y-m-d H:i:s');
			// }
			// if ($this->Equipment->save($this->request->data)) {
				// $this->Session->setFlash('儲存成功.');
				// $this->redirect(array('action' => 'equip_list'));
			// } else {
				// $this->Session->setFlash('儲存失敗.');
			// }
		// }
	}
	
	public function is_equip_book($equip_id, $start_date, $start_time, $end_date, $end_time) {
		$result = false;
		return $result;
	}
}
?>