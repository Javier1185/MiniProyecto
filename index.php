<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Menú Principal</title>

<link rel="stylesheet" href="Componentes/estilos.css">

<style>

.tarjetas{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    justify-content:center;
}

.card{
    width:280px;
    background:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.card h2{
    margin-bottom:15px;
}

.card a{
    display:inline-block;
    padding:10px 20px;
    background:#06b6d4;
    color:white;
    text-decoration:none;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="contenedor">

<h1>Taller de Programación PHP</h1>

<div class="tarjetas">

    <div class="card">
        <h2>Problema 2</h2>
        <p>Suma de números del 1 al 1000.</p>
        <br>
        <a href="P2/index.php">Abrir</a>
    </div>

    <div class="card">
        <h2>Problema 6</h2>
        <p>Presupuesto Hospitalario.</p>
        <br>
        <a href="P6/index.php">Abrir</a>
    </div>

    <div class="card">
        <h2>Problema 9</h2>
        <p>Potencias de un número.</p>
        <br>
        <a href="P9/index.php">Abrir</a>
    </div>

</div>

</div>

</body>

</html>