<?php

$link=mysqli_connect('localhost','root','','scrabble');

class scb{
	
	public function board(){
		
		$limit=15;


	for($x=1;$x<($limit+1);$x++){
		
	echo "<tr style='width:900px;'>";
		
		
		for($y=1;$y<($limit+1);$y++){



		
			if(		(($x==1	||	$x==15)		&&		($y==1	||	$y==15))	||	(($x==8	&&	$y==1)	||	($x==1	&&	$y==8))	||	(($x==8	&&	$y==15)	||	($x==15	&&	$y==8))		){
					
				echo "<td id='droptarget1' style='padding:10px; background:url(images/tripleword.gif);'></td>";
			
			}else if($x==8 && $y==8){


				echo "<td id='droptarget1'	style='padding:10px; background:url(images/center.gif);'></td>";

				
			}else if(		(($x==$y)	||	
			
			($x==14 && $y==2)	||	($x==13 && $y==3)	||	($x==12 && $y==4)	||	($x==11 && $y==5)	||	($x==5 && $y==11)	||	($x==4 && $y==12)	||	($x==3 && $y==13)	||	($x==2 && $y==14))	
			
			&&	
			
			(($x==2	||	$x==3	||	$x==4	||	$x==5	||	$x==11	||	$x==12	||	$x==13	||	$x==14)
			
			&&	
			
			($y==2	||	$y==3	||	$y==4	||	$y==5	||	$y==11	||	$y==12	||	$y==13	||	$y==14))	){
				
				echo "<td id='droptarget1'	style='padding:10px; background:url(images/doubleword.gif);'></td>";
			
			}else if(	($x==7	&&	$y==9)	||	($x==9	&&	$y==7)	||	(($x==7	&&	$y==7)	||	($y==9	&&	$x==9))){
				
				echo "<td id='droptarget1'	style='padding:10px; background:url(images/doubleletter.gif);'></td>";
				
				
			}else if(	($x==$y && ($x!=7	&&	$x!=9	&&	$y!=7	&&	$y!=9))	
			
			||	
			
			($x==10 && $y==6)	||	($x==6 && $y==10)	
			
			&&	
			
			(($x==6)
			
			&&	
			
			($y==10))	){
				
				echo "<td id='droptarget1'	style='padding:10px; background:url(images/tripleletter.gif);'></td>";
				
			
			
			}else if(	($x==1	||	$x==4	||	$x==12	||	$x==15)	&&	($y==1	||	$y==4	||	$y==12	||	$y==15)	){
			
				echo "<td id='droptarget1'	style='padding:10px; background:url(images/doubleletter.gif);'></td>";
			
			}else if(	(	($x==2	  ||	$x==14	||	$x==6	||	$x==10)	
			
				&&	
			
			($y==2	||	$y==6)	)	
			
			||	
			
			(	($x==2	 ||	  $x==14	||	$x==6	||	$x==10)	
			
				&&	
			
			($y==10	||	$y==14)	  )		){
			

				echo "<td id='droptarget1'	style='padding:10px; background:url(images/tripleletter.gif);'></td>";

			}else if(	(	($x==7	||	$x==9)	
				
				&&
			
			($y==3)	)
			
			||
			
			(	($x==7	||	$x==9)	
				
				&&
			
			($y==13	)	)
			
			||
			
			(	($y==7	||	$y==9)	
				
				&&
			
			($x==3)	  )
			
			||
			
			(	($y==7	||	$y==9)	
				
				&&
			
			($x==13)	  )
				
			){
				
				echo "<td id='droptarget1'	style=' padding:10px; background:url(images/doubleletter.gif);'></td>";
				
				
			}else if(	($x==8	&&	$y==4)	||	($x==8	&&	$y==12)	||	($x==4	&&	$y==8)	||	($x==12	&&	$y==8)){

				echo "<td id='droptarget1'	style='padding:10px; background:url(images/doubleletter.gif); color:white;'></td>";

							
			}else{
				
				echo "<td id='droptarget1' dropzone='move'	style='padding:10px; background:url(images/null.gif);'></td>";
				
				}
		
		
		
		
		}//Inner loop
		
	echo "</tr>";	
	}//Outer loop
	
		
		
	}
	
	
	public function myrack(){
		global $link;
		
		//0	-Has Not Been Selected
		//1	-Has Been Selected Into Bench
		//2	-Has Been Placed On Board
		//3	-Has Been Submitted
		
		mysqli_query($link,"TRUNCATE myrack");
		
		$io=mysqli_prepare($link,"INSERT INTO myrack(id,letter,point,x,y,st) VALUES(?,?,?,?,?,?)");
		
		$e='';
		$st=0;
		
		for($i=1;$i<94;$i++){
			
			$rand=rand(1,26);
			
			$sql=mysqli_query($link,"SELECT * FROM letterpoints WHERE id='$rand'");
			list($id,$letter,$point)=mysqli_fetch_row($sql);
			
			
				mysqli_stmt_bind_param($io,'isiiii',$e,$letter,$point,$e,$e,$st);
				mysqli_stmt_execute($io);
			
			}
		
			mysqli_stmt_bind_param($io,'isiiii',$e,$e,$e,$e,$e,$st);
			for($z=1;$z<8;$z++){
				mysqli_stmt_execute($io);
			}
		}
	
	public function bench(){
		global $link;
			
				$sql=mysqli_query($link,"SELECT id,letter,point FROM myrack WHERE st='0' ORDER BY RAND() LIMIT 1,7");
				while(list($id,$l,$p)=mysqli_fetch_row($sql)){
					
					if($p==0){
						$l='';
						$p='';
						}
				
				mysqli_query($link,"UPDATE myrack SET st=1 WHERE id='$id'");
				
				echo "<td id='mtile' draggable='true' style='background:url(images/bench.gif); padding:5px;'>$l<sub>$p</sub></td>";
				}
			
		}
	public function info($i){
		global $link;
		
		//1	-No of left tiles
			if($i==1){
				$sql=mysqli_query($link,"SELECT * FROM myrack WHERE st='0'");
				$lefttiles=mysqli_num_rows($sql);
				return $lefttiles;
				}
		}
	
	public function calculatescore($word){
		
		}
	
	
	}


?>