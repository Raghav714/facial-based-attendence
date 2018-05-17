<html>
  <head> 
  <style>
header{
  border:1px solid grey;
    margin:1px;margin-bottom:5px;padding:8px;
    background-color:black;

}

section{

  border:2px solid grey;
    margin:1px;margin-bottom:10px;padding:8px;
    background-color:	#b1b1b1;


}

article{

  border:2px solid grey;
    margin:10px;padding:8px;
    background-color:	#e1e1e1;


}


p#title{
font-size:300%;
text-align:center;
color:white;
font-family:verdana;

}
nav{
margin-top:5px;
}



body{
background-color:lightgrey;

}
 
figure#tb{
margin:0px 5px;

}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
    
}

li {
    float: left;
}

li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #ddd;
}


li a.active {
    color: white;
    background-color: grey;




</style>
  </head>
  <body>
  <header>
<p id="title"> INDIAN INSTITUTE OF INFORMATION TECHNOLOGY MANIPUR </p>
</header>
<figure id = "tb">
  <img src="a.png" alt="INDIAN INSTITUTE OF INFORMATION TECHNOLOGY MANIPUR" width="100%" height="200px">
  <figcaption>INDIAN INSTITUTE OF INFORMATION TECHNOLOGY MANIPUR(Autonomous College)</figcaption>
</figure>
<nav>
<ul>
<li><a href="homepage.html">ABOUT US</a></li>
<li><a href="academics.html">ACADEMICS</a></li>
<li><a class="active" href="placement.php">ATTENDENCE</a></li>
<li><a href="admission.html">ADMISSION</a></li>
<li><a  href="contactus.html">CONTACT US</a></li>
<ul>
</nav>
<?php
	  $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname =dbms_project";
   $credentials = "user = postgres password=root";

   $db = pg_connect( "$host $port $dbname $credentials"  );
    $sql =<<<EOF
      select roll,imgname from image where prob=(select max(prob) from image);
EOF;
$ret = pg_query($db, $sql);
	  $row = pg_fetch_row($ret);
$sql=<<<EOF
     select * from present_students;
EOF;
$ret=pg_query($db,$sql);

echo '<table border="1" style="width:50%;border-collapse:collapse;padding:25px;background-color:lightgrey; margin-left:300;" >
 <th style="background-color:black; color:white;">No</th>
    <th style="background-color:black; color:white;">Roll No</th>
     <th style="background-color:black; color:white;">  Name </th>';

	  
   while($row = pg_fetch_row($ret)) {
	   
	  echo "<tr>";
		echo "<td>".$row[0]."</td>";
	     echo "<td>".$row[1]."</td>";
		 echo "<td>" .$row[2]. "</td>";
	  echo "</tr>";

	    }
		echo "</table>";
 
	?>
  </body>
</html>
