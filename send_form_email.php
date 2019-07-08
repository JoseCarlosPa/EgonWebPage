<?php

$pruebas = 1;

if($pruebas == 0){
    if (isset($_POST['send'])){
        include("sendemail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico

        /*Configuracion de variables para enviar el correo*/
        $mail_username="servidoregon@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword="vXVRptU@x4GU";//Tu contraseña de gmail
        $mail_addAddress="Luis.carrillo@egon.com.mx";//correo electronico que recibira el mensaje
        $template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje

        /*Inicio captura de datos enviados por $_POST para enviar el correo */
        $mail_setFromEmail=$_POST['customer_email'];
        $mail_setFromEmpresa=$_POST['empresa'];
        $mail_setFromTelefono=$_POST['telefono'];
        $mail_setFromName=$_POST['customer_name'];
        $txt_message=$_POST['message'];
        $mail_subject=$_POST['subject'];

        sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template,$mail_setFromEmpresa,$mail_setFromTelefono);//Enviar el mensaje
    }
}else{
    $mail_setFromEmail=$_POST['customer_email'];
    $mail_setFromEmpresa=$_POST['empresa'];
    $mail_setFromTelefono=$_POST['telefono'];
    $mail_setFromName=$_POST['customer_name'];
    $txt_message=$_POST['message'];
    $mail_subject=$_POST['subject'];

    $destinatario = "Luis.carrillo@egon.com.mx";
    $asunto = $mail_subject;
    $cuerpo = '
    <html>
        <h1 align="center">Mensaje enviado desde el formulario de contacto de Egon</h1>
        
        <h3 align="center"><b>Empresa:</b> '.$mail_setFromEmpresa.'</h3>
       
        <h3 align="center"><b>Nombre:</b> '.$mail_setFromName.'</h3>
       
        <h3 align="center"><b>Email:</b> '.$mail_setFromEmail.'</h3>
       
        <h3 align="center"><b>Telefono:</b> '.$mail_setFromTelefono.'</h3>
       
        <h3 align="center"><b>Asunto:</b> '.$mail_subject.'</h3>
        
        <h3 align="center"><b>Mensaje:</b> '.$txt_message.'</h3>
    
    
    </html>'
    ;


    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    mail($destinatario,$asunto,$cuerpo,$headers);
    header('Location: contacto.php');
}

?>
