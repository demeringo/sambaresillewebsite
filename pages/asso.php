<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes.html"); ?>
	<!-- Popup START -->
	<link rel="stylesheet" href="/publicSite/basic-style/popup.css" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript"></script>  
	<script src="../javascript/popup.js" type="text/javascript"></script>  
	<!-- Popup END -->
</head>
<body>

<div id="backgroundPopup" ></div>
<!-- Ajout de la pop up de l'anniversaire -->
<div id="popup">   
	<h1>Du 29 mai au 7 juillet</h1>
	<br/><br/>
	<img width="150" src="../img/18ans/Event.gif" alt="Samba Résille fête ses 18 ans"/>
	<img width="220" src="../img/18ans/Theme.gif" alt="Racines d'alleurs"/>    
    <br/><br/><br/><br/><br/><br/><br/><br/>
    <table>
    <tr>
    <td><a href="18ans.php">Programme complet</a></td><td><a id="popupClose">Accès au site</a></td>
    </tr>
    </table> 
</div>  
<!-- Fin de la pop-up anniversaire -->


<div id="page">
<?php include("headersAndMenu.php"); ?>

<!-- Content div start -->
<div id="content">	

		<h1>Samba Résille: l'association</h1>
		
		<h2>Qui sommes nous ?</h2>
		<img class="right"  alt="le CICC" src="../img/cicc/ciccDevanture.jpg"/>	
		<p>Développée autour de la pratique amateur de la musique brésilienne, l'association Samba Résille s'attache à la rendre accessible aux publics les plus divers.</p>
		<p>Ce collectif oeuvre dans sa ville, dans son quartier et organise ses actions à partir de sa quadra : le <strong>Centre d'Initiative Culturelle et Citoyenne (CICC)</strong>, une maison de la Samba à la française.</p>
		<p>Vous pouvez télécharger <a href="../documents/Statuts_du_15_avril_2007.pdf" type="application/pdf" >nos statuts</a> (pdf).</p>
		
		<h2>Action !</h2>
		<p>Samba Résille agit pour répondre aux objectifs suivants :</p>
	<ul>
		<li>accompagner et développer les <strong>pratiques en amateur</strong> : résidences permanentes de la Troupe Samba Résille et d'une troupe de théâtre de rue, la formule MADJ, mise en place de cours et ateliers de percussions (brésiliennes, orientales, africaines), accueil de musiciens en résidence temporaire et expositions de plasticiens.</li>
		<li>développer des actions d'<strong>éducation artistique</strong> et de <strong>médiation culturelle</strong> en direction de tous publics, milieu scolaire et extrascolaire, publics en difficultés sociales, physiques et autres dans un souci d'<strong>accès à la culture pour tous</strong>.</li>
		<li>proposer des <strong>actions de formation</strong>.</li>
		<li><strong>travailler en réseau.</strong></li>
	</ul>
	<br/>
	<img class="center" alt="Encontro de Marseille" src="../img/Marseille.jpeg"/>

</div>
<!-- fin du contenu spécifique de la page -->

<?php include("footer.html"); ?>


</body>
</html>