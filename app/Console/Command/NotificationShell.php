<?php
App::uses('Shell', 'Console');
App::uses('CakeEmail', 'Network/Email');
App::uses('ComponentCollection', 'Controller');
App::import('Component', 'Safetyfunc');
App::import('Component', 'Formfunc');

class NotificationShell extends Shell {
        public $uses = array('User');

    public function checkdate_mail_report($sel_date=null){
        $collection = new ComponentCollection();
        $this->Safetyfunc = new SafetyfuncComponent($collection );
        $this->Formfunc = new FormfuncComponent($collection );

        if ($sel_date == null) { $sel_date = date('Y-m-d'); }
//                      $sel_date ='2015-02-17';
        $items = $this->Safetyfunc->searchByCheckdate (
                        $sel_date,
                        $sel_date
        );
        var_dump($items);
                $Email = new CakeEmail();
                $Email->config('smtp');
                $Email->template('checkdate_mail_report_content', 'default1');
        $Email->emailFormat('html');
        $Email->from(array('lab@example.com.tw' => "自動警示系統"));
        $Email->subject("安定性試驗樣品到期提醒 (".$sel_date.")");
        $Email->viewVars(array('items' =>$items, 'sel_date' => $sel_date));
        $userEmails = $this->getUserEmailbyRole(4);
                foreach ($userEmails as $userEmail) {
                        $Email->AddTo (
                                                $userEmail['users']['email'],
                                                $userEmail['users']['name']
                                );
                }
                var_dump($Email->to());
                var_dump($Email->send());
    }

    private function getUserEmailbyRole($roleid = 10000) {
        $strSql = "SELECT users.email, users.name "
                        ."  FROM `users` , "
                                        ."       `user_roles` "
                                                        . " WHERE user_roles.role_id = '" .$roleid."' "
                                                                ."   AND user_roles.user_id = users.id";
        $userEmail = $this->User->query($strSql);
        return $userEmail;
    }
}
?>
