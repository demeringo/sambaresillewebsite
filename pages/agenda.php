<?php include("basicPageHeader.html"); ?>
<?php include("headersAndMenu.php"); ?>

<!-- Fin de la partie g�n�rique-->

<!-- d�but du contenu sp�cifique � la page -->
	<div id="content">	
		<h1>Ev�nements !</h1>
		 <!--
        <div class="agenda">
            <h3>La_date</h3>
            <h2>Le_titre</h2>
            <p>Description</p>
        </div>
        -->

<?php
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
		    	<h3><?php echo displayDate($date)." --- ".displayTime($time)?></h3>
		    	<h2><?php echo "$title" ?></h2>
		    	<?php if(!empty($pictureFile)){

		    		?>
		  
		    		<img class="right" alt="<?php echo "$title" ?>" src="../img/agenda/<?php echo "$pictureFile" ?>"/>
		    	<?php } ?>
		    	<p><?php echo nl2Br($text); ?></p>
			</div>
			<?php
		}
	}else{
		echo "DB error";
	}
	?>

		<p>
		<a href="agendaOld.php">Les �venements pr�cedents</a>
		</p>
<!--
		 <div class="agenda" >
			<h2>02/09/2006: Un site neuf !</h2>
			<p>Tout nouveau, tout beau, le site de SR fait peau neuve. Un grand merci � Greg dont la maquette r�alis�e l'ann�e derni�re a fait gagner un temps pr�cieux.
			</p>
		</div>
-->
	</div>
<!-- fin du contenu sp�cifique de la page -->

<?php include("footer.html"); ?>
</body>
</html>