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
<div id="content" class="black-background">	
		<div class="page-title">
		  <h1>Evénements !</h1>
		 
    </div>
     <p class="right"><a href="eventsFeed.php">La prog en RSS</a>&nbsp;<img width="16" src="../basic-style/img/small-rss.gif">
     <br/>
     <a href="mailingList.php" style='font-size:130%; color:red'>Recevoir la prog par mail</a>&nbsp;<img width="16" src="">
     </p>

       <p class="right"></p>



<!-- Navigation entre les pages d'agenda -->
<div style="text-align:center">
  <?php
   if($agenda->isLastPage() ){ ?>
      Avant   
    <?php }else{ ?>
      <a href="agendaPaged.php?currentPage=<?=$agenda->getNextPage()?>">Avant</a>    
    <?php }
  if($agenda->isFirstPage()){ ?>
     &nbsp; &nbsp; Après
    <?php } else{ ?>
      &nbsp; &nbsp; <a href="agendaPaged.php?currentPage=<?=$agenda->getBeforePage()?>">Après</a>
    <?php }
   if ($agenda->isLastPage()){ ?>
   <p><a href="agendaOld.php">Accès aux archives</a></p>
   
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
     &nbsp; &nbsp; Après
    <?php } else{ ?>
      &nbsp; &nbsp; <a href="agendaPaged.php?currentPage=<?=$agenda->getBeforePage()?>">Après</a>
    <?php }
   if ($agenda->isLastPage()){ ?>
   <p><a href="agendaOld.php">Accès aux archives</a></p>
   <?php } ?>
</div>
 <p class="right"><a href="eventsFeed.php">La prog en RSS</a>&nbsp;<img width="16" src="../basic-style/img/small-rss.gif">
 <br/>
      <a href="mailingList.php" style='font-size:130%; color:red'>Recevoir la prog par mail</a>&nbsp;<img width="16" src="">
 </p>



    
<!--
		 <div class="agenda" >
			<h2>02/09/2006: Un site neuf !</h2>
			<p>Tout nouveau, tout beau, le site de SR fait peau neuve. Un grand merci à Greg dont la maquette réalisée l'année dernière a fait gagner un temps précieux.
			</p>
		</div>
-->
	</div>

  
<?php include("footer.html"); ?>
</body>
</html>