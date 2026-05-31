<?php

require_once '../Clases/Validaciones.php';
require_once '../Clases/Calculos.php';

$resultado = "";

if (isset($_POST['iniciar'])) {

    $limite = 1000;

    if (
        Validaciones::esNumero($limite) &&
        Validaciones::esPositivo($limite)
    ) {
        $resultado = Calculos::calcularSuma($limite);
    } else {
        $resultado = "Error en los datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Componentes/estilos.css">
    <title>Problema #2</title>

    <style>
        body{
             font-family: Arial, sans-serif;
    background:#f4f4f4;
    margin:0;
    padding:20px;
        }

        .contenedor{
            background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 10px rgba(0,0,0,0.2);
    text-align:center;
    width:350px;
    margin:40px auto;
        }

        button{
            background:#007bff;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            background:#0056b3;
        }

        .resultado{
            margin-top:20px;
            font-size:22px;
            font-weight:bold;
            color:green;
        }
    </style>
</head>
<body>
<?php include '../Componentes/navbar.php'; ?>
<div class="contenedor">
    <h2>Problema #2</h2>
    <p>Calcular la suma de los números del 1 al 1000</p>

    <form method="POST">
        <button type="submit" name="iniciar">
            Iniciar
        </button>
    </form>

    <?php if($resultado !== ""): ?>
        <div class="resultado">
            Resultado: <?php echo $resultado; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>