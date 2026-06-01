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
     <link rel="stylesheet" href="estilos.css">
    <title>Problema #2</title>

    <style>
       
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