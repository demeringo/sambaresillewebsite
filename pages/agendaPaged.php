<?php include("basicPageHeaderBlack.html"); ?>
<?php include("headersAndMenu.php"); ?>
<!-- Fin de la partie g�n�rique-->

<!-- d�but du contenu sp�cifique � la page -->
<div id="content" class="black-background">	
		<div class="page-title">
		  <h1>Ev�nements !</h1>
    </div>

<!-- Navigation entre les pages d'agenda -->
<div style="text-align:center">
  <?php
   if($agenda->isLastPage() ){ ?>
      Avant   
    <?php }else{ ?>
      <a href="agendaPaged.php?currentPage=<?=$agenda->getNextPage()?>">Avant</a>    
    <?php }
  if($agenda->isFirstPage()){ ?>
     &nbsp; &nbsp; Apr�s
    <?php } else{ ?>
      &nbsp; &nbsp; <a href="agendaPaged.php?currentPage=<?=$agenda->getBeforePage()?>">Apr�s</a>
    <?php }
   if ($agenda->isLastPage()){ ?>
   <p><a href="agendaOld.php">Acc�s aux archives</a></p>
   <?php } ?>
</div>


<?php
$events=$agenda->getEventsForCurrentPage();
foreach($events as $event){
    //echo "displaying page $currentPage (events from $minEvent to $maxEvent)";  
    $eventId=$event["id"];
			$title=$event["title"];
			$date=$event["date"];
			$time=$event["time"];
			$text=$event["text"];
			$pictureFile=$event["pictureFile"];
			$pictureSize=$event["pictureSize"];
			if($title || $date){// N'afficher qu'un evenement avec au moins un titre ou une date
						?>			
			<div class="agenda" id='<?php echo "$eventId" ?>'>
		    	<h3><?php echo $agenda->displayDate($date)." --- ".$agenda->displayTime($time)?></h3>
		    	<h2><?php echo "$title" ?></h2>
		    	<?php if(!empty($pictureFile)){?>
		    		<img class="right" alt="<?php echo "$title" ?>" src="../img/agenda/<?php echo "$pictureFile" ?>"/>
		    	<?php } ?>
		    	<p><?php echo nl2Br($text); ?></p>
			</div>
  <?php
			}  
  }
?>

<div style="text-align:center">
  <?php
   if($agenda->isLastPage() ){ ?>
      Avant   
    <?php }else{ ?>
      <a href="agendaPaged.php?currentPage=<?=$agenda->getNextPage()?>">Avant</a>    
    <?php }
  if($agenda->isFirstPage()){ ?>
     &nbsp; &nbsp; Apr�s
    <?php } else{ ?>
      &nbsp; &nbsp; <a href="agendaPaged.php?currentPage=<?=$agenda->getBeforePage()?>">Apr�s</a>
    <?php }
   if ($agenda->isLastPage()){ ?>
   <p><a href="agendaOld.php">Acc�s aux archives</a></p>
   <?php } ?>
</div>


    
<!--
		 <div class="agenda" >
			<h2>02/09/2006: Un site neuf !</h2>
			<p>Tout nouveau, tout beau, le site de SR fait peau neuve. Un grand merci � Greg dont la maquette r�alis�e l'ann�e derni�re a fait gagner un temps pr�cieux.
			</p>
		</div>
-->
	</div>

  
<?php include("footer.html"); ?>
</body>
</html>