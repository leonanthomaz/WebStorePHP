<?php

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class enviarEmail {

    public function enviarEmailCadastro($email_cliente, $purl){
        
        $mail = new PHPMailer(true);

        $link = BASE_URL.'?a=confirmar_email&purl='.$purl;

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();                                           
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_FROM;                     
            $mail->Password   = EMAIL_PASS;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
            $mail->Port       = EMAIL_PORT;   
            $mail -> charSet = "UTF-8";                                 

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                 )
                );

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente, 'Leonan');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação de email';
            
            // $html = '
            // <p>Seja bem vindo a nossa loja -' .APP_NAME. '.</p><br><br>
            // <p>Confirme seu email para continuar sua compra!</p>
            // <p>Confirme seu email para continuar sua compra!</p>
            // <p><a href="'.$link.'">Confirmar email</a></p>
            // <p><small>'.APP_NAME.'</small></p>

            // ';
            $html = '<p>Seja bem vindo a nossa loja -' .APP_NAME. '.</p>';
            $html .= '<p>Confirme seu email para continuar sua compra!</p>';
            $html .= '<p></p>';
            $html .= '<p><a href="'.$link.'">Confirmar email</a></p>';
            $html .= '<p><small>'.APP_NAME.'</small></p>';

            $mail->Body = $html;
            
            $mail->send();
            return true;
            echo 'Email enviado com sucesso!';
        } catch (Exception $e) {
            return false;
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}