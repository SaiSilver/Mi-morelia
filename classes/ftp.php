<?php
/**
 * Upload files trough FTP protocol
 * 
 * @Author Jorge Cedi Voirol
 * @throws Exception
 * 
 * @param  string $username
 * @param  string $password
 * @param  string $server
 * @param  string $port
 * @param  string $pasv
 * @return void
 */
class ftp {
	
	private $server;
	private $username;
	private $password;
	private $port;
	private $pasv;
	private $ftpId;
	
	public function ftp( $username = NULL, $password = NULL, $server = "localhost", $port = 21, $pasv = true){
		$this->username = $username;
		$this->password = $password;
		$this->server = $server;
		$this->port = $port;
		$this->pasv = $pasv;
	}
	
	private function open(){
		
		if(	$this->ftpId = ftp_connect( $this->server, $this->port )){
			if(ftp_login( $this->ftpId, $this->username, $this->password )){
				if(!ftp_pasv( $this->ftpId, $this->pasv)){
					throw new Exception('No se ha podido establecer el modo pasivo.');
				}
			}else{
				throw new Exception('El password o el usuario son incorrectos.');
			}
			return;
		}
		throw new Exception('No se ha podido establecer una conexi&oacute;n.');
	}
	
	public function upload( $localFile, $remoteFile ){
		$this->open();
		
		if( $up = ftp_put( $this->ftpId, $remoteFile, $localFile, FTP_BINARY)){
		 
			$this->close();
			return;
		}
		throw new Exception('Error al subir el archivo.');
	}
	
	private function close(){
		if(!ftp_quit($this->ftpId)) throw new Exception('No se ha podido cerrar la conexi&oacute;n.');
	}
	
}
?>