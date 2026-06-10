<?php

require_once '../Clases/Validaciones.php';
require_once '../Clases/Calculos.php';

$potencias = [];
$error = "";

if(isset($_POST['iniciar']))
{
    $numero = $_POST['numero'];

    if(
        Validaciones::esNumero($numero) &&
        Validaciones::rangoValido($numero)
    )
    {
        $potencias = Calculos::generarPotencias($numero);
    }
    else
    {
        $error = "Ingrese un número entre 1 y 9.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../Componentes/estilos.css">
 <link rel="stylesheet" href="estilos.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Potencias de un Número</title>

<style>



</style>

</head>
<body>
<?php include '../Componentes/navbar.php'; ?>
<div class="contenedor">

<h1>Potencias de un Número</h1>

<p class="descripcion">
Ingrese un número del 1 al 9 y se mostrarán sus primeras 15 potencias.
</p>

<form method="POST" class="formulario">

    <input
        type="number"
        name="numero"
        min="1"
        max="9"
        placeholder="Número del 1 al 9"
        required
    >

    <button type="submit" name="iniciar">
         Iniciar
    </button>

</form>

<?php if($error): ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php if(!empty($potencias)): ?>

<div class="tabla">

<table>

    <thead>
        <tr>
            <th>Potencia</th>
            <th>Resultado</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($potencias as $potencia): ?>

        <tr>
            <td>
                <?php echo $_POST['numero']; ?>
                <sup><?php echo $potencia['exponente']; ?></sup>
            </td>

            <td>
                <?php echo number_format($potencia['resultado']); ?>
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</div>

<?php endif; ?>

</div>

<?php include '../Componentes/footer.php'; ?>

</body>
</html>