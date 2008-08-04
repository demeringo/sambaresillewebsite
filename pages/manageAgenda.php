<?php
include "config/auth-config.php";
include "security/authcheck.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes-black.html"); ?>
</head>
<body>
<div id="page">
<?php include("headersAndMenu.php"); ?>

<!-- début du contenu spécifique à la page -->
<div id="content">	
<h1>Gestion des événements</h1>


<form method="POST" action="event.php">
	<input type="hidden" name="actionType"/>
	<input type="hidden" name="eventId" />
	<a onclick='document.forms[0].eventId.value="";document.forms[0].actionType.value="createEvent";document.forms[0].submit();'>
	Ajoutter un nouvel evenement</a>
	<?php
	$helper=new agendaHelper($db);
	if($events=mysql_query("select * from event order by date desc")){
		while($event=mysql_fetch_object($events)){
			$eventId=$event->id;
			$title=$event->title;
			$date=$event->date;
			$time=$event->time;
			$text=$event->text;
			$pictureFile=$event->pictureFile;
			$pictureSize=$event->pictureSize;
			?>			
			<div class="agenda" id='<?php echo "$eventId" ?>'>
		    	<h3><?php echo $helper->displayDate($date)." --- ".$helper->displayTime($time)?></h3>
		    	<h2><?php echo "$title" ?></h2>
		    	<?php if(!empty($pictureFile)){?>
		    		<img class="right" alt="<?php echo "$title" ?>" src="../img/agenda/<?php echo "$pictureFile" ?>"/>
		    	<?php } ?>
		    	<p><?php echo nl2br($text); ?></p>
		    	<br/>
		    	<br/>
		    	<a onclick='document.forms[0].eventId.value="<?php echo $eventId ?>";document.forms[0].actionType.value="editEvent";document.forms[0].submit();'>
		    	Modifier cet evenement</a> ou 
				<a onclick='if (confirm("Detruire definitivement cet evenement ?") ) { document.forms[0].eventId.value="<?php echo $eventId ?>";document.forms[0].actionType.value="deleteEvent";document.forms[0].submit();}'>
				Detruire cet evenement</a>	
			</div>
			<?php
		}
	}else{
		echo "DB error";
	}
	?>
</form>	

	</div>
<!-- fin du contenu spécifique de la page -->

<?php include("footer.html"); ?>
</body>
</html>