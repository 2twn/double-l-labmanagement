<?php
class Role extends AppModel {
    public $name = 'Role';
    public $hasMany = array(
    	'RoleMenu' => array(
    		'className' => 'RoleMenu',
    		'foreignKey' => 'role_id'
    	),
    );

}
?>