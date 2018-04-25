<?php
  session_start();
  $_SESSION['table']='characters';
  $_SESSION['query']='SELECT * FROM characters WHERE partyID='.$_GET['id'];
  $_SESSION['id']=$_GET['id'];
  //echo $testThing;
  $_SESSION['condi']=' WHERE partyID='.$_GET['id'];
  //$_SESSION['query']='SELECT * FROM characters WHERE partyID='.$_SESSION['id'];

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Characters</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<<<<<<< HEAD
    <script>$(document).ready(function(){     
      $.get("RPGservices.php",function(data,status){     
=======
    <script>$(document).ready(function(){
      //loads the page/creates the table
      $.get("RPGservices.php",function(data,status){
>>>>>>> origin/marco
        console.log(data);
        var allParties=JSON.parse(data);       
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].charID
            +"</td><td>"+allParties[i].charName
            +"</td><td><?php $_SESSION['id']='allParties[i].charID'
            ;?> <form method='get' action='items.php'><input type='hidden' name='id' value="
            +allParties[i].charID
            +"><input type='submit' value='List of items'></form></td><td><input type='button'  class='deleteBtn' id='"+allParties[i].charID+"' value='Delete'></td>";
          party="<tr id='"+allParties[i].charID+"'>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
        //$("#header").text("Characters In Party "+allParties[0].partyID);
        var moreshit="SELECT partyName FROM party WHERE partyID='"+allParties[0].partyID+"';";
        var item={
          vName : moreshit,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          $("#header").text("Characters in "+data);
          $("#header2").text("Add new character to "+data);
        });
      });

      $('body').on('click', 'input.deleteBtn', function() {   
        var shit="DELETE FROM characters WHERE charID="+this.id;
        var item3={
          vName : shit, 
        };
        console.log(item3);
        $.post("http://127.0.0.1/services/RPGservices.php",item3,function(data){
        });
        document.getElementById(this.id).remove();
      });

      $("#saveitem").click(function(){
        var Name="INSERT INTO characters (charName,accID, partyID) VALUES (\'"+$('#name').val()+"\',"+$('#account').val()+",<? echo $_GET['id']?>)";
        console.log(Name);
        var item2={
          vName : Name,
        };
        $.post("http://127.0.0.1/services/RPGservices.php",item2,function(data){
          console.log(data+"gdfgdf");
          $("#bodytag2").load(location.href );
        });
        //'<?$_SESSION['id'] = $_GET['id']?>';
        
      });
    });
    </script>
  </head>
  <body id='bodytag2'>
    <div>
      <p><a href="home.php">Back to party list</a></p>
    </div>
    <div id='mydiv'>
      
      <h1 id='header'></h1>     
      <ul id="myitems"></ul>
      <table id='myitemstable'style='width:800px; text-align:center;' border='2px'>
        <tr>
          <th>Character ID</th>
          <th>Name</th>
        </tr>
      </table>
    </div>
    <div>
      <h2 id='header2'></h2>
      <label>Character Name:</label>
      <input type="text" id="name"/><br>
      <label>Account number:</label>
      <input type="text" id="account"/><br>
      <input type="button" id="saveitem" value="Save Item"/>
    </div>
  </body>
</html>
