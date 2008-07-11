<?php 
//include("basicPageHeader.html"); 
?>
<?php 
//include("headersAndMenu.php"); 
?>


<!-- Fin de la partie générique-->

<!-- début du contenu spécifique à la page -->
<?php include("database.php"); ?>
<!-- edition page of an event -->
<?php 
//include("debugForms.php"); 
?>

<div id="content">
<h1>Edition d'un évenement</h1>	
<?php
if(!empty($_POST)){
	$eventId=$_POST['eventId'];
	$actionType=$_POST['actionType'];
	if($actionType=="deleteEvent"){
		?>
		<p>Evenement détruit.</p>
		<p>Retour à la page de <a href="manageAgenda.php" >gestion de l'agenda</a>.</p>
		<?php		
	}elseif($actionType=="saveEvent"){
		$title=$_POST['title'];
		$date=$_POST['date'];
		$time=$_POST['time'];
		$text=$_POST['text'];
		$pictureFile=$_POST['pictureFile'];
		$pictureSize=$_POST['pictureSize'];
		//Valid data here
		$validData= ( !empty($title) && !empty($text) );
		if($validData){
			if(!empty($_POST['eventId'])){//When the event has an ID, it means we should update it
				$request="update event set title = \"$title\", text=\"$text\" where id=\"$eventId\"  ";
			}else{//The event has no id, we should create a new one
				$request="insert into event(title,text) values(\"$title\", \"$text\") ";
			}
			if($results=mysql_query($request) ){// Save the event to db
				?>
				<p>La modification est sauvée.</p>
				<p>Retour à la page de <a href="manageAgenda.php" >gestion de l'agenda</a>.</p>
				<?php
			}else{				
				echo("<p>Erreur pendant l'enregistrement (query: $request)</p>");		
			}	
		}else{
			echo("<p>Erreur dans les données</p>");	
		}		
	}elseif($actionType=="editEvent"){
		if($events=mysql_query("select * from event where id=$eventId")){//Retrieve the event from DB
			while($event=mysql_fetch_object($events)){
					$title=$event->title;
					$date=$event->date;
					$time=$event->time;
					$text=$event->text;	
			}
		}else{// no result found
			$pictureSize="100";//Default size for a new event 
		}
	}
	if($actionType=="editEvent" || $actionType=="saveEvent"){
		?>
		<form name='myEvent' method="POST" action="event.php" enctype="multipart/form-data"> 
			<input type="hidden" name="actionType" value="saveEvent"/>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
			<input type="hidden" name="eventId" value='<?php echo $eventId ?>'/>
			title: <input type="text" size="100" name='title' value='<?php echo $title ?>'/><br/> 
			date: <input type="text" name='date' value='<?php echo $date ?>'/>
			<!-- Calendar component -->
			<a href="javascript: void(0);" onmouseover="if (timeoutId) clearTimeout(timeoutId);window.status='Show Calendar';return true;" onmouseout="if (timeoutDelay) calendarTimeout();window.status='';" onclick="g_Calendar.show(event,'myEvent.date',false); return false;"><img src="calendar/calendar.gif" name="imgCalendar" width="34" height="21" border="0" alt=""></a>
			<br/>
			time: <input type="text" name='time' value='<?php echo $time ?>'/><br/> 
			text: <textarea name="text" cols="50" rows="20" ><?php echo $text ?></textarea><br/>
			<?php
			if($actionType=="createEvent"){?>
				<fieldset>
					<legend>Images</legend>
					Image : <input type="file" name="picture" value='<?php echo $pictureFile ?>'/><br/>
					Taille (pixels): <input type="text" name="pictureSize" value='<?php echo $pictureSize ?>'/><br/> 
				</fieldset>
			<?php}?>
			<input type="submit" value="Sauver" /> 
			<input type="reset" value="Rétablir" /> 
		</form> 
		<?php
	}
}
?>
</div>	
