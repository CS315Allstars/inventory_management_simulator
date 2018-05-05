<?php
  session_start();
  //$_SESSION['username']="";

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Parties</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>$(document).ready(function(){
      var onload={
        query : "SELECT * FROM party",
      };
      $.get("http://127.0.0.1/services/inventory/RPGservices.php",onload,function(data,status){
      //$.get("http://127.0.0.1/services/inventory/RPGservices.php",function(data,status){
        console.log(data);
        var allParties=JSON.parse(data);
        for(var i=0;i<allParties.length;i++){
          var party="<td>"+allParties[i].partyID
            +"</td><td>"+allParties[i].partyName
            +"</td><td><?php $_GET['id']="
            +allParties[i].partyID
            +"; $_GET['partyName']="
            +allParties[i].partyName
            +"?><form method='get' action='characters.php'><input name='id' type='hidden' value='"
            +allParties[i].partyID
            +"'><input type='submit' value='Show Party' class='charRedirForm button'></form></td><td><?php $_SESSION['id']="
            +allParties[i].partyID
            +"; $_GET['partyName']="
            +allParties[i].partyName
            +"?><form method='get' action='comparison2.php'><input name='id' type='hidden' value='"
            +allParties[i].partyID
            +"'><input type='submit' value='Show Stats' class='button'></form></td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].partyID+"' value='Delete'></td> ";

          party="<tr id='"+allParties[i].partyID+"'>"+party+"</tr>";
          $("#myitemstable").append(party);
        }
        //VARIABLE SCOPE MAY BE THE CAUSE OF PASSING VALS VIA SESSIONS PROBLEM
        if ("<?php echo $_SESSION['username']?>"=="") {
          //document.getElementById("welsomesession").style.display='none';
          $('td:nth-child(4),th:nth-child(4)').hide();
          $('td:nth-child(5),th:nth-child(5)').hide();
          $('#logout').hide();
          $('#actionmenu').hide();
          console.log("SESSION NOT SET");
        }
        else {
          console.log("SESSION HAS BEEN TEMPORARILY SET TO <?php echo $_SESSION['username']?>");
          $uname_value="<?php echo $_SESSION['username']?>";
          console.log("bound by scope"+$uname_value);

          $('#loginform').hide();
        }

      });
//             +"'><input type='submit' value='Show Characters' class='charRedirForm button'></form></td><td><input type='button'  class='deleteBtn button' id='"+allParties[i].partyID+"' value='Delete'></td> ";
      
      $('body').on('click', 'input.deleteBtn', function() {   
        var shit="DELETE FROM party WHERE partyID="+this.id+";";
        var item={
          vName : shit,
          action : '',
        };
        console.log(item+this.id);
        var id=this.id;

        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data);
          document.getElementById(id).remove();

        });

      
        //document.getElementById(""+this.id+"").style.visibility='hidden';
        //document.getElementById(""+this.id+"").remove();

      });
      
      $("#what").click(function(){
        var teststr="what";
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
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data);
        });
        $("#bodytag").load("home.php ");
      });

      $("#login").click(function(){
        if ($("#uname").val()=='' || $("#pword").val()=='') {
        	//Creates error message for user
          console.log("shit's empty");
          document.getElementById("unameerror").style.display='inline';
        }
        console.log("shit clicked");
        var query="SELECT password FROM account WHERE userName='"+$('#uname').val()+"'";
        var item={
          vName : query,
          action : 'login',
          password : $("#pword").val(),
          username : $("#uname").val(),
        };
        //When we post to the server it will change the $_SESSION to the username entered
        $.post("http://127.0.0.1/services/inventory/RPGservices.php",item,function(data){
          console.log(data);
          if (data==$("#uname").val()) {
  			//$uname_value=$_SESSION['username'];
            
            console.log("Out of scope Current Session Name:"+"<?php echo $_SESSION['username']?>");
            //console.log("GOGO value "+$uname_value)
            $("#bodytag").load("home.php ");
          }
        });
      });

      
      $("#logoutbtn").click(function(){
        
        console.log("it's 3:30am and this wont work for some reason");
        //<?php $_SESSION['username']="";?>

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
          <div id='logout'>
            <!-- <h1 style="text-align: center;"><?php echo $_SESSION['username'];?></h1> -->
            <input type="button" id="logoutbtn" class="button" value="Log Out"/> 
          </div>
          
          <div id='loginform'>
            <p style="display: none ;color: red" id='unameerror'>Fields cannot be left blank.<br></p>
            Username<input type="text" id="uname" class="tbox"/><br>         
            Password<input type="Password" id="pword" class="tbox"/><br>
            <input type="button" id="login" class="button" value="Log In"/>    
          </div>   
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
            <th id='deletecolumn'>&nbsp;</th>
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
