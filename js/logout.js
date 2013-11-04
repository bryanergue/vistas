$(document).ready(function(){
 
  function updateDataBase(){ 
 //alert("teststr: " + teststr);
 //$('.diferencia').text("teststr: " + teststr);
 
 $.post('http://auth.red.enncloud.com/users/sign_out',{} ,function(data){
 // alert(data);
 }); 
 }
 
 })
 
 
 