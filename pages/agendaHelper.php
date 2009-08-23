<?php

/* ------------------------------------------------------------------------------------------------
This class is used to paginate the agenda page and to provide the headers links
---------------------------------------------------------------------------------------------------
*/
class agendaHelper{
/*---------------------------------------------------------------------------------------------------
 Define the maximum number of events per page
---------------------------------------------------------------------------------------------------*/
var $maxPageSize=5;
var $numberOfEvents;
var $allEvents; // all event ordered by date desc (future first)
var $numberOfPages;
var $currentPage="";

/*---------------------------------------------------------------------------------------------------
  initialization: retrieve all events
--------------------------------------------------------------------------------------------------- */

function agendaHelper($db){
  $this->allEvents = $this->mysqlQuery($db,"select * from event order by date desc");
  $this->numberOfEvents = count ($this->allEvents);
  $this->numberOfPages = ceil( $this->numberOfEvents / $this->maxPageSize );
  }

/*---------------------------------------------------------------------------------------------------
Return the current page to display
--------------------------------------------------------------------------------------------------- */

function getCurrentPage(){
    $this->currentPage=$_GET["currentPage"]; // Récupération de la variable http
    //$this->currentPage=$n // Récupération de la variable http

    if($this->currentPage ==""){
      $commingSoon = $this->getCommingEvents(1);
      if($commingSoon[0]){
        $this->currentPage = $this->getPageOfEvent($commingSoon[0]["id"]);
      }
    }
    if($this->currentPage > $this->numberOfPages-1) {
        $this->currentPage = $this->numberOfPages-1;
        }
    if($this->currentPage<0) {
      $this->currentPage=0;
      }
    return $this->currentPage;
}

function getEventsForCurrentPage(){
  $minEvent= $this->getCurrentPage() * $this->maxPageSize;
  $maxEvent= $minEvent + $this->maxPageSize;
  $events = array($this->maxPageSize);
  $nbDisplayed=0;
  for ($i=$minEvent; $i<$maxEvent; $i++){
    $events[$nbDisplayed]=$this->allEvents[$i];
    $nbDisplayed++;
  }
  return $events;
}

/*---------------------------------------------------------------------------------------------------
  Formatting display
--------------------------------------------------------------------------------------------------- */
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
  // We force the hour to be 23:59 so that an event is included in today when displaying comming events
  return mktime(23,59,0,$month,$day,$year);
  }	

/* ---------------------------------------------------------------------------------------------------
Perform SQL queries, return result as a table
---------------------------------------------------------------------------------------------------*/
function mysqlQuery($db,$query){
    // Performing SQL query
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $rows=array();
    while ($row = mysql_fetch_assoc($result)) $rows[]=$row;    
    // Free resultset
    mysql_free_result($result);
    return $rows;
}
/*---------------------------------------------------------------------------------------------------
Retrieve the N comming events (events to come starting at today/now)
---------------------------------------------------------------------------------------------------*/
function getCommingEvents($numberOfEventsToDisplay){
  $now=time();
  $commingEvents = array($numberOfEventsToDisplay);
	$numberAlreadyDisplayed = 0;
	// Iterate through all events in reverse order and get the first with a date > now
	for ($i=$this->numberOfEvents-1; $i>=0; $i--){
	  $event=$this->allEvents[$i];
	  //echo "event : $event";
	  $eventDate=$this->sqlDateToTs($event["date"]);
	  if($eventDate>$now && $numberAlreadyDisplayed < $numberOfEventsToDisplay){ 
	   $commingEvents[$numberAlreadyDisplayed]=$event;
	   $numberAlreadyDisplayed++;
	  }
	 }
	return $commingEvents;
}
/*---------------------------------------------------------------------------------------------------
Return the page number of a given eventId
---------------------------------------------------------------------------------------------------*/
function getPageOfEvent($eventId){
  //iterate through all events and when the event id is matched, calculate the page number
  for($i=0;$i<$this->numberOfEvents;$i++){
    if($this->allEvents[$i]["id"]==$eventId){
      return floor($i/$this->maxPageSize);
    }
  }
}  

/*---------------------------------------------------------------------------------------------------
total number of pages
--------------------------------------------------------------------------------------------------- */
function getNumberOfPages(){
  return $this->numberOfPages;
  }
/*---------------------------------------------------------------------------------------------------
 total number of events 
--------------------------------------------------------------------------------------------------- */
function getNumberOfEvents(){
  return $this->numberOfEvents;
  }
  
/*---------------------------------------------------------------------------------------------------
Return true if we are displaying the first page
---------------------------------------------------------------------------------------------------*/
function isFirstPage(){
  if($this->getCurrentPage()>0){
    return false; 
  }else{
    return true;
  }
}
/*---------------------------------------------------------------------------------------------------
Return true if we are displaying the last page
---------------------------------------------------------------------------------------------------*/
function isLastPage(){
  if($this->getCurrentPage() < ($this->getNumberOfPages()-1)){
    return false;
  }else{
    return true;
  }
}
/*---------------------------------------------------------------------------------------------------
Return the number of the next page or null if we are on the last page
---------------------------------------------------------------------------------------------------*/
function getNextPage(){
  if($this->isLastPage() ){
    return null;
  }else{
    return $this->getCurrentPage()+1;
  }
}
/*---------------------------------------------------------------------------------------------------
Return the number of the preeceding page or null if we are on the first one
---------------------------------------------------------------------------------------------------*/
function getBeforePage(){
  if($this->isFirstPage() ){
    return null;
  }else{
    return $this->getCurrentPage()-1;
  }
}

}