<?php include("database.php"); ?>
<?php


// This file is used to Generate agenda.xml (RSS feed for the Samba resille agenda)
function updateRssFile(){
    $helper=new agendaHelper($db);
    // édition du début du fichier XML
    $xml = '<?xml version="1.0" encoding="iso-8859-1"?><rss version="2.0">';    $xml .= '<channel>';     $xml .= '<title>Samba Résille - Evenements</title>';    $xml .= '<link>http://www.samba-resille.org</link>';    $xml .= '<description>Evènements à venir chez Samba Résille</description>';
    
    if($events=mysql_query("select * from event order by date desc")){
    		while($event=mysql_fetch_object($events)){
    			$eventId=$event->id;
    			$title=$event->title;
    			$date=$event->date;
    			$time=$event->time;
    			$text=$event->text;
    			$pictureFile=$event->pictureFile;
    			$pictureSize=$event->pictureSize;
    			
    			//Escape special chars
    			$content = preg_replace(array('/</', '/>/', '/"/'), array('&lt;', '&gt;', '&quot;'), $text);
    			
    			$xml .= '<item>';
    		  $xml .= '<title>'.$helper->displayDate($date)."-".$helper->displayTime($time)." --- ".$title.'</title>';
    		  $xml .= '<link>http://www.samba-resille.org/publicSite/pages/agenda.php#'.$eventId.'</link>';
    		  $xml .= '<description>'.$content.'</description>';
     	    $xml .= '</item>';	
    		}
    						
    }	
    // édition de la fin du fichier XML    $xml .= '</channel>';    $xml .= '</rss>';        // écriture dans le fichier    $fp = fopen("agenda.xml", 'w+');    fputs($fp, $xml);    fclose($fp);
}


?>