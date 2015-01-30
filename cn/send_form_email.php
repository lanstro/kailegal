<?php

mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "inquiry@kailegal.com.au";
 
    $email_subject = "Online Chinese inquiry";
 
    function died($error) {
			// your error code can go here
			echo "对不起，您提交的表格有错误。";
			echo "以下的这些是错误。<br /><br />";
			echo $error."<br /><br />";
			echo "请修改这些错误。<br /><br />";
			die();
    }
 
    // validation expected data exists
 
		if(!isset($_POST['name']) ||
		
		!isset($_POST['email']) ||
		
		!isset($_POST['telephone']) ||
		
		!isset($_POST['comments'])) {
 
        died('对不起，您提交的表格有错误。');      
 
    }
 
     
 
	$name = $_POST['name']; // required
	
	$email_from = $_POST['email']; // required
	
	$telephone = $_POST['telephone']; // not required
	
	$comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= '您输入的电子邮箱不正确。<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(iconv_strlen($name) < 2) {
    $error_message .= '您输入的名字太短。<br />';
  }
 
  if(iconv_strlen($comments) < 2) {
    $error_message .= '你输入的资讯内容太短。<br />';
  }
 
  if(iconv_strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Online inquiry received:\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
  
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers); 
 
?>
 
 
 
<!-- include your own success html here -->

谢谢您的资讯。我们会尽快跟您联系。

请点击 <a href="http://kailegal.com.au">这里</a> 回首页。
 
<?php
 
}
 
?>