<?php 
echo "<h2>Form debugging information</h2>";
	if(!empty($_POST)){ 
		// 
		// Debug 
		// 
		echo '<b>Variables</b> :<br />'; 
		echo '<pre>'; 
		print_r($_POST); 
		echo '</pre>';
	} 
	if(!empty($_FILES)){ 
		// 
		// Debug 
		// 
		echo '<b>Fichiers</b> :<br />'; 
		echo '<pre>'; 
		print_r($_FILES); 
		echo '</pre>'; 
	} 
?> 
