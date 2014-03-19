<?php
App::uses ( 'Component', 'Controller' );
class SafetyfuncComponent extends Component {
	/*
	 *  Search Safety Item by 
	 *  $status : 裝態
	 *  $start_date : 到期日開始
	 *  $end_date : 到期日結束 
	 */
	public function search($status,$start_date,$end_date){
		$model = ClassRegistry::init('SafetyTrial');
		$db = $model->getDataSource();
		$options = array (
				'order' => 'SafetyTrial.id'
		);
		$conditions = array (
				'SafetyTrial.status' => $status
		);		
		$subQuery = $this->_getSubQuery($start_date, $end_date);
		if($subQuery <> null) $conditions[] = $subQuery;
		$options['conditions'] = $conditions;
		return $model->find('all', $options);		
	}
	public function searchByCheckdate($start_date,$end_date){
		$model = ClassRegistry::init('SafetyTrialCheckdate');
		$options = array (
				'recursive' => 2,
				'order' => 'SafetyTrialCheckdate.check_date'
		);
		$conditions = array (
				'SafetyTrial.status' => 1,
				'AND'=> array(
					'SafetyTrialCheckdate.check_date >= ' => $start_date,
        			'SafetyTrialCheckdate.check_date <= ' => $end_date,
				)
		);
		$options['conditions'] = $conditions;
		return $model->find('all', $options);
	}
	private function _getSubQuery($start_date, $end_date){
		$mname = 'SafetyTrialCheckdate';
		$m = ClassRegistry::init($mname);
		$mdb = $m->getDataSource();
		$many_conditions = null;
 		if($start_date <> ''){
			$many_conditions[] = array ($mname.'.check_date >= ' => $start_date );
		}
		if($end_date){
			$many_conditions[] = array ($mname.'.check_date <= ' => $end_date );
		}
		
		if($many_conditions == null) return null;
		
		$subQuery = $mdb->buildStatement(
				array(
						'fields'     => array($mname.'.safety_trial_id'),
						'table'      => $mdb->fullTableName($m),
						'alias'      => $mname,
						'limit'      => null,
						'offset'     => null,
						'joins'      => null,
						'conditions' => $many_conditions,
						'order'      => null,
						'group'      => null
				),
				$m
		);		
		$subQuery = 'SafetyTrial.id in (' . $subQuery . ') ';
		return $mdb->expression($subQuery);;		
	} 
}
?>