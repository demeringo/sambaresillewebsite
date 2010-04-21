<?php include("database.php"); ?>
<?php include("agendaHelper.php"); ?>
<!-- Partie generique du site (bandeaux, menus, news .....) -->	
	<a href="/publicSite/pages">
    <div id="bannerTitle"><!-- SART Banner -->
		<h1>Samba-Resille</h1>
		<p>a escola de samba de Toulouse</p>
	</div><!-- END Banner -->
	</a>
	<ul id="shortMenu"> 
		<!--<li><a href="/publicSite/pages/index.php">Retour a l'accueil</a> - </li>-->
		<li><a href="/publicSite/pages/contacts.php">Contacts</a> - </li>
		<li><a href="/publicSite/pages/privateSpace.php">Espace adhérents</a></li>
		</li>
	</ul>
	
	<div id="mainMenu"> <!-- START Main menu -->
	<ul>
		<li><a href="/publicSite/pages/asso.php" title="">L'association</a></li>
		<li><a href="/publicSite/pages/agendaPaged.php" title="">Evenements !</a></li>
		<li><a href="/publicSite/pages/pieuvre/intro.php" title="">La pieuvre</a></li>
		<li><a href="/publicSite/pages/troupe.php" title="">La compagnie</a></li>
		
		<!-- <li><a href="/publicSite/pages/formuleMadj.php" title="">La formule MADJ</a></li> -->
		<li><a href="/publicSite/pages/cours.php" title="">Cours de batucada</a></li>
		<li><a href="/publicSite/pages/chorale_enfants.php" title="">Chorale enfants</a></li>
		<!--<li><a href="/publicSite/pages/coursEnfants.php" title="">Les cours enfant</a></li>
		<li><a href="/publicSite/pages/coursAdultes.php" title="">Les cours adultes</a></li>-->
		<li><a href="/publicSite/pages/mediation.php" title="">La mediation culturelle</a></li>
		<li><a href="/publicSite/pages/cicc.php" title="">Le CICC</a></li>
		<li><a href="/publicSite/pages/links.php" title="">Liens</a></li>
		<li><a href="/publicSite/pages/contacts.php" title="">Contacts</a></li>
		<li><a href="/publicSite/pages/tarifs.php" title="">Tarifs</a></li>
		<li><a href="http://samba-resille.org/blog/">Blog</a></li>
	</ul>
	</div> <!-- END Main menu -->
    
    <div id="news"> <!-- START News -->
		
		<div id="expo"> <!-- START Expo -->
			<h1>Stage de théatre</h1>
			<p><a href="/publicSite/pages/stages-expos/stageTheatre_mai_2010.php">Le Jeu d'Acteur avec Ibrahima Bah les 1er et 2 mai</a></p>

			<p><a href="/publicSite/pages/stages-expos/toutVoir.php">Tous les stages et expos</a></p>
		</div> <!-- END Expo -->
	    <hr/>
	   
    	<div id="shortAgenda"> <!-- START Agenda -->
    		<h1>Derniere minute !</h1>
	        <ul>
  	    	<?php	    	
  	    	$agenda = new agendaHelper($db); // Recupere les 3 prochains evenements
  	    	$comingSoon =$agenda->getCommingEvents(3);
   	    	foreach($comingSoon as $event){   	    	 
  	    	    $eventId=$event["id"];
  	    	    $shortDate=$agenda->displayShortDate($event["date"]);
  	    	    $eventTitle=$event["title"];
  	    	    $pageNum=$agenda->getPageOfEvent($event["id"]);
  	    	    if($eventTitle || $event["date"]){// N'afficher qu'un evenement avec au moins un titre ou une date
  	    	      echo "<li>Le $shortDate <a href=\"/publicSite/pages/agendaPaged.php?currentPage=$pageNum#$eventId\"> $eventTitle</a></li>";
  	    	    }
  	    	}
  	    	?>
  	      	</ul>
			<p>
			<a href="/publicSite/pages/agendaPaged.php">Tous les évènements</a>
			</p>
			<hr>
		</div> <!-- END Agenda -->

		<div id="blog"> <!-- START Blog -->
      		<h1><a href="http://www.myspace.com/sambaresilleplays">myspace  </a>
      		<a href="http://samba-resille.org/blog/">--  blog<h1></a>
    	</div> <!-- END Blog --> 

	</div> <!-- END News -->

<!-- Fin de la partie generique-->
