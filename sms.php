<?php

/*
* BY : KAKHA GIORGASHVILI / WWW.ANY.GE / kakha13@any.ge / @kakha13
*/

$username = @$_POST['user'];		// მეტსახელი
$password = @$_POST['password'];	// ჩვენი პაროლი
$to = @$_POST['to'];				// ნომერი ვისაც ვუგზავნით
$text = @$_POST['text'];			// ტექსტი რასაც ვაგზავნით
 
 
function magtifun_function_sms($username,$password,$to, $text) {
	// აუტორიზაცია
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://www.magtifun.ge/index.php?page=11&lang=ge' );	
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$username&password=$password");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $a='cookie-name_INFO'.rand(1,9999)	  );	// ამის გარეშე არ იმუშავებს
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie-file_INFO'.rand(1,9999).'.ext');	// ამის გარეშე არ იმუშავებს
	curl_exec($ch);		
	if (curl_error($ch)) {	echo "LOGIN_CURL_ERROR:".curl_error($ch)."\n";	}
	// გაგზავნა
	curl_setopt($ch, CURLOPT_URL, 'http://www.magtifun.ge/scripts/sms_send.php');
	curl_setopt($ch, CURLOPT_POSTFIELDS, "recipients=$to&message_body=$text");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $b='cookie-name_SEND'.rand(1,9999) ); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie-file_SEND'.rand(1,9999).'.ext');
	$answer = curl_exec($ch);
	if (curl_error($ch)) {	echo "SENDING_CURL_ERROR:".curl_error($ch)."\n";	}
	curl_close ( $ch ); @unlink($a); @unlink($b);
	return $answer;
}

echo magtifun_function_sms($username,$password,$to, $text);
