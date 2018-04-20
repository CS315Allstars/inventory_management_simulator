<?php
  session_start();
  $_SESSION['table']='party';
  $_SESSION['condi']='';
  $_SESSION['rows']='partyName';
  $_SESSION['queryid']="";
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
          var party="<td>"+allParties[i].partyID
            +"</td><td>"+allParties[i].partyName
            +"</td><td><?php $_SESSION['id']="+allParties[i].partyID
            +";?> <form method='get' action='characters.php'><input  name='id' type='hidden' value="
            +allParties[i].partyID
            +"><input type='submit' value='List of Characters'></form></td><td><input type='button'  class='deleteBtn' id='"+allParties[i].partyID+"' value='Delete'></td> ";
          party="<tr id='"+allParties[i].partyID+"'>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
      });
      $('body').on('click', 'input.deleteBtn', function() {   
        var shit="DELETE FROM party WHERE partyID="+this.id+";";
        var item={
          vName : shit,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
        //$("home.php").load("home.php");
      });
      
      $("#shit").click(function(){
        var teststr="shit";
        console.log(teststr);
        $("#test").val("teststr");
        
      });
      $("#saveitem").click(function(){
        var Name="INSERT INTO party (partyName) VALUES ('"+$("#name").val()+"')";
        //var Name=$("#name").val();
        var item={
          vName : Name,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/RPGservices.php",item,function(data){
          console.log(data);
        });
        $("#bodytag").load("home.php ");
      });
    });
    </script>
  </head>
  <body id='bodytag'>
    <div>
      <input type='button'  class='deleteBtn' id='222' value='Delete'>
      <form method="post" action="RPGservices.php">
        Username: <input type="text" name="uNameBox">
        Password: <input type="password" name="pWordBox">
        <input type="submit">
      </form>
      <input type='text' id='test' value='fdsdf'>
      <input type='button' id="shit" value="Fuck jquerywhyisnothingworking">
    </div>
    <div id='tableinfo'>
      <h1>RPG Party </h1>
      <ul id="myitems"></ul>
      <table id='myitemstable'style='width:60%; text-align:center;' border='2px'>
        <tr>
          <th>Party ID</th>
          <th>Name</th>
        </tr>
      </table>
    </div>
    <div>
      <h2>Add New Party</h2>
      <label>Item Name:</label>
      <input type="text" id="name"/><br>
      <input type="button" id="saveitem" value="Save Item"/>
    </div>
  </body>
</html>
