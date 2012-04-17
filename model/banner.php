<?php
class Banner extends fActiveRecord {

		protected function configure() {
			fORMDate::configureDateCreatedColumn($this, 'created_at');
			 fORMDate::configureDateUpdatedColumn($this, 'updated_at');
		}
		
	// Return an iterable set of User objects
	public static function findAll() {
		return fRecordSet::build(
			__CLASS__//,                            // Make User objects
//			array('id_role=' => 1)//,      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
	
	public function getResourceType($value){
		$videos =  array('video/mpeg',
						'video/x-mpeg2',
						'video/msvideo',
						'video/quicktime',
						'video/vivo',
						'video/wavelet',
						'video/x-sgi-movie',
						'video/x-flv',
						'video/mp4');
		
		$audio = array('audio/x-wav',
						'audio/x-mp3',
						'audio/midi');
						
		$document = array('application/msword',
						'application/pdf',
						'application/vnd.ms-excel',
						'application/vnd.ms-powerpoint',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'application/vnd.openxmlformats-officedocument.presentationml.presentation',
						'text/plain',
						'text/richtext',
						'text/html');
		
		$images = array('image/gif',
						'image/bmp',
						'image/jpeg',
						'image/pjpeg',
						'image/png');
						
		if(in_array($value,$videos)) return 'v';
		if(in_array($value,$audio)) return 'a';
		if(in_array($value,$document)) return 'd';
		if(in_array($value,$images)) return 'i';
						
		
	}
	
	public static function getImage($id_entity,$id_section) {
		$result = fORMDatabase::retrieve()->unbufferedQuery("SELECT * FROM resource WHERE id_entity='$id_entity' AND id_section='$id_section' AND resource_type='i' LIMIT 1");
		
		foreach($result as $r) return $r['url'];
		
	}
}