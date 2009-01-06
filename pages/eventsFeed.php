<?php

  // This is a minimum example of using the Universal Feed Generator Class

  include("FeedWriter/FeedWriter.php");
  include("database.php");
  

  //Creating an instance of FeedWriter class. 

  $TestFeed = new FeedWriter(RSS2);
  
  //Setting the channel elements

  //Use wrapper functions for common channel elements

  $TestFeed->setTitle('Les évènements à Samba Resille');
  $TestFeed->setLink('http://www.samba-resille.org');
  $TestFeed->setDescription('Programmation du 38 rue Roquelaine à Toulouse');

 
  //Image title and link must match with the 'title' and 'link' channel elements for valid RSS 2.0

  $TestFeed->setImage('Les évènements à Samba Resille','http://www.samba-resille.org','http://www.samba-resille.org/publicSite/basic-style/img/headerBannerAEDI.png');


  // Retrieve info
    $result = mysql_query("select * from event order by date desc");



    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
        //Create an empty FeedItem
        $newItem = $TestFeed->createNewItem();
        //Add elements to the feed item    
        $newItem->setTitle($row['title']);
        $newItem->setLink('http://www.samba-resille.org/publicSite/pages/agendaPaged.php#'.$row['id']);

        $newItem->setDate($row['date']);
        $newItem->setDescription($row['text'] );
        


        

        //Now add the feed item

        $TestFeed->addItem($newItem);

    }

  

  //OK. Everything is done. Now genarate the feed.

  $TestFeed->genarateFeed();

?>

