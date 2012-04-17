<?php
fSession::open();
$id_role = fRequest::get('id_role','integer');
$email = fRequest::encode('email','string');
if(empty($email)) exit();
$arr = array();

if(fAuthorization::checkAuthLevel('super')){
	if(empty($id_role)) $users = User::getByEmailSup($email);
	else $users = User::getByRoleAndEmailSup($id_role,$email);
} else {
if(empty($id_role)) $users = User::getByEmail($email,fSession::get('regs'));
	else $users = User::getByRoleAndEmail($id_role,$email,fSession::get('regs'));
}

if(!empty($users)) {
	foreach($users as $user)
		$arr[] = array(
			'id_user' => $user->getIdUser(),
			// 'id_role' => $user->getIdRole(),
			'email' => $user->getEmail()
		);
}
echo json_encode($arr);