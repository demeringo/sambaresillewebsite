<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes-black.html"); ?>
	 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
       <title>S'abonner à la neswletter</title>
       <meta name="author" content="Jeremie Tisseau" />
       <meta name="copyright" content="Copyright (c) Web-Kreation 2007" />
       <meta name="website" content="http://web-kreation.com" />
       
       <!-- the cascading style sheet-->
       <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">

<!--
 ____________________________________________________________
|                                                            |
|    DESIGN : Jeremie Tisseau { http://web-kreation.com }    |
|             adapted by odm                                 |
|      DATE : 2007.08.31                                     |
|     EMAIL : webmaster@web-kreation.com                     |
|  DOWNLOAD : http://web-kreation.com/index.php/freebies/    |
|____________________________________________________________|
-->

  


     <div id="contentForm">

            <!-- The contact form starts from here-->
            <?php
                 $error    = ''; // error message
                 $to      = "newsletter-samba-resille-subscribe@yahoogroupes.fr"; // email recipient
                 $bcc     ='webmaster@samba-resille.org;olivierdm@yahoo.fr';// BCC recipients (leave it empty, multiples addresses separated by ; )
                 $name     = ''; // sender's name
                 $email    = 'email'; // sender's email address
                 $subject  = 'Inscription a la newsletter';
                 $message  = ''; // the message itself

            if(isset($_POST['send']))
            {
                 $name     = $_POST['name'];
                 $email    = trim($_POST['email']);

            	  if(trim($email) == '')
                {
                    $error = '<div class="errormsg">Entrez un email.</div>';
                }
                else if(!isEmail($email))
                {
                    $error = '<div class="errormsg">Vérifiez l\'email</div>';
                }
                if($error == ''){  
                   
                    //$msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Message : \r\n$message";
                    $msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Inscription depuis le site de Samba Resille.";
                    
                    $additionalsheaders= "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n";
                    if (trim($bcc) != ''){
                      $additionalsheaders.="Bcc: $bcc\r\n";
                    }
                    
                    //mail($to, $subject, $msg, $headers);
            ?>
                  <!-- Message sent! (change the text below as you wish)-->
                  <div style="text-align:center;">
                    <h1>Merci !</h1>
                    <br/>
                    <br/>
                       <h3>Vos allez recevoir un mail de confirmation.</h3>
                       <br/>
                       <br/>
                       <br/>
                       <p><a href="http://samba-resille.org/">Retour au site</a></p>
                  </div>
                  <!--End Message Sent-->


            <?php
                }
            }

            if(!isset($_POST['send']) || $error != '')
            {
            ?>
            <div style="text-align:center;">
            <h1>S'inscrire à la newsletter</h1>
            <br/>
            <br/>
            
            <!--Error Message-->
            <div style="color: red">
            <?=$error;?>
            </div>
            <br/>

            <form  method="post" name="contFrm" id="contFrm" action="">
            		  <input name="email" type="text" class="box" id="email" style='font-size:150%' size="25" value="<?=$email;?>" />             		                   	<input name="send" type="submit" class="button" id="send" value="Inscription" /> Pour recevoir régulièrement la programmation.

            </form>

            <!-- E-mail verification. Do not edit -->
            <?php
            }

            function isEmail($email)
            {
                return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
                        ,$email));
            }
            ?>
            <!-- END CONTACT FORM -->

            <p>&nbsp;</p>
            <p >Votre email n'est utilisé que pour envoyer cette newsletter, il n'est pas diffusé.<br/>
            Vous pouvez vous désabonner via <a href="mailto:newsletter-samba-resille-desabonnement@yahoogroupes.fr">newsletter-samba-resille-desabonnement@yahoogroupes.fr</a> <br/>ou en utilisant le lien dans les emails recus.</p>
            <br/>
            </div>
           <!-- <br/>
            <br/>
            <br/>
            <br/>
            <br/>-->
          <!--  <p style="text-align:right;font-size:small">Formulaire inspiré par <a href="http://web-kreation.com/index.php/freebies/" title="Download the Contact form">http://web-kreation.com</a>.</p>-->
     
     </div> <!-- /contentForm -->

</div>     
</body>
</html>
