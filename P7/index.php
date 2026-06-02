<?php
require_once '../Clases/Calculos.php';
require_once '../Clases/Validaciones.php';
$resultado = [];
$error = "";

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../Componentes/estilos.css">
<link rel="stylesheet" href="estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Problema #7</title>

</head>
<body>
<?php include '../Componentes/navbar.php'; ?>
<div class="contenedor">

<h1>Problema #7</h1>

<p class="descripcion">
Calcular promedio, desviación estándar, nota mínima y máxima.
</p>

<?php if(!isset($_POST['generar']) && !isset($_POST['calcular'])): ?>

<form method="POST" class="formulario">

    <input
        type="number"
        name="cantidad"
        min="1"
        placeholder="Cantidad de notas"
        required
    >

    <button type="submit" name="generar">
        Generar Campos
    </button>

</form>

<?php endif; ?>


<?php if(isset($_POST['generar'])): ?>

<form method="POST" class="formulario">

<?php

$cantidad = $_POST['cantidad'];

for($i = 1; $i <= $cantidad; $i++):
?>

<input
    type="number"
    step="0.01"
    name="notas[]"
    placeholder="Nota <?php echo $i; ?>"
    required
>

<br>

<?php endfor; ?>

<button type="submit" name="calcular">
    Calcular
</button>

</form>

<?php endif; ?>


<?php


if(isset($_POST['calcular']))
{
    $notas = $_POST['notas'];

    if(Validaciones::validarPositivos($notas))
    {
        $estadisticas = Calculos::calcularEstadisticas($notas);

        $resultado = [
            "promedio" => $estadisticas["media"],
            "desviacion" => $estadisticas["desviacion"],
            "minima" => $estadisticas["minimo"],
            "maxima" => $estadisticas["maximo"]
        ];
    }
    else
    {
        $resultado = [];
        $error = "Todas las notas deben ser números positivos.";
    }
}
?>

<?php if(!empty($resultado)): ?>

<table>
    
 
<tr>
    <th>Dato</th>
    <th>Resultado</th>
</tr>

<tr>
    <td>Promedio</td>
    <td><?php echo number_format($resultado['promedio'],2); ?></td>
</tr>

<tr>
    <td>Desviación Estándar</td>
    <td><?php echo number_format($resultado['desviacion'],2); ?></td>
</tr>

<tr>
    <td>Nota Mínima</td>
    <td><?php echo $resultado['minima']; ?></td>
</tr>

<tr>
    <td>Nota Máxima</td>
    <td><?php echo $resultado['maxima']; ?></td>
</tr>

</table>

<?php endif; ?>

</div>

</body>
</html>