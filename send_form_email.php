<?php
if(isset($_POST['correo'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "daniel.eliasbecerra98@gmail.com";
    $email_subject = "Prueba de correo";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['empresa']) ||
        !isset($_POST['nombre']) ||
        !isset($_POST['correo']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['asunto'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $empresa = $_POST['empresa']; // required
    $nombre = $_POST['nombre']; // required
    $correo = $_POST['correo']; // required
    $telefono = $_POST['telefono']; // not required
    $asunto = $_POST['asunto']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$correo)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$empresa)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$nombre)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($asunto) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    //died($error_message);
  }
 
    $email_message = "Detalles: .\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Empresa: ".clean_string($empresa)."\n";
    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Correo: ".clean_string($correo)."\n";
    $email_message .= "Teléfono: ".clean_string($telefono)."\n";
    $email_message .= "Asunto: ".clean_string($asunto)."\n";
 
// create email headers
$headers = 'From: '.$correo."\r\n".
'Reply-To: '.$correo."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
 
}
?>