<?php

// Email address verification
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if($_POST) {

    // Enter the email where you want to receive the message
    $emailTo = 'info@tvphone.online';

    $clientName = addslashes(trim($_POST['username']));
    $clientEmail = addslashes(trim($_POST['email']));
    $message = addslashes(trim($_POST['message']));

    $array = array('nameMessage' => '', 'emailMessage' => '', 'messageMessage' => '');

    if($clientName == '') {
        $array['nameMessage'] = 'Empty name!';
    }
    if(!isEmail($clientEmail)) {
        $array['emailMessage'] = 'Invalid email!';
    }
    
    if($message == '') {
        $array['messageMessage'] = 'Empty message!';
    }
    if($clientName != '' && isEmail($clientEmail) && $message != '') {
        // Send email
		$headers = "From: " . $clientEmail . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
		if(mail($emailTo,"(TVphone_V3) Message from: " . $clientName, $message, $headers)){
             $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
             }
        else {
        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
            }
    }

    // echo json_encode($array);

}

?>
