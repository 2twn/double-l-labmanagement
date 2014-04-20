<?php
// using ldap bind
class ldap_func {
	
	private $ldap_settings = array();
	private $ldapconn = null;
	
	public function __construct() {
		$strconfig = file_get_contents(dirname(__FILE__).'/ldap_cfg.php');
		eval($strconfig);
		$this->ldap_setting = $ldap_settings;
	}
	
	public function connect() {
		$this->ldapconn = ldap_connect($this->ldap_setting['ldap_server']);
		return $this->ldapconn;
	}
	
	public function disconnect() {
		ldap_close($this->ldapconn);
		$this->ldapconn = null;
		return true;
	}
	
	public function ldap_auth($user_id='', $pw='') {
		$result = false;
		$this->connect();
		if (strpos($user_id, '@')) {
			$user_id_m = $user_id;
		}
		else {
			$user_id_m = $user_id."@".$this->ldap_setting['ldap_domain'];
		}
		if ($this->ldapconn) {
			$ldapbind = ldap_bind($this->ldapconn, $user_id_m, $pw);
			if ($ldapbind) {
				$result = true;
			}
		}
		$this->disconnect();
		return $result;
	}
	
// 	public function ldap_get_user_info($user_id='', $pw=''){
// 		$result = array();
// 		if (strpos($user_id, '@')) {
// 			$user_id_m = $user_id;
// 		}
// 		else {
// 			$user_id_m = $user_id."@".$this->ldap_setting['ldap_domain'];
// 		}
// 		if ($this->ldapconn) {
// 			$ldapbind = ldap_bind($this->ldapconn, $user_id_m, $pw);
// 			if ($ldapbind) {
// 				$i_ldaptree = 0;
// 				while(sizeof($this->ldap_setting[$i]['ldaptree']) > $i_ldaptree) {
// 					$filter = 'sAMAccountName='.$user_id;
// 					$ldap_result = ldap_search($ldapconn, $this->ldap_setting['ldaptree'][$i_ldaptree], $filter) or die ("Error in search query: ".ldap_error($ldapconn));
// 					$info = ldap_get_entries($ldapconn, $ldap_result); 
// 					if ($info['count'] > 0) {
// 						$result['username'] = $info[0][strtolower("sAMAccountName")][0];
// 						$result['displayname'] = iconv("big5","UTF-8",$info[0][strtolower("displayname")][0]);
// 						if (isset($info[0][strtolower("sn")][0])) {
// 							$result['lastname'] = iconv("big5","UTF-8",$info[0][strtolower("sn")][0]);
// 						}else {
// 							$result['lastname'] = '';
// 						}
// 						if (isset($info[0][strtolower("sn")][0])) {
// 							$result['givenname'] = iconv("big5","UTF-8",$info[0][strtolower("givenname")][0]);
// 						}else {
// 							$result['givenname'] = $info[0][strtolower("sAMAccountName")][0];
// 						}
// 						$result['tel'] = $info[0][strtolower("telephonenumber")][0];
// 						$result['email'] = $info[0][strtolower("mail")][0];
// 						//$result['company'] = iconv("big5","UTF-8",$info[0][strtolower("company")][0]);
// 						$result['id'] = $user_id.'@'.$ldap_settings[$i]['ldap_domain'];	
// 					}
// 					$i_ldaptree++;
// 				}
// 			}
// 		}
// 		return $result;
// 	}
}
?>
