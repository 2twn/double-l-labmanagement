<?php
class TrainingController extends AppController {
	public $uses = array('TrainingDocument', 'Training', 'TrainingUser','TrainingWDocument','MeetingRoom', 'User');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session', 'Formfunc', 'Userfunc');
	public $paginate = array('limit' => 10,);

 	public function document_list() {
		$this->set('document_status', $this->Formfunc->document_status());
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('valid desc','id asc'),
			'limit' => 4
		);
        $this->set('items', $this->paginate('TrainingDocument'));
    }
	
	public function document_edit($id = null) {
		if ($id != null) {$this->TrainingDocument->id = $id;} else {$this->request->data['TrainingDocument']['create_time'] = date('Y-m-d H:i:s');}
		if ($this->request->is('get')) {
			$this->request->data = $this->TrainingDocument->read();
		} else {
			if ($this->TrainingDocument->save($this->request->data)) {
				$this->Session->setFlash('儲存成功.');
				$this->redirect(array('action' => 'document_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function document_del($id) {
		$this->TrainingDocument->id = $id;
		$this->request->data = $this->TrainingDocument->read();
		$this->request->data['TrainingDocument']['valid'] = ($this->request->data['TrainingDocument']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->TrainingDocument->save($this->request->data)) {
			$this->Session->setFlash('文件狀態已變更.');
			$this->redirect(array('action' => 'document_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	 public function training_list() {
		$this->set('$training_status', $this->Formfunc->training_status());
		$this->paginate = array(
			'conditions' => array(),
			'order' => array('valid desc','id asc'),
			'limit' => 10
		);
		//var_Dump($this->paginate('Training'));
        $this->set('items', $this->paginate('Training'));
    }
	
	public function training_edit($id = null) {
		$this->set('users', $this->User->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','name'))));
		$this->set('documents', $this->TrainingDocument->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','document_name'))));
		$this->set('meeting_rooms', $this->MeetingRoom->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','mr_name'))));
		if ($id != null) { $this->Training->id = $id; } else {$this->request->data['Training']['create_time'] = date('Y-m-d H:i:s');}
		if ($this->request->is('get')) {
			$this->request->data = $this->Training->read();
			$this->request->data['Training']['start_date'] = substr($this->request->data['Training']['start_time'],0,10);
			$this->request->data['Training']['b_start_time'] = substr($this->request->data['Training']['start_time'],11,5);
			$this->request->data['Training']['b_end_time'] = substr($this->request->data['Training']['end_time'],11,5);
		} else {
			$this->request->data['Training']['start_time'] = substr($this->request->data['Training']['start_date'],0,10)." ".$this->request->data['Training']['b_start_time'];
			$this->request->data['Training']['end_time'] = substr($this->request->data['Training']['start_date'],0,10)." ".$this->request->data['Training']['b_end_time'];
			if ($this->Training->save($this->request->data)) {
				$newTrainingId = $this->Training->id;
				$this->TrainingWDocument->deleteAll(array('TrainingWDocument.training_id' => $newTrainingId), false);
				if (isset($this->request->data["Training"]["docs_id"])) {
					for($i=0;$i< sizeof($this->request->data["Training"]["docs_id"]); $i++) {
						$this->request->data["TrainingWDocument"][$i] = array('training_document_id' => $this->request->data["Training"]["docs_id"][$i],
																			  'training_id' => $newTrainingId,
																			  'create_time' => date('Y-m-d H:i:s'));
					}
					$this->TrainingWDocument->saveMany($this->request->data["TrainingWDocument"]);
				}
				$this->TrainingUser->deleteAll(array('TrainingUser.training_id' => $newTrainingId), false);
				if (isset($this->request->data["Training"]["user_id"])) {
					for($i=0;$i< sizeof($this->request->data["Training"]["user_id"]); $i++) {
						$this->request->data["TrainingUser"][$i] = array('user_id' => $this->request->data["Training"]["user_id"][$i],
																			  'training_id' => $newTrainingId,
																			  'create_time' => date('Y-m-d H:i:s'));
					}
					$this->TrainingUser->saveMany($this->request->data["TrainingUser"]);
				}
				$this->Session->setFlash('儲存成功.');
				//$this->redirect(array('action' => 'training_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function training_del($id) {
		$this->Training->id = $id;
		$this->request->data = $this->Training->read();
		$this->request->data['Training']['valid'] = ($this->request->data['Training']['valid'] + 1)%2;
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Training->save($this->request->data)) {
			$this->Session->setFlash('訓練狀態已變更.');
			$this->redirect(array('action' => 'training_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
}
?>