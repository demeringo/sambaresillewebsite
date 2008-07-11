<?php 
include("basicPageHeader.html"); 
?>
<?php 
include("headersAndMenu.php"); 
?>
<?php include("updateRss.php"); ?>

<!-- Fin de la partie générique-->

<!-- début du contenu spécifique à la page -->

<!-- edition page of an event -->

<?php
function savePictureFile($originalFileName, $eventId){
	
}

?>
<div id="content">
<h1>Edition d'un évenement</h1>	
<?php
$helper=new agendaHelper($db);

if(!empty($_POST)){
	$eventId=$_POST['eventId'];
	$actionType=$_POST['actionType'];
	if($actionType=='deleteEvent' ){
		$request="delete from event where id=\"$eventId\" ";
		mysql_query($request);
		updateRssFile(); 
		?>	
		<p>Evenement détruit.</p>
		<p>Retour à la page de <a href="manageAgenda.php" >gestion de l'agenda</a>.</p>
		<?php		
	}elseif($actionType=='saveEvent'){
		$title=$_POST['title'];
		$date=$_POST['date'];
		$time=$_POST['time'];
		$text=$_POST['text'];
		$pictureFile=$_POST['pictureFile'];
		$pictureSize=$_POST['pictureSize'];
		$fichier="";
		//Valid data here
		$validData= ( !empty($title) && !empty($text) );
		if($validData){
			// Save to DB
			$sqlDate=$helper->formatDateToSql($date);  
			if(!empty($_POST['eventId'])){//When the event has an ID, it means we should update it
				$request="update event set title = \"$title\", text=\"$text\", date=\"$sqlDate\", time=\"$time\" where id=\"$eventId\"  ";
			}else{//The event has no id, we should create a new one
				$request="insert into event(title,text,date,time) values(\"$title\", \"$text\",\"$sqlDate\",\"$time\") ";
				
			}
			if($results=mysql_query($request) ){// Save the event to db
				if(empty($eventId)){
							$eventId=mysql_insert_id();
						}
				// Try to retrieve it from db (just after save)to avoid the adding of slashes when retrieving post for 2d time
				if($events=mysql_query("select * from event where id=$eventId")){//Retrieve the event from DB
					while($event=mysql_fetch_object($events)){
						$title=$event->title;
						$date=$helper->displayDate($event->date);
						$time=$helper->displayTime($event->time);
						$text=$event->text;	
						}
				}
				//Remove old picture file if needed
				if( !empty($_POST['deleteImage'])){
					if(empty($pictureSize)){$pictureSize="200";}
					$request="update event set pictureFile=\"\", pictureSize=\"$pictureSize\" where id=\"$eventId\"  ";
					mysql_query($request);
				}	
				// Save the picture file if exists
				if( strlen($_FILES['pictureFile']['name'])>0 ){ 
					$dossier = '../img/agenda/'; 
					//recupérer l'extension
	$fichier = basename($_FILES['pictureFile']['name']); ; 
					$extension = strrchr($_FILES['pictureFile']['name'], '.'); 
					$extensions = array('.png', '.gif', '.jpg', '.jpeg'); 
					//Début des vérifications de sécurité... 
					if(!in_array($extension, $extensions)){ 
						$erreur = 'Vous devez uploader un fichier de type image (png, gif, jpg, jpeg...)'; 
					} 
					if(!isset($erreur)){ 
						//On formate le nom du fichier ici... 
						$fichier = strtr($fichier, 
							'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
							'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
						$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); 
						
						$fichier = "$eventId-$fichier";
						$request="update event set pictureFile=\"$fichier\" where id=\"$eventId\"  ";
						mysql_query($request);
						move_uploaded_file($_FILES['pictureFile']['tmp_name'], $dossier . $fichier);
					}else{ 
						echo $erreur; 
					} 
				}
				// Releod from db
				if($events=mysql_query("select * from event where id=$eventId")){//Retrieve the event from DB
					while($event=mysql_fetch_object($events)){
						$title=$event->title;
						$date=$helper->displayDate($event->date);
						$time=$helper->displayTime($event->time);
						$text=$event->text;	
					}
				}
				updateRssFile(); 
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
	}elseif($actionType=='editEvent'){
		if($events=mysql_query("select * from event where id=$eventId")){//Retrieve the event from DB
			while($event=mysql_fetch_object($events)){
					$title=$event->title;
					$date=$helper->displayDate($event->date);
					$time=$helper->displayTime($event->time);
					$text=$event->text;	
			}
		}else{// no result found
			$pictureSize="100";//Default size for a new event 
		}
	}
	if( $actionType=='editEvent' || $actionType=='createEvent' || $actionType=='saveEvent' ){
		?>
		<div class="agenda">
		<form name="myEvent" method="POST" action="event.php" enctype="multipart/form-data"> 
			<input type="hidden" name="actionType" value="saveEvent"/>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
			<input type="hidden" name="eventId" value='<?php echo $eventId ?>'/>
			<h3>Titre: <input type="text" size="70" name="title" value='<?php echo $title ?>'/></h3><br/> 
			<h3>Date (ex: 21/11/2008) : <input type="text" name="date" value='<?php echo $date ?>'/></h3><br/>
			<h3>Heure (ex: 20:00): <input type="text" name='time' value='<?php echo $time ?>'/></h3><br/> 
			<h3>Texte: </h3><textarea name="text" cols="70" rows="20" ><?php echo $text ?></textarea><br/>
			<br/>
			<fieldset>
					<legend>Image</legend>
					Image : <input type="file" name="pictureFile"><br/>
					Taille (pixels): <input type="text" name="pictureSize" value='<?php echo $pictureSize ?>'/><br/>
			<?php
			if($actionType=='updateEvent'){
				?>
				<input name="deleteImage" type="checkbox">Enlever l'image actuelle</input><br/> 
			<?php	
			}
			?>
			</fieldset>
			<br/>
			<br/>
			<input type="submit" value="Sauver" /> 
			<input type="reset" value="Rétablir" /> 
		</form>
		</div> 
		<?php
	}
}
?>
<br/>
<br/>
<br/>
<br/><br/>

<br/>
<br/>
<br/>
</div>	
