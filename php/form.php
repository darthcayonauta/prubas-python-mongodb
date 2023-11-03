<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Ingreso de Datos</title>
</head>
<body>

<h1>Formulario de Ingreso de Datos</h1>

<form method="POST" action="procesar_formulario.php">
    <label for="name">Nombre:</label>
    <input type="text" name="name" required><br><br>

    <label for="age">Edad:</label>
    <input type="number" name="age" required><br><br>

    <label for="department">Departamento:</label>
    <input type="text" name="department" required><br><br>

    <label for="date">Fecha:</label>
    <input type="datetime-local" name="date" required><br><br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>

