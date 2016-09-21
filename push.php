<?php
include "FCMPushMessage.php";
$ApiKey = "YOUR GCM API KEY";
$message = "Test Notification Body";
$title = "Test Notification Title";

//you could use ic_launcher for pre-lollipop since it supports color icons
//ic_silhouette file should exist on your app's drawables
$icon = "ic_silhouette";

$fcmMsg = new FCMPushMessage($ApiKey);

echo $fcmMsg->send($message, $title, $icon);
