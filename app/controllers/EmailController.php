<?php

class EmailController extends \BaseController {

	public static function send($email) {
		$sendgrid = new SendGrid('borulday', 'Budami71!');
        $mail = new SendGrid\Email();
        $mail->addTo($email)->
               setFrom('wasteful@wasteful.com')->
               setSubject('Do not be wasteful person!')->
               setText('Hello World!')->
               setHtml('<strong>Welcome Wasteful platform. Let\'s learn about how wasteful person you are! <br/><br/></strong>');
        $data = $sendgrid->send($mail);

        // Log::info('EMAIL:', var_dump($data));
        // var_dump($email);
        // return "OK BODY!";
	}

}
