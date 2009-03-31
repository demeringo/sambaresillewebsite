<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes-black.html"); ?>
	 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
       <title>S'abonner � la neswletter</title>
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
|      DATE : 2007.08.31                                     |
|     EMAIL : webmaster@web-kreation.com                     |
|  DOWNLOAD : http://web-kreation.com/index.php/freebies/    |
|____________________________________________________________|
-->

  


     <div id="contentForm">

            <!-- The contact form starts from here-->
            <?php
                 $error    = ''; // error message
                 $name     = ''; // sender's name
                 $email    = 'votre_email@aaa.a'; // sender's email address
                 $subject  = ''; // subject
                 $message  = ''; // the message itself
               	 $spamcheck = ''; // Spam check

            if(isset($_POST['send']))
            {
                 $name     = $_POST['name'];
                 $email    = $_POST['email'];
                 //$subject  = $_POST['subject'];
                 //$message  = $_POST['message'];
               	 $spamcheck = $_POST['spamcheck'];

                /*if(trim($name) == '')
                {
                    $error = '<div class="errormsg">Please enter your name!</div>';
                }
            	  else */
            	  if(trim($email) == '')
                {
                    $error = '<div class="errormsg">Entrez un email.</div>';
                }
                else if(!isEmail($email))
                {
                    $error = '<div class="errormsg">Entrez un email valide.</div>';
                }
                if($error == '')
                {
                   /* if(get_magic_quotes_gpc())
                    {
                        $message = stripslashes($message);
                    }
                    */
                    // the email will be sent here
                    // make sure to change this to be your e-mail
                    $to      = "newsletter-samba-resille-subscribe@yahoogroupes.fr";

                    
                    //$subject = '[Contact Form] : ' . $subject;
                    $subject = 'Inscription a la newsletter';

                    // the mail message ( add any additional information if you want )
                    //$msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Message : \r\n$message";
                    $msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Inscription depuis le site de Samba Resille.";

                    mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
            ?>

                  <!-- Message sent! (change the text below as you wish)-->
                  <div style="text-align:center;">
                    <h1 style="color: green">Inscription enregistr�e.</h1>
                       <p>Vos allez bientot recevoir la newsletter par email.</p>
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
            <h1>S'abonner � la newsletter</h1>
            <br/>
            <p>Pour recevoir r�guli�rement la programmation.</p>
            <br/>
            <!--Error Message-->
            <div style="color: red">
            <?=$error;?>
            </div>
            <br/>

            <form  method="post" name="contFrm" id="contFrm" action="">


                  <!--<label><span class="required">*</span> Nom:</label>
            			<input name="name" type="text" class="box" id="name" size="30" value="<?=$name;?>" />
-->
            			<label><!--<span class="required">*</span>--> Email: </label>
            			<input name="email" type="text" class="box" id="email" style='font-size:130%' size="30" value="<?=$email;?>" />

            		<!--	<label><span class="required">*</span> Spam Check: <b>2 + 3=</b></label>
						<input name="spamcheck" type="text" class="box" id="spamcheck" size="4" value="<?=$spamcheck;?>" /><br /><br />
-->
            			<!-- Submit Button-->
                 		<input name="send" type="submit" class="button" id="send" value="Inscription" />

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
            <p>Votre email n'est utilis� que dans le cadre de cette newsletter, il ne sera pas diffus� � de tierces parties.</p><br/>
            <p>Vous pouvez vous d�sabonner en envoyant un email � <a href="mailto:newsletter-samba-resille-desabonnement@yahoogroupes.fr">newsletter-samba-resille-desabonnement@yahoogroupes.fr</a> <br/>ou en utilisant le lien dans les emails recus.</p>
            <br/>
            </div>
           <!-- <br/>
            <br/>
            <br/>
            <br/>
            <br/>-->
          <!--  <p style="text-align:right;font-size:small">Formulaire inspir� par <a href="http://web-kreation.com/index.php/freebies/" title="Download the Contact form">http://web-kreation.com</a>.</p>-->
     
     </div> <!-- /contentForm -->

</div>     
</body>
</html>
