Google Firebase Notification Sender PHP Server Class

A PHP class to send messages to all devices that have the app implementing Google Firebase messaging. Firebase uses Google Cloud Messaging (GCM) but has different syntax than the traditional GCM.

See: https://firebase.google.com/docs/

Example usage
-----------------------
$fcmMsg = new FCMPushMessage($ApiKey);
echo $fcmMsg->send($message, $title, $icon);
-----------------------

$ApiKey = Your Google Cloud Messaging Server API Key
$message The mesasge you want to push out
$title = Title of the notification
$icon = Icon that will be displayed when showing notification (for Lollipop+ make sure you use a silhouette style icon)

To get the Google API Key, login to https://console.firebase.google.com/ and create a project and get the server key from "CLOUD MESSAGING" tab.
