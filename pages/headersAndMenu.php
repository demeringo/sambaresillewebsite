<?php include("database.php"); ?>
<?php include("agendaHelper.php"); ?>
<!-- Partie generique du site (bandeaux, menus, news .....) -->	
	<a href="/publicSite/pages">
    <div id="bannerTitle">
		<h1>Samba-Resille</h1>
		<p>a escola de samba de Toulouse</p>
	</div>
	</a>
	<ul id="shortMenu">
		<!--<li><a href="/publicSite/pages/index.php">Retour a l'accueil</a> - </li>-->
		<li><a href="/publicSite/pages/contacts.php">Contacts</a> - </li>
		<li><a href="/publicSite/pages/privateSpace.php">Espace adhérents</a></li>
		</li>
	</ul>
	
	<div id="mainMenu">
	<ul>
		<li><a href="/publicSite/pages/asso.php" title="">L'association</a></li>
		<li><a href="/publicSite/pages/agendaPaged.php" title="">Evenements !</a></li>
		<li><a href="/publicSite/pages/pieuvre/intro.php" title="">La pieuvre</a></li>
		<li><a href="/publicSite/pages/troupe.php" title="">La troupe</a></li>
		
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
	</ul>
	</div>
    
    <div id="news">
		<div id="expo">
      <h1>Kicycol - Expo</h1>
	    <p><a href="/publicSite/pages/stages-expos/kicycol.php">Arts graphiques, du 17 septembre au 24 octobre</a></p>
      <h1>Stage d'initiation Clown</h1>
	    <p><a href="/publicSite/pages/stages-expos/stageClown_Novembre09.php">par l'association Zicomatic les 14 et 15 novembre</a></p>
	    <p>
      <a href="/publicSite/pages/stages-expos/toutVoir.php">Tous les stages et expos</a>
    </p>
	    </div>
	    <hr/>
	    <!--
	    <div>
	    <h1>Le concert (était presque) parfait</h1>
	    <p><a href="/publicSite/pages/residences/concert_presque_parfait.php">La companie "la Muse et l'Hic" en résidence - du 21 au 30 avril.</a></p>
	    <h1>Le vol du manchot</h1>
	    <p><a href="/publicSite/pages/residences/le_vol_du_manchot.php">Sortie de création, par la Matawari Cie, les 1er 2 et 8 mai à 21h.      </a></p>
	    </div>
	    <hr/>
	    -->
    	<div id="shortAgenda">
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
			<!--<br/>
			<a href="http://www.samba-resille.org/publicSite/pages/agenda.xml">Flux RSS</a>-->
			</p>
			<hr/>
		</div>
		<div id="blog">
      	<h1>Le blog</h1>
        <p>
        <a href="http://samba-resille.org/blog/">Photos et réactions !</a>
        </p>
     </div>

		<!--
		<hr/>

					<h1>Telecharger <em>Noticias</em></h1>
				<p>
		<a href="/publicSite/documents/FEVRIER.pdf" type="application/pdf" >La prog. de Fevrier (pdf)</a>
		</p>
		<p>
		<a href="/publicSite/documents/NoticiasNov06.PDF" type="application/pdf" >Les news et la prog. de novembre (pdf)</a>
		</p>
		<p>
		<a href="/publicSite/documents/NoticiasDec06.PDF" type="application/pdf" >Les news et la prog. de decembre (pdf)</a>
		</p>
  -->
	</div>

<!-- Fin de la partie generique-->