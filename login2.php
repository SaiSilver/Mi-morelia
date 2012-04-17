<?php
require_once 'init.php';
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);

if(!empty($idUser))
	header('Location: '.SITE);
	
if(fRequest::isPost()) {

	$u = new User(array('email' => fRequest::encode('email','string')));
	
	$p = fRequest::encode('password','string').SALT;
	$p = md5($p);
	$p = base64_encode($p);
	$p = hash('sha256',$p);
	
	if($u && $u->preparePassword() == $p) {
	
		switch($u->prepareIdRole()) {
			case 1:fAuthorization::setUserAuthLevel('super');break;
			case 2:fAuthorization::setUserAuthLevel('admin');break;
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:fAuthorization::setUserAuthLevel('employee');break;
			case 9:
			default:fAuthorization::setUserAuthLevel('guest');break;
		}
		$up = new UserPermission();
		$tmp = $up->getByIdUser($u->prepareIdUser());
		$permissions = array(
			'banner' => array(),
			'news' => array(),
			'classified'  => array(),
			'social' => array(),
			'poll' => array(),
			'turism' => array(),
			'plaza' => array(),
			'autoplus' => array(),
			'real' => array(),
			'user'  => array(),
			'franchise' => array()
		);
		foreach($tmp as $item) {
			switch($item->prepareIdPermission()) {
				case 1:$permissions['banner'][] = 'add';break;
				case 2:$permissions['banner'][] = 'edit';break;
				case 3:$permissions['banner'][] = 'delete';break;
				case 4:$permissions['news'][] = 'add';break;
				case 5:$permissions['news'][] = 'edit';break;
				case 6:$permissions['news'][] = 'delete';break;
				case 7:$permissions['classified'][] = 'add';break;
				case 8:$permissions['classified'][] = 'edit';break;
				case 9:$permissions['classified'][] = 'delete';break;
				case 10:$permissions['social'][] = 'add';break;
				case 11:$permissions['social'][] = 'edit';break;
				case 12:$permissions['social'][] = 'delete';break;
				case 13:$permissions['poll'][] = 'add';break;
				case 14:$permissions['poll'][] = 'edit';break;
				case 15:$permissions['poll'][] = 'delete';break;
				case 16:$permissions['turism'][] = 'add';break;
				case 17:$permissions['turism'][] = 'edit';break;
				case 18:$permissions['turism'][] = 'delete';break;
				case 19:$permissions['plaza'][] = 'add';break;
				case 20:$permissions['plaza'][] = 'edit';break;
				case 21:$permissions['plaza'][] = 'delete';break;
				case 22:$permissions['autoplus'][] = 'add';break;
				case 23:$permissions['autoplus'][] = 'edit';break;
				case 24:$permissions['autoplus'][] = 'delete';break;
				case 25:$permissions['real'][] = 'add';break;
				case 26:$permissions['real'][] = 'edit';break;
				case 27:$permissions['real'][] = 'delete';break;
				case 28:$permissions['user'][] = 'add';break;
				case 29:$permissions['user'][] = 'edit';break;
				case 30:$permissions['user'][] = 'delete';break;
				case 31:$permissions['franchise'][] = 'add';break;
				case 32:$permissions['franchise'][] = 'edit';break;
				case 33:$permissions['franchise'][] = 'delete';break;
			}
		}
		$tmp = UserRegion::getByIdUser($u->prepareIdUser());
		$regions = array();
		foreach($tmp as $item)
			$regions[] = $item->prepareIdRegion();
		$regions = implode(',',$regions);
		fSession::set(SESSION_ID_USER,$u->prepareIdUser());
		fSession::set(SESSION_REGIONS,$regions);
		fAuthorization::setUserACLs($permissions);
		header('Location: '.SITE);
	}
}
?>
<!DOCTYPE html>
<html>
	
	<head>
	
		<title>Login</title>
		
		<link type="text/css" rel="stylesheet" href="<?php echo CSS ?>login.css" media="all" />
		<script type="text/javascript" src="<?php echo JS ?>jquery.js"></script>
		<script type="text/javascript" src="<?php echo SCRIPT ?>common.js"></script>
		<script type="text/javascript">
		
			$(document).ready(function(){
				
				$('.advice').click(function(){
					$(this).fadeTo(500, 0).slideUp();
				});
			
			});
			
		</script>	
		
	</head>	
		
	<body>	
		
		<div id="bokeh">
		
			<div id="container">
			
				<div style="margin-bottom:50px;" id="header">
					<h1 id="logo">PANEL DE ADMINISTRACION</h1>
					
				</div>
			
				<div id="content">
			
					<div id="login">
						
						<div class="content-box">
							
							<div class="content-box-header">
								<h3>Escriba su informaci&oacute;n de usuario</h3>
							</div>
							
							<?php 
							if (isset($_GET) && isset($_GET['e']) && $_GET['e'] == 1) {
							?>
							<div class="notification error advice" style="margin: 10px 10px 0px 10px;">
								Usuario o Password Incorrecto.
							</div>
							
							<?php } ?>
					
							<div class="content-box-content" style="width:300px;">
						
								<form action="" method="post">
									<p>
										<input id="username" title="Email" class="text" type="text" name="email" style="color: rgb(150, 150, 150); width:250px" value="Email" autocomplete="off" />
									</p>
							<br/><br/>
									<p>
										<input id="password" type="password" name="password" style="color: rgb(150, 150, 150); width:251px" class="text" title="Password" value="Password" autocomplete="off" />
									</p>
							<br/>
									<center><input style="margin-left:120px; width:200px;" type="submit" value="Ingresar al panel" /> </center>
								</form>
							</div>
						</div>
					</div>
											
				</div>
			
				<div id="push"></div>
				
			</div>
			<div id="footer">
					MiMorelia.com | <a href="" target="_blank">Mi ciudad</a> 2012
			</div>
		</div>
		
	</body>
	
</html> 	