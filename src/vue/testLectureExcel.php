<!DOCTYPE html>
<html>
	<head>
		<title>O'Notes</title>
	</head>
	<body>
		<form action="../controleur/ControleurImportation.php" method="post" enctype="multipart/form-data">
			<input type="file" id="moyennes" name="moyennes" accept=".xlsx, excel" />
			<input type="file" id="jury" name="jury" accept=".xlsx, excel" />
			<input type="text" id="semestre" name="semestre" />
			<input type="text" id="promotion" name="promotion" />
			<input type="submit">
		</form>
	</body>
</html>