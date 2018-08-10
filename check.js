// JavaScript Document
$(function(){
	
	loadrack=function(e){
		e.preventDefault();
		window.location='load.php';
	}
	
	$('#mtile').bind('dragstart',function(e){
		e.originalEvent.dataTransfer.setData('text', this.id);
		//alert('I am Dragging'); 
		});
		
	$('#load').bind('click',loadrack);
	
	});