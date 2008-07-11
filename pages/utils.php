<?php

$maxPageSize=5; // nombre max d'evenements par page dans l'agenda


//utils.php
function displayDate($date){
	list($year,$month,$day)=explode("-",$date);
	return "$day/$month/$year";
}

function displayShortDate($date){
	list($year,$month,$day)=explode("-",$date);
	return "$day/$month";
}

function formatDateToSql($frenchDate){
	list($day,$month,$year)=explode("/",$frenchDate);
	return "$year:$month:$day";
	}
	
function displayTime($sqlTime){
	list($hour,$min,$second)=explode(":",$sqlTime);
	return "$hour:$min";
	}
	
function sqlDateToTs($sqlDate){
  list($year,$month,$day)=explode("-",$sqlDate);
  return mktime(0,0,0,$month,$day,$year);
  }	
  

function mysqlQuery($db,$query){
    // Performing SQL query
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $rows=array();
    while ($row = mysql_fetch_assoc($result)) $rows[]=$row;    
    // Free resultset
    mysql_free_result($result);
    return $rows;
}

// Retrieve the N comming events (events to come starting at today/now)
function getCommingEvents($maxPageSize, $numberOfEventsToDisplay){
  $commingEvents = array($numberOfEventsToDisplay);
  $now=time();
	$allEvents = mysqlQuery($db,"select * from event order by date desc");// Tous les evenements
  $numberOfEvent = count($allEvents);
  $numberOfPages = ceil($numberOfEvent / $maxPageSize);
	
	$numberAlreadyDisplayed = 0;
	for ($i=0; $i<$numberOfEvent; $i++){
	  $event=$allEvents[$i];
	  $eventDate=sqlDateToTs($event["date"]);
	  if($eventDate>$now && $numberAlreadyDisplayed < $numberOfEventsToDisplay){  // Display only 4 next future events
	   $commingEvents[$numberAlreadyDisplayed]=$event;
	   $numberAlreadyDisplayed++;
	  }
	 }
	return $commingEvents;
}
  
  
  
?>