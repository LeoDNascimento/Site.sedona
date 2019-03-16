<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/PHPMailer/src/Exception.php';
require_once 'vendor/PHPMailer/src/PHPMailer.php';
require_once 'vendor/PHPMailer/src/SMTP.php';
require_once 'helpers/validacao.php';

$name = ucwords(strtolower(trim(filter_input(INPUT_POST, 'name'))));
$email = strtolower(trim(filter_input(INPUT_POST, 'email')));
$telefone = filter_input(INPUT_POST, 'tel');
$address = ucwords(strtolower(trim(filter_input(INPUT_POST, 'address'))));
$city = ucwords(strtolower(trim(filter_input(INPUT_POST, 'city'))));
$budget = filter_input(INPUT_POST, 'budget');
$description = trim(filter_input(INPUT_POST, 'description'));
$services1 = filter_input(INPUT_POST, 'services-type1');
$services2 = filter_input(INPUT_POST, 'services-type2');
$services3 = filter_input(INPUT_POST, 'services-type3');
$services4 = filter_input(INPUT_POST, 'services-type4');
$services5 = filter_input(INPUT_POST, 'services-type5');
$services6 = filter_input(INPUT_POST, 'services-type6');
$services7 = filter_input(INPUT_POST, 'services-type7');


/* 
    atividade: pense em algum jeito de pegar aqueles Services, pode fazer do mesmo esquema do budget la na validacao, passa igualzinho e valida 
*/

if(count($_POST)){

    
    if(!validar_nome($name) || !validar_email($email) || !validar_budget($budget) || !validar_mensagem($description) || !validar_cel($telefone || !validar_endereço($address))){
        header('Location: index.php');
        die();
    }

    try  {

        $mail = new PHPMailer(true);
            
        //Server settings
        $mail->setLanguage("en");
        $mail->SMTPDebug = 4;                                 # 
        $mail->isSMTP();                                     // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     //
        $mail->SMTPAuth = true;                                
        $mail->Username = 'leobob2000@gmail.com';     
        $mail->Password = 'ketchup5.0';                           
        $mail->SMTPSecure = 'ssl';                    
        $mail->Port = 465;                                    

        //Recipients
        $mail->setFrom('leobob2000@gmail.com', 'Sedona Homes');
        $mail->addAddress('leobob2000@gmail.com');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Contact " . $name;
        $mail->Body = "<b>E-mail</b>: " . $email . "." . "<br>" .
                      "<b>Address: </b>" . $address . "." . "<br>" .
                      "<b>City: </b>" . $city . "." . "<br>" .
                      "<b>Telephone: </b>" . $telefone . "." . "<br>" .
                      "<b>Budget: </b>" . $budget . "." . "<br>" .
                      "<b>Services: </b>" . $services1 . "," .
                        $services2 . "," .
                        $services3 . "," .
                        $services4 . "," .
                        $services5 . "," .
                        $services6 . "," .
                        $services7 . "<br>" . "<br>" .
                      "<b>Service description: </b>" . $description . ".";
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

    } 

    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

require_once 'views/index.php';