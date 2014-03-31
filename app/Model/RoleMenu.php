<?php
class RoleMenu extends AppModel {
    public $name = 'RoleMenu';
    public $belongsTo = array(
    		'Role', 
    		'Menu',
    );
}
?>