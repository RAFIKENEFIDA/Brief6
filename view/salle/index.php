<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Salle Home</h1>
	<a href="http://localhost/mvc/salle/create"><button>Create</button></a></br>

	<table>
		<?php

		foreach ($salles as $salle) 
		{
			echo "<tr><td>".$salle['id']."</td><td>".$salle['name']."</td><td>".$salle['cap']."</td></tr>";
		}
		?>
		<tr>
			
		</tr>
	</table>
</body>
</html>