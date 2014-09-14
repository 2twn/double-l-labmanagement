<?php
class TrainingController extends AppController {
	public $uses = array('TrainingDocument', 'Training', 'TrainingUser','TrainingWDocument','MeetingRoom', 'User', 'SystemLog');
    public $helpers = array('Html', 'Form', 'Session', 'Paginator');
    public $components = array('Session', 'Formfunc', 'Userfunc', 'Emailfunc');
	public $paginate = array('limit' => 10,);

 	public function document_list() {
 		$search_condition = array();
 		if (isset($this->data["TrainingDocument"]["search_doc_code"])) {
 			$search_condition = array("doc_code like '".$this->data["TrainingDocument"]["search_doc_code"]."%'");
 			$this->Session->write("document_list_filter",$search_condition);
 		}
 		if ($this->Session->check("document_list_filter")) {
 			$search_condition = $this->Session->read("document_list_filter");
 		}
		$this->set('document_status', $this->Formfunc->document_status());
		$this->paginate = array(
			'conditions' => $search_condition,
			'order' => array('TrainingDocument.doc_code'=>'asc', 'TrainingDocument.valid'=>'desc'),
			'limit' => 10
		);
        $this->set('items', $this->paginate('TrainingDocument'));
    }
	
	public function document_edit($id = null) {
		if ($id != null) {
			$this->TrainingDocument->id = $id;
		} else {
			$this->request->data['TrainingDocument']['create_time'] = date('Y-m-d H:i:s');
		}
		if ($this->request->is('get')) {
			$this->request->data = $this->TrainingDocument->read();
		} else {
			$doc_existed = $this->TrainingDocument->find('count', array('conditions' => array('doc_code' => $this->request->data['TrainingDocument']['doc_code'])));
			if ($this->request->data['TrainingDocument']['id'] != null) {
				$doc_existed = $this->TrainingDocument->find('count', array('conditions' => array('doc_code' => $this->request->data['TrainingDocument']['doc_code'], 'id != '.$this->request->data['TrainingDocument']['id'])));
			}
			if ($doc_existed == 0){
				$this->request->data['TrainingDocument']['doc_code'] = strtoupper($this->request->data['TrainingDocument']['doc_code']);
				if ($this->TrainingDocument->save($this->request->data)) {
					$this->Session->setFlash('儲存成功.');
					$this->redirect(array('action' => 'document_list'));
				} else {
					$this->Session->setFlash('儲存失敗.');
				}
			}
			else {
				$this->Session->setFlash('文件代號已存在.');
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
	 	$search_condition = array();
	 	if (isset($this->data["Training"]["search_start_date"])) {
	 		$search_condition = array("start_time >= '".$this->data["Training"]["search_start_date"]."'");
	 		$this->Session->write("training_list_filter",$search_condition);
	 	}
	 	if ($this->Session->check("training_list_filter")) {
	 		$search_condition = $this->Session->read("training_list_filter");
	 	}
		$this->set('$training_status', $this->Formfunc->training_status());
		$this->paginate = array(
			'conditions' => $search_condition,
			'order' => array('Training.start_time'=>'desc','Training.valid'=>'desc','Training.id'=>'asc'),
			'limit' => 10
		);
		//var_Dump($this->paginate('Training'));
        $this->set('items', $this->paginate('Training'));
    }
	
    public function training_day_list($sel_date='') {
		$this->layout = 'ajax';
    	if ($sel_date=='') {
    		$sel_date = date('Y-m-d');
    	}
   		$search_condition = array("substr(start_time,1,10) = '".$sel_date."'", 'Training.valid' => 1);
    	$this->set('$training_status', $this->Formfunc->training_status());
    	$this->paginate = array(
    			'conditions' => $search_condition,
    			'order' => array('Training.start_time'=>'desc','Training.valid'=>'desc','Training.id'=>'asc'),
    			'limit' => 100
    	);
		$this->set('sel_date', $sel_date);
    	$this->set('items', $this->paginate('Training'));
    }
    
	public function training_edit($id = null) {
		$this->set('users', $this->User->find('list', array('conditions' => array(), 'fields' => array('id','name'))));
		$this->set('documents', $this->TrainingDocument->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','document_name'))));
		$this->set('meeting_rooms', $this->MeetingRoom->find('list', array('conditions' => array('valid' => 1), 'fields' => array('id','mr_name'))));
		if ($id != null) { $this->Training->id = $id; } else {$this->request->data['Training']['create_time'] = date('Y-m-d H:i:s');}
		if ($this->request->is('get')) {
			$this->request->data = $this->Training->read();
			if ($this->data != null) {
				$this->request->data['Training']['start_date'] = substr($this->request->data['Training']['start_time'],0,10);
				$this->request->data['Training']['b_start_time'] = substr($this->request->data['Training']['start_time'],11,5);
				$this->request->data['Training']['b_end_time'] = substr($this->request->data['Training']['end_time'],11,5);
			}
			else {
				$this->request->data['Training']['start_date'] = date('Y-m-d');
				$this->request->data['Training']['b_start_time'] = date('H').':00';
				$this->request->data['Training']['b_end_time'] = date('H').':00';
				$this->request->data["TrainingWDocument"] = array();
				$this->request->data["TrainingUser"] = array();
			}
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
				$this->redirect(array('action' => 'training_list'));
			} else {
				$this->Session->setFlash('儲存失敗.');
			}
		}
	}
	
	public function training_del($id) {
		$this->Training->id = $id;
		$this->request->data = $this->Training->read();
		$this->request->data['Training']['valid'] = ($this->request->data['Training']['valid'] + 1)%2;
// 		if ($this->request->is('get')) {
// 			throw new MethodNotAllowedException();
// 		}
		if ($this->Training->save($this->request->data)) {
			$this->Session->setFlash('訓練狀態已變更.');
			$this->redirect(array('action' => 'training_list'));
		} else {
			$this->Session->setFlash('作業失敗.');
		}	
	}
	
	 public function training_checkin($training_id) {
		if ($this->request->data) {
			foreach($this->request->data["TrainingUser"] as $record) {
				if (isset($record['id'])) {
					$this->TrainingUser->save($record);
				}
			}
		}
		$training = $this->Training->find('all',array('conditions'=>array('Training.id'=>$training_id)));
		$this->set('training', $training[0]);
		$items = $this->TrainingUser->find('all', array('conditions'=>array('training_id' => $training_id)));
		$str_sql = "Select * 
		              from training_users TrainingUser, users User, departments Department 
		             where user_id = User.id 
		               and User.department_id = Department.id 
		               and training_id = '$training_id'; ";
		$items = $this->TrainingUser->query($str_sql);
        $this->set('items', $items);
        $this->set('checkins', $this->Formfunc->checkin_status());
    }
    
    public function training_checkin_print($training_id) {
    	$training = $this->Training->find('all',array('conditions'=>array('Training.id'=>$training_id)));
    	$this->set('training', $training[0]);
    	$str_sql = "Select *
    				  from training_users TrainingUser, users User, departments Department
    				 where user_id = User.id
    			       and User.department_id = Department.id
    				   and training_id = '$training_id'; ";
    	$items = $this->TrainingUser->query($str_sql);
    	$this->set('items', $items);
    }
    
    public function training_checkin_send($training_id) {
    	$training = $this->Training->find('all',array('conditions'=>array('Training.id'=>$training_id)));
    	$this->set('training', $training[0]);
    	$this->Emailfunc->subject ="教育訓練通知 (".date('m/d/Y', strtotime($training[0]['Training']['start_time'])).")";
    	$this->Emailfunc->html_body ="<html><body>
    									<p>主旨: 教育訓練通知 (".date('m/d/Y', strtotime($training[0]['Training']['start_time'])).")</p>
 										<p></p>
										<p>內容:</p>
										<p> </p>
										<p style=\"padding-left:24px\">請 {#NAME#} 準時參加教育訓練課程</p>
										<p style=\"padding-left:24px\">訓練時間、地點及內容如下</p>
										<p> </p>
										<p>
    									<span style=\"padding-left:36px\">時間: ".date('m/d/Y H:i', strtotime($training[0]['Training']['start_time']))." – ".date('H:i', strtotime($training[0]['Training']['end_time']))."</span><br/>
										<span style=\"padding-left:36px\">地點: ".$training[0]["MeetingRoom"]['mr_name']."</span><br/>
										<span style=\"padding-left:36px\">講師: ".$training[0]['Training']["instructor"]."</span><br/>
										<span style=\"padding-left:36px\">內容: (課程名稱)</span><br/>
										</p>
										</body></html>";
    	$str_sql = "Select *
			    	  from training_users TrainingUser, users User, departments Department
			    	 where user_id = User.id
			    	   and User.department_id = Department.id
			    	   and training_id = '$training_id'; ";
    	$items = $this->TrainingUser->query($str_sql);
    	for($i = 0; $i<sizeof($items);$i++) {
    		$this->Emailfunc->to = array(array('email'=> $items[$i]['User']['email'], 'name'=> $items[$i]['User']['name']));
    		$this->Emailfunc->html_body = str_replace('{#NAME#}',$items[$i]['User']['name'],$this->Emailfunc->html_body);
 			$ret = $this->Emailfunc->send();
 			$sys_log = array();
 			$sys_log['id'] =  null;
 			$sys_log['type'] = 'mail log';
 			$sys_log['log'] = $items[$i]['User']['email'].'寄送失敗';
 			if ($ret) {
 				$sys_log['log'] = $items[$i]['User']['email'].'寄送成功';
 			}
 			var_dump($sys_log);
 			$save_rec = $this->SystemLog->save($sys_log);
 			$items[$i]['User']['email_result'] = $ret;
    	}
    	$this->set('items', $items);
    }
    
    public function document_search($page=1) {
    	$this->layout = 'ajax';
	$page_size = 10;
    	$filter_array = array();
    	if (isset($this->data["doc_topic"])) {
    		$filter_array = array("document_name like '%".$this->data["doc_topic"]."%'", 'TrainingDocument.valid'=>1);
    	}
    	$items = $this->TrainingDocument->find('all', array('conditions' =>array($filter_array), 'limit' => $page_size, 'page' => $page));
    	$item_cnt = $this->TrainingDocument->find('count', array('conditions' =>array($filter_array)));
    	$this->set('items', $items);
   	$this->set('item_cnt', ceil($item_cnt/$page_size));
    	$this->set('page', $page);
    }
    
    public function user_search($page=1) {
    	$this->layout = 'ajax';
	    $page_size = 10;
    	$filter_array = array();
    	if (isset($this->data["user_pattern"])) {
    		$filter_array = array("name like '%".$this->data["user_pattern"]."%'", 'User.valid'=>1);
    	}
    	$items = $this->User->find('all', array('conditions' =>array($filter_array), 'limit' => $page_size, 'page' => $page));
    	$item_cnt = $this->User->find('count', array('conditions' =>array($filter_array)));
    	$this->set('items', $items);
    	$this->set('item_cnt', ceil($item_cnt/$page_size));
    	$this->set('page', $page);
    }
    
    public function training_result_by_docid($doc_id=0) {
    	$str_sql = "Select *
    			      from training_users TrainingUser,
    			           training_w_documents Doc
    	             where  TrainingUser.training_id = Doc.training_id
    	               and Doc.training_document_id = '$doc_id'; ";
    	$items = $this->TrainingUser->query($str_sql);
//     	$this->set('items', $items);
		$result = array();
		foreach ($items as $item) {
	    		$training = $this->Training->find('first',array('conditions'=>array('Training.id'=>$item["TrainingUser"]["training_id"])));
	    		$result[$item["TrainingUser"]["training_id"]]['training'] = $training;
	    		$str_sql = "Select *
	    					  from training_documents Doc,
	    						   training_w_documents TDoc
	    					 where Doc.id = TDoc.training_document_id
	    		               and TDoc.training_id = '".$items[0]["TrainingUser"]["training_id"]."'; ";
	   	    	$doc = $this->TrainingDocument->query($str_sql);
	    		$result[$item["TrainingUser"]["training_id"]]['doc'] = $doc;
		    	$str_sql = "Select *
		    			      from training_users TrainingUser, 
		    			           users User, 
		    			           departments Department
		    	             where user_id = User.id
		    	               and User.department_id = Department.id
		    	               and TrainingUser.training_id = '".$item["TrainingUser"]["training_id"]."'; ";
		    	$training_users = $this->TrainingDocument->query($str_sql);
		    	$result[$item["TrainingUser"]["training_id"]]['items'] = $training_users;
    	}
        $this->set('checkins', $this->Formfunc->checkin_status());
    	$this->set('results', $result);
    }
    
    public function user_list() {
	 	$search_condition = array();
	 	if (isset($this->data["User"]["search_name"])) {
	 		$search_condition = array("name like '%".$this->data["User"]["search_name"]."%'");
	 		$this->Session->write("training_user_list_filter",$search_condition);
	 	}
	 	if ($this->Session->check("training_user_list_filter")) {
	 		$search_condition = $this->Session->read("training_user_list_filter");
	 	}
		$this->set('$training_status', $this->Formfunc->training_status());
		$this->paginate = array(
								'conditions' => $search_condition,
								'order' => array('order' => 'User.valid DESC, User.id'),
								'limit' => 10
		);
        $this->set('items', $this->paginate('User'));
    }
    
    public function user_doc_list($user_id='') {
    	$str_sql = "Select *
				      from training_users TrainingUser,
				    	   training_w_documents Doc,
				    	   users User,
				    	   training_documents Doc_Info
				     where TrainingUser.training_id = Doc.training_id
				       and Doc.training_document_id = Doc_Info.id
				       and User.id = TrainingUser.user_id
    	               and TrainingUser.user_id = '$user_id'; ";
    	$items = $this->TrainingUser->query($str_sql);
    	$this->set('checkins', $this->Formfunc->checkin_status());
    	$this->set('items', $items);
    }
}
?>
