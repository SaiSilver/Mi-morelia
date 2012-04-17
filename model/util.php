<?php
class Util {
	public static function getResourceType($value){
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
	
	public static function array2xml($array, $wrap='news', $element = 'new') {

    $xml = '';
    if ($wrap != null) {
        $xml .= "<$wrap>\n";
    }
	
	foreach($array as $r => $val){
		$xml .= "\t<$element>\n";
		
		foreach ($val as $key=>$value) {
			$xml .= "\t\t<$key>" . htmlspecialchars(trim($value)) . "</$key>\n";
		}
		$xml .= "\t</$element>\n";
	}

    if ($wrap != null) {
        $xml .= "\n</$wrap>\n";
    }
    return $xml;
}
}