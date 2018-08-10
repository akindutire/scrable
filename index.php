<?php

include('class.php');
$scrable=new scb();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Scrable</title>

<style>
td{
	background-repeat:no-repeat;
	width:25px;
	height:20px;
	}

[draggable=true] { 
    -moz-user-select:none; 
    -webkit-user-select: none; 
    -webkit-user-drag: element; 
}

[draggable=true] { 
    cursor : move; 
}


</style>

<script src='jquery-1.9.0.min.js'></script>
<script src='check.js'></script>
<script src='dropzone.js'></script>

<script>

	


</script>
</head>

<body>
<div id="sc" style="margin:2% 20% 5% 15%;">
	<table>

		<?php	$scrable->board(); ?>

	</table>
	
    <br>

		<center><div id="rack" style="width:100%; height:auto; background:url(images/benchcont.gif); background-repeat:no-repeat; padding:1px; position:relative;">
        	
				<table style=" height:65%; margin-left:20%; margin-right:20%; cursor:pointer;">	<tr><?php 	$scrable->bench();	?></tr></table>

        </div></center>

		<div id="info">
        <?php	
			$lefttiles=$scrable->info(1);	
			if($lefttiles!=0){
				echo "<b>You have $lefttiles tiles remaining</b>"; 
    		}else{
            	echo "";
            }	
            
        ?>
        </div>

		<div id="menus">
        	<center><form>
            	<button type="submit" id="widthdraw">Withdraw</button>
            	<button type="submit" id="quit">Quit</button>
            	<button type="submit" id="exchange">Exchange</button>
            	<button type="submit" id="shuffle">Shuffle</button>
            	<button type="submit" id="load">Load Game</button>
                <button type="submit" id="sb">Submit</button>
       		</form></center>
        </div>

</div>

</body>
</html>