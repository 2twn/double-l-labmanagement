<?php
class SafetyTrialCheckdate extends AppModel {
    public $name = 'SafetyTrialCheckdate';
    public $belongsTo = array(
    		'SafetyTrial' => array(
    				'className' => 'SafetyTrial',
    				'foreignKey' => 'safty_trial_id'),
    );    
}
?>