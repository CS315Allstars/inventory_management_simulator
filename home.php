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
    <title> Parties</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){
      $.get("RPGservices.php",function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].partyID
            +"</td><td>"+allParties[i].partyName
            +"</td><td><? $_SESSION['id']="+allParties[i].partyID
            +"?> <form method='get' action='characters.php'><input  name='id' type='hidden' value="
            +allParties[i].partyID
            +"><input type='submit' value='List of Characters' class='charRedirForm button'></form></td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].partyID+"' value='Delete'></td> ";
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
        //document.getElementById(""+this.id+"").style.visibility='hidden';
        document.getElementById(""+this.id+"").remove();
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

    <link href="css/home.css" rel="stylesheet" type="text/css" media="screen"/>
  </head>
  <body id='bodytag'>
    <div id="logindiv">   
      <form method="post" action="RPGservices.php">
        Username: <input type="text" name="uNameBox">
        Password: <input type="password" name="pWordBox">
        <input class="button" type="submit">
      </form>
    </div>
    <div id='tablediv'>
      <h1>RPG Parties </h1>
      <ul id="myitems"></ul>
      <table id='myitemstable'>
        <tr>
          <th>Party ID</th>
          <th>Name</th>
        </tr>
        <tr>
          <td></td>
          <td><input type="text" id="name"/></td>
          <td><input type="button" id="saveitem" class="button" value="Save Item"/></td>
          <td></td>
        </tr>
      </table>
    </div>
    
  </body>
</html>
