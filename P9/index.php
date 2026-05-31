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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Potencias de un Número</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#0f172a,#1e293b);
    min-height:100vh;
    padding:30px;
}

.contenedor{
    max-width:900px;
    margin:auto;
    background:#ffffff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,.35);
}

h1{
    text-align:center;
    color:#06b6d4;
    margin-bottom:15px;
}

.descripcion{
    text-align:center;
    color:#64748b;
    margin-bottom:30px;
}

input{
    width:250px;
    padding:12px;
    border:2px solid #06b6d4;
    border-radius:10px;
    font-size:16px;
}

input:focus{
    outline:none;
    border-color:#0891b2;
    box-shadow:0 0 10px rgba(6,182,212,.3);
}

button{
    padding:12px 25px;
    background:#06b6d4;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
    margin-left:10px;
}

button:hover{
    background:#0891b2;
    transform:translateY(-2px);
}

.error{
    color:#ef4444;
    text-align:center;
    margin-top:15px;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
    overflow:hidden;
    border-radius:15px;
}

th{
    background:#06b6d4;
    color:white;
    padding:14px;
    font-size:17px;
}

td{
    padding:14px;
    text-align:center;
}

tr:nth-child(even){
    background:#f1f5f9;
}

tr:nth-child(odd){
    background:#ffffff;
}

tr:hover{
    background:#cffafe;
    transition:.3s;
}

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

</body>
</html>