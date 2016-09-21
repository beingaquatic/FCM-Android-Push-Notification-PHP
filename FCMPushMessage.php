<?php
/*
	Class to send push notifications using Google Firebase/GCM

	Example usage
	-----------------------
	$fcmMsg = new FCMPushMessage($ApiKey);
	echo $fcmMsg->send($message, $title, $icon);
	-----------------------
	
	$ApiKey = Your GCM api key
	$message The mesasge you want to push out
    $title = Title of the notification
    $icon = Icon that will be displayed when showing notification (for Lollipop+ make sure you use a silhouette style icon)
    
    Based on GCMPush class found at:
    https://github.com/mattg888/GCM-PHP-Server-Push-Message

	@author beingaquatic
*/
class FCMPushMessage {
	// the URL of the FCM API endpoint
	private $url = 'https://fcm.googleapis.com/fcm/send';
	private $ApiKey = "";
	
	function FCMPushMessage($ApiKey){
		$this->$ApiKey = $ApiKey;
	}

	/*
		Send the message to specific topic (eg: news)
	*/
	function send($message, $title, $icon){
		
		if(strlen($this->$ApiKey) < 8){
			throw new FCMPushMessageArgumentException("API Key not set");
		}
        
        $notification = array(
			'body'  => $message,
			'title' => $title,
            'icon' => $icon
		);
		
		$fields = array(
			'to'           => "/topics/news",
			'notification' => $notification,
		);

		$headers = array( 
			'Authorization: key=' . $this->$ApiKey,
			'Content-Type: application/json'
		);

		// Open connection
		$ch = curl_init();
		
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $this->url );
		
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		// Avoids problem with https certificate
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
		
		// Execute post
		$result = curl_exec($ch);
		
		// Close connection
		curl_close($ch);
		
		return $result;
	}
}

class FCMPushMessageArgumentException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
