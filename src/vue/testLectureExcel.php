<!DOCTYPE html>
<html>
	<head>
		<title>O'Notes</title>
	</head>
	<body>
		<form action="../controleur/ControleurImportation.php" method="post" enctype="multipart/form-data">
			<input type="file" id="fichier" name="fichier" accept=".xlsx, excel" />
			<input type="submit">
		</form>
	</body>
</html>