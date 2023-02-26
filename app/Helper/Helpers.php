<?php
namespace App\Helper;
Use Response;
use App\Models\User;
include(app_path() . '/sendnotification/firebase.php');
include(app_path() . '/sendnotification/push.php');
Use Firebase;
Use Push;
class Helpers
{
  public static function sendnotification($title,$message,$include_image,$regId){
	if($regId!=""){

	$findappids = User::where('unique_user_id',$regId)->get();

		if(!empty($findappids)){
			foreach($findappids as $app){
				$firebase = new Firebase();
				$push = new Push();
				$push->setTitle($title);
				$push->setMessage($message);
				$push_type='individual';
				if ($include_image!="") {
					$push->setImage('http://api.androidhive.info/images/minion.jpg');
				} else {
					$push->setImage('');
				}
				$push->setIsBackground(FALSE);
				$push->setNotificationType('');
				$json = '';
				$response = '';
				if ($push_type == 'topic') {
					$json = $push->getPush();
					$response = $firebase->sendToTopic('Alltest', $json);
				} else if ($push_type == 'individual') {
					$json = $push->getPush();
					$response = $firebase->send($app->fcm_token, $json);
					print_r($response); die;
				}

			}
		}
	}

}

}
?>
