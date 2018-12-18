<?php
  //Only process POST requests.
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get form fields and remove whitespaces
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array("",""),$name);
    $email = filter_var(trim($_POST["email"]),FILTER_SANITIZE_EMAIL);//remove all illegal characters from email
    $message = trim($_POST["message"]);
    //check that data was sent to the imagefilter
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)){
      //set a 400 (bad request) response code and exit.
      http_response_code(400);
      echo "Oops! There was a problem with your submission. Please complete the form and try again."
      exit;
    }
    //set the recipient email address.
    //FIXME:update this to your desired email address.
    $recipient = "anum@cockar.com";
    //Set the email subject.
    $subject = "New contact from $name";
    //Build the email content.
    $email_content = "Name:$name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    //Build the email headers.
    $email_headers = "Form:$name<$email>";

    //Send the Email
    if(mail($receipient, $sunject, $email_content, $email_headers))_
    //set a 200(okay) response code.
    http_response_code(200);
    echo "Thankyou! Your message has been sent.";
  }else{
    //Not a POST request, set a 403(forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
  }
 ?>
