<?php
  session_start();
  $_SESSION['table']='party';
  $_SESSION['condi']='';
  $_SESSION['rows']='partyName';
  $_SESSION['queryid']="";
  //echo $_SESSION['table'];
  //echo $_SESSION['condi'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Characters</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){

      $.get("RPGservices.php",function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="ID: "+allParties[i].partyID
            +" | Name: "+allParties[i].partyName
            +"<?php $_SESSION['id']="+allParties[i].partyID
            +";?> <form method='get' action='characters.php'><input type='hidden' name='id' value="
            +allParties[i].partyID
            +"><input type='submit' value='List of Characters'></form> ";
          party="<li>"+party+"</li>";
          $("#myitems").append(party);
        }
      });
      $("#saveitem").click(function(){
        var Name=$("#name").val();
        var item={
          vName : Name,

        };
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
      });
    });
    </script>

  </head>
  <body>

    <div>
      <h1>RPG Party </h1>
      <ul id="myitems"></ul>
    </div>
    <div>

      <h2>Add New Party</h2>
      <label>Item Name:</label>
      <input type="text" id="name"/><br>

      <input type="button" id="saveitem" value="Save Item"/>
    </div>
  </body>
</html>
