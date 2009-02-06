<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes-black.html"); ?>
	
	<!-- Calendar pop up -->
	<script language="javascript" type="text/javascript" src="/publicSite/javascript/CalendarPopup.js"></script>
	<script language="JavaScript" id="js4">
    var cal = new CalendarPopup();
    cal.setWeekStartDay(1);
    </script>

	<!-- tinyMCE to edit articles (all textareas in fact ?) -->
	<script language="javascript" type="text/javascript" src="/publicSite/javascript/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
  <script language="javascript" type="text/javascript">
    tinyMCE.init({
    	  // General options
      	mode : "textareas",
      	theme : "advanced",
      	skin :"o2k7",
      	skin_variant : "black",
      	plugins : "safari,style,layer,table,advhr,advimage,advlink,iespell,preview,media,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template,fullscreen",
      
      	// Theme options
      	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,|,forecolor,backcolor,|,bullist,numlist,",
      	theme_advanced_buttons2 : "undo,redo,removeformat,|,blockquote,charmap,nonbreaking,|,link,unlink,image,|,cleanup,code,|,help,fullscreen,",
      	theme_advanced_buttons3 : "",
      	theme_advanced_toolbar_location : "top",
      	theme_advanced_toolbar_align : "left",
      	theme_advanced_statusbar_location : "bottom",
      	theme_advanced_resizing : true,
      
        // Styling
        body_class : "agenda",
      	// Example content CSS (should be your site CSS)
      	content_css : "/publicSite/basic-style/styles-black.css",
      
      	// Drop lists for link/image/media/template dialogs
      	template_external_list_url : "lists/template_list.js",
      	external_link_list_url : "lists/link_list.js",
      	external_image_list_url : "lists/image_list.js",
      	media_external_list_url : "lists/media_list.js",

    });
  </script>

</head>
<body>
<div id="page">
<?php include("headersAndMenu.php"); ?>
<?php include("updateRss.php"); ?>

<!-- Fin de la partie générique-->

<!-- début du contenu spécifique à la page -->

<!-- edition page of an event -->

<?php
function savePictureFile($originalFileName, $eventId){
	
}

?>
<div id="content" class="black-background">	
		<div class="page-title">
		  <h1>Evénements !</h1>
    </div>

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
			
			<input id="date" type="text" size="10" name="date" value='<?php echo $date ?>'/>
			<a href="#" onclick="cal.select(document.forms[0].date,'anchor4','dd/MM/yyyy'); return false;"
			title="cal.select(document.forms[0].date,'anchor4','dd/MM/yyyy'); return false;" 
			name="anchor4" id="anchor4">Cal.</a>

			---  
			<input id="time" type="text" size="5" name='time' value='<?php echo $time ?>'/>
			<p>Date (21/11/2008) --- Heure (20:00)<p>
			
			<input id="title" size="70" name="title" value='<?php echo $title ?>'/>
			<textarea id="editEventText" name="text" cols="60" rows="20" ><?php echo $text ?></textarea><br/>
			
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
