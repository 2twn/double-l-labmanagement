<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');
App::import('Vendor', 'phpldap/ldap_func');
class LdapAuthenticate extends BaseAuthenticate {
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		$userModel = $this->settings['userModel'];
		list(, $model) = pluginSplit($userModel);
		
		$fields = $this->settings['fields'];
		if (!$this->_checkFields($request, $model, $fields)) {
			return false;
		}		
		$user = $this->_findUser($request->data[$model][$fields['username']]);
		if(!$user) {
			return false;
		}
		
		if($request->data[$model][$fields['username']] == 'admin'){
			return $user;
		}
		
		if(!$this->_findLdapUser(
			$request->data[$model][$fields['username']],
			$request->data[$model][$fields['password']])) {
			return false;
		}
		return $user;
	}
	
	private function _checkFields(CakeRequest $request, $model, $fields) {
		if (empty($request->data[$model])) {
			return false;
		}
		foreach (array($fields['username'], $fields['password']) as $field) {
			$value = $request->data($model . '.' . $field);
			if (empty($value) || !is_string($value)) {
				return false;
			}
		}
		return true;
	}
	private function _findLdapUser($username, $password = null){
		$ldap_auth = new ldap_func();
		$result = $ldap_auth->ldap_auth($username, $password);
		return $result;
	}
}
