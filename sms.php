<?php

/*
* BY : KAKHA GIORGASHVILI / WWW.ANY.GE / kakha13@any.ge / @kakha13
*/

$username = @$_POST['user'];		// მეტსახელი
$password = @$_POST['password'];	// ჩვენი პაროლი
$to = @$_POST['to'];				// ნომერი ვისაც ვუგზავნით
$text = @$_POST['text'];			// ტექსტი რასაც ვაგზავნით
$loginUrl = 'http://www.magtifun.ge/index.php?page=11&lang=ge'; // მისამაართი სადაც უნდა გავიაროთ ავტორიზაცია
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$username&password=$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  // არ წაშალოთ მის გარეშე არ იმუშავებს
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');  // არ წაშალოთ მის გარეშე არ იმუშავებს
$answer = curl_exec($ch);

if (curl_error($ch)) {
    echo curl_error($ch)."/n";
}

// გაგზავნა
curl_setopt($ch, CURLOPT_URL, 'http://www.magtifun.ge/scripts/sms_send.php');
curl_setopt($ch, CURLOPT_POSTFIELDS, "recipients=$to&message_body=$text <sms.any.ge>");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name-send'); 
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie-send.txt');
$answer = curl_exec($ch);
if (curl_error($ch)) {
    echo curl_error($ch)."/n";
}

echo $answer;