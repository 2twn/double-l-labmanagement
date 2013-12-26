<?php
App::uses ( 'Component', 'Controller' );
class ReagentfuncComponent extends Component {
	/*
	 * 試藥編號格式:R13-0001;13 為西元年;0001 為流水編號
	*/
	public function create_record_id(){
		$modelname = 'ReagentRecord';
		$year = date('y');
		$conditions = array(
				$modelname . '.' . 'id like ' => 'R'.$year.'-%',
		);
		$count = ClassRegistry::init($modelname)->find('count',
				array('conditions' => $conditions)
		);
		$id = sprintf('R%1$s-%2$04d', $year,$count+1);

		return $id;
	}
}
?>