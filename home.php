<?php
  session_start();
  $_SESSION['table']='party';
  $_SESSION['condi']='';
  $_SESSION['query']='SELECT * FROM party';
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
            
            +"</td><td><? $_SESSION['id']="
            +allParties[i].partyID
            +"; $_GET['partyName']="
            +allParties[i].partyName
            +"?><form method='get' action='characters.php'><input name='id' type='hidden' value='"
            +allParties[i].partyID
            +"'><input type='submit' value='Show Party' class='charRedirForm button'></form></td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].partyID+"' value='Delete'></td> ";

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
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
  </head>
  <body id='bodytag'>

    <div id="display">
      <div id="logindiv">
        <h1>Inventory Management Simulator 2018</h1>

        <form method="post" action="RPGservices.php">
          Username: <input type="text" name="uNameBox" class="tbox">
          Password: <input type="password" name="pWordBox" class="tbox">
          <input class="button" type="submit" value="Log In">
        </form>
      </div>

      <div id='tablediv'>
        <h1>Current Parties </h1>
        <ul id="myitems"></ul>
        <table id='myitemstable'>
          <tr>
            <th>Party ID</th>
            <th>Party Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <!-- <tr>
            <td></td>
            <td><input type="text" id="name"/ class="tbox"></td>
            <td><input type="button" id="saveitem" class="button" value="Create Party"/></td>
            <td></td>
          </tr> -->
        </table>



        
      </div>

      <div id='actionmenuwrapper'>
        <div id='actionmenu'>
          <h1>Action Menu</h1>
          <label>Add a new Party</label>
          <input type="text" id="name" class="tbox"/>
          <input type="button" id="saveitem" class="button" value="Create Party"/>
        </div>
      </div>
    
      <p style="text-align: center;">Created By: Robert Velazquez, Claudiu Moise (TR),  Marco Cortes </p>
  </body>
</html>
