<?php
App::import('Vendor', 'phpldap/ldap_func');

class TestsController extends AppController {
	public $uses = array('Department', 'User','UserRole');
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Formfunc', 'Userfunc','Util');
    
    public function login() {
		$ldap_auth = new ldap_func();
		$result = $ldap_auth->ldap_auth('lab-ad@tlcbio.local', 'TLCbio!@#');
		var_dump($result);
    }
}
?>