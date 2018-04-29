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
    <script>$(document).ready(function(){     
      $.get("RPGservices.php",function(data,status){     
        console.log(data);
        var allParties=JSON.parse(data);       
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].charID
            +"</td><td>"+allParties[i].charName
            +"</td><td><?php $_SESSION['id']='allParties[i].charID'
            ;?> <form method='get' action='items.php'><input type='hidden' name='id' value="
            +allParties[i].charID
            +"><input type='submit' value='Show Character Items' class='charRedirForm button'></form></td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].charID+"' value='Delete'></td>";
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

    <link href="css/home.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
  </head>
  <body id='bodytag2'>
    <div id="display">
      <div class="backlink">
        <a href="home.php">Back to party list</a>
      </div>
      <div id='tablediv'>
        <table id='myitemstable'>
          <tr>
            <th>Character ID</th>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </table>
      </div>
      <div id='actionmenuwrapper'>
          <div id='actionmenu'>
            <h1>Action Menu</h1>
            <label>Character Name:</label>
            <input class="tbox" type="text" id="name"/><br>
            <label>Account number:</label>
            <input class="tbox" type="text" id="account"/><br>
            <input class="button" type="button" id="saveitem" value="Save Item"/>
          </div>
      </div>
    </div>
  </body>
</html>
