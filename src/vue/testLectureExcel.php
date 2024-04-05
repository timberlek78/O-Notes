<!DOCTYPE html>
<html>
	<head>
		<title>O'Notes</title>
	</head>
	<body>
		<form action="../controleur/ControleurImportation.php" method="post" enctype="multipart/form-data">
			<div>
				<label for="moyenne">Fichier moyennes</label>
				<input type="file" id="moyenne" name="moyenne" accept=".xlsx, excel" />
			</div>
			<div>
				<label for="jury">Fichier jury</label>
				<input type="file" id="jury" name="jury" accept=".xlsx, excel" />
			</div>
			<div>
				<label for="coef">Fichier coef</label>
				<input type="file" id="coef" name="coef" accept=".xlsx, excel" />
			</div>
			
			<br>
			<label for="semestre">Semestre</label>
			<input type="text" id="semestre" name="semestre" />
			<label for="promotion">Promotion</label>
			<input type="text" id="promotion" name="promotion" />
			<label for="alternance">En alternance</label>
			<input type="checkbox" id="alternance" name="alternance" />
			<input type="submit">
		</form>
	</body>
</html>