<?php
require_once '../Clases/Validaciones.php';
require_once '../Clases/Calculos.php';

require_once '../Clases/Calculos.php';

$resultado = [];

if(isset($_POST['calcular']))
{
    $resultado = [ 
    "pares" => Calculos::calcularParesImpares()['pares'], 
    "impares" => Calculos::calcularParesImpares()['impares'] 
    ];
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../Componentes/estilos.css">


<title>Problema #4</title>

</head>
<body>
<?php include '../Componentes/navbar.php'; ?>

<div class="contenedor">

<h1>Problema #4</h1>

<p class="descripcion">
Calcular la suma de los números pares e impares comprendidos entre 1 y 200.
</p>

<form method="POST" class="formulario">

    <button type="submit" name="calcular">
        Calcular
    </button>

</form>

<?php if(!empty($resultado)): ?>

<table>

<tr>
    <th>Tipo</th>
    <th>Resultado</th>
</tr>

<tr>
    <td>Suma de Pares</td>
    <td><?php echo $resultado['pares']; ?></td>
</tr>

<tr>
    <td>Suma de Impares</td>
    <td><?php echo $resultado['impares']; ?></td>
</tr>

</table>

<?php endif; ?>

</div>

<?php include '../Componentes/footer.php'; ?>

</body>
</html>