<?php
  session_start();
  //$_SESSION['query']='SELECT * FROM characters WHERE partyID='.$_GET['id'];

  $_SESSION['query']='SELECT charName, ch.charID, SUM(itemWeight) AS sumWeight, SUM(itemValue) AS sumValue FROM items it JOIN characters ch ON ch.charID = it.charID WHERE partyID='.$_GET['id'].' GROUP BY charName';

  //make another?
  //_GET?
  //make a new page with the same action (get material for the query)

  //echo $testThing;
  $_SESSION['condi']=' WHERE partyID='.$_GET['id'];
  //$_SESSION['query']='SELECT * FROM characters WHERE partyID='.$_SESSION['id'];
  $sessionPartyID=$_GET['id'];
//      console.log($_SESSION['query']);    

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Comparison</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){
      $.get("http://127.0.0.1/services/inventory/RPGservices.php",function(data,status){     
        console.log(data);
        
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].charID
            +"</td><td>"+allParties[i].charName
            +"</td><td>"+allParties[i].sumValue+"</td><td>"+allParties[i].sumWeight+"</td>";
          party="<tr id='"+allParties[i].charID+"'>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
        //$("#header").text("Characters In Party "+allParties[0].partyID);
        
        //Dynamically creates the header of the page
        //telling the user which chars are in the party
        var morewhat="SELECT partyName FROM party WHERE partyID='"+allParties[0].partyID+"';";
        var item={
          vName : morewhat,
        };
        console.log(item);
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          $("#header").text("Characters in "+data);
          $("#header2").text("Add new character to "+data);
        });
      });

      $('body').on('click', 'input.deleteBtn', function() {   
        var what3="DELETE FROM characters WHERE charID="+this.id;
        var item3={
          vName : what3, 
        };
        console.log(item3);
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item3,function(data){
        });
        document.getElementById(this.id).remove();
      });

      $("#saveitem").click(function(){
        var Name="INSERT INTO characters (charName,accID, partyID) VALUES (\'"+$('#name').val()+"\',"+$('#account').val()+",<?php echo $_GET['id']?>)";
        console.log(Name);
        var item2={
          vName : Name,
        };
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item2,function(data){
          console.log(data+"gdfgdf");
          //autoRefreshes Page
          $("#bodytag2").load(location.href );
        });

        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          $("#header").text("All characters in "+data);
        });
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

<!--       <p><?php echo $_GET['id'] ?></p>   -->
        <div id='tablediv'>
          <!-- Filled in with PHP -->
          <h1 id='header'></h1>

        <table id='myitemstable'>
          <tr>
            <th>Character ID</th>
            <th>Character Name</th>
            <th>Total Weight Carried</th>
            <th>Net Worth</th>
          </tr>
        </table>
      </div>

  </body>
</html>
