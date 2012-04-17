<?php
require_once 'init.php';
fSession::close();
fSession::destroy();
fAuthorization::destroyUserInfo();
header('Location: '.LOGIN);
?>