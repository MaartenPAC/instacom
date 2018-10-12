<!DOCTYPE html>

<head>
  <title>Client Device Management</title>
  <!--EXTERNAL STYLESHEETS-->
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>

  <!--SIDEBAR HEADER-->
  <header>
    <nav>
      <ul class="menus">
        <li class="menu">
          <a href="http://voltakraft.byethost7.com/instacom/home.php">
            <i class="fas fa-sync"></i>
          </a>
        </li>        
        <li class="main">
          <a href="#">
            <i class="fas fa-plus"></i>
          </a>
        </li>       
      </ul>
    </nav>
  </header>
  
  <div class="app flexed">
    <div class="spacer">
      <!--SLIDE OUT SECTION-->
      <div class="submenus">


<!--INSERT NEW ROW FORM-->
<form id="form1" name="form1" method="post" action="insert.php" onSubmit="return validateForm();">
<h1>Add new client</h1>
<table width="100%">
  <tr>
    <td>Name</td>
    <td><label for="username"></label>
       <input type="text" name="username" id="username" value="" /></td>
   </tr>
  <tr>
    <td>Surname</td>
    <td><label for="surname"></label>
      <input type="text" name="surname" id="surname" value="" /></td>
  </tr>
  <tr>
    <td>Company</td>
    <td><label for="company"></label>
      <input type="text" name="company" id="company" value="" /></td>
  </tr>
  <tr>
    <td>Device</td>
    <td><label for="device"></label>
      <input type="text" name="device" id="device" value="" /></td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Submit" /></td>
    <td><input type="reset" name="Reset" id="Reset" value="Undo Changes" /></td>
  </tr>  
</table>

</form>

<p id="errorMessage" style="color:#C00; font-style:italic;"></p>
      </div>
    </div>
  <div class="block">
    <h1>Client Device Management</h1>

<!--DISPLAY ALL DATA-->
<?php
require_once('connect.php');

$result = mysql_query("SELECT * FROM clientdbs");

echo "
  <table class='displaytable'>
  <th>Name</th>
  <th>Surname</th>
  <th>Company</th>
  <th>Device</th>
  <th>Status</th>
";

$statusarray = array();
$i = 0;
while($row=mysql_fetch_array($result)) {
$statusarray[$i] = $row['status'];
$osarray = array_count_values($statusarray);
$i++;


echo "<tr>";
$idn=$row['id'];$un=$row['username'];$sn=$row['surname'];$cn=$row['company'];$dm=$row['device'];$os=$row['status'];
echo "<td>".$row['username']." </td>";
echo "<td>".$row['surname']."</td>";
echo "<td>".$row['company']."</td>";
echo "<td>".$row['device']."</td>";
echo "<td>".$row['status']."</td>";
echo "<td class='linkcell'>
        <a href='delete.php?id=$idn'>Delete</a></td>
      <td class='linkcell'><a href='home.php?id=$idn&action=edit&un=$un&sn=$sn&cn=$cn&dm=$dm&os=$os'>Edit</a></td>";
echo "</tr>";
  
  }


    
echo "</table><br>";

?>

<!--EDIT ROW FORM-->
<?PHP 
if($_GET['action']=='edit')
{
?>
<form id="form2" name="form2" method="post" action="update.php?id=<?PHP echo $_GET['id']; ?>" onSubmit="return validateForm();">
<h1>Editing Client #<?php echo $_GET['id']; ?></h1>
<table>
  <tr>
    <td>Name</td>
    <td><label for="username"></label>
       <input type="text" name="username" id="username" value="<?PHP echo $_GET['un']; ?>" /></td>
   </tr>
  <tr>
    <td>Surname</td>
    <td><label for="surname"></label>
      <input type="text" name="surname" id="surname" value="<?PHP echo $_GET['sn']; ?>" /></td>
  </tr>
  <tr>
    <td>Company</td>
    <td><label for="company"></label>
      <input type="text" name="company" id="company" value="<?PHP echo $_GET['cn']; ?>" /></td>
  </tr>
  <tr>
    <td>Device</td>
    <td><label for="device"></label>
      <input type="text" name="device" id="device" value="<?PHP echo $_GET['dm']; ?>" /></td>
  </tr>    
  <tr>
    <td><input type="submit" name="submit" id="submit" value="Submit" /></td>
    <td><input type="reset" name="Reset" id="Reset" value="Undo Changes" /></td>
  </tr>
</table>

</form>
<?PHP
}
?>

<!--STATISTICS-->
<div id="statdiv">
<h1>Statistics</h1>
<p>Users Online: <?php echo $osarray[Online]." / ".$i; ?></p>

<!--CHART ONLINE STATUS CALCULATE-->
<?php 
  $online = ($osarray[Online] / $i) * 100;
  $offline = ($osarray[Offline] / $i) * 100;
  $onlineperc = number_format($online, 2, '.', ' ');
  $offlineperc = number_format($offline, 2, '.', ' ');
  include 'chart.php';
?>

    </div>
   </div>
  </div>

<!--SIDEBAR ANIMATION-->
<script type="text/javascript">
  
if (document.querySelector(".main")) {
        document.querySelector(".main").onclick = function (){
            var submenu = document.querySelector(".spacer");
            submenu.classList.toggle("show");
        }
    }

var allTableCells = document.getElementsByTagName("td");

for(var i = 0, max = allTableCells.length; i < max; i++) {
    var node = allTableCells[i];

    //GET THE TEXT FROM THE FIRST CHILD NODE - WHICH SHOULD BE A TEXT NODE
    var currentText = node.childNodes[0].nodeValue; 

    //CHECK FOR 'OFFLINE' || 'ONLINE' AND ASSIGN THIS TABLE CELL'S BACKGROUND COLOR ACCORDINGLY 
    if (currentText === "Offline")
        node.style.backgroundColor = "#c0504e"
    else if (currentText === "Online")
        node.style.backgroundColor = "#4cae51";
}    

</script>

</body>
</html>