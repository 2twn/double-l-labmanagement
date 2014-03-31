<?php
class UserRole extends AppModel {
    public $name = 'UserRole';
    public $belongsTo = array(
    		'User', 'Role'
    );

}
?>