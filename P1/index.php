<?php

require_once '../Clases/Calculos.php';
require_once '../Clases/Validaciones.php';  

$resultado = [];
$error = "";

if(isset($_POST['calcular']))
{
    $numeros = [
        $_POST['n1'],
        $_POST['n2'],
        $_POST['n3'],
        $_POST['n4'],
        $_POST['n5']
    ];
    
if(Validaciones::validarPositivos($numeros))
{
    $resultado = Calculos::calcularEstadisticas($numeros);
}
else
{
    $error = "Todos los números deben ser positivos.";
}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../Componentes/estilos.css">
<link rel="stylesheet" href="estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Problema #1</title>
</head>
<body>
<?php include '../Componentes/navbar.php'; ?>

<div class="contenedor">

    <h1>Problema #1</h1>

    <p class="descripcion">
        Calcular la media, desviación estándar, número mínimo y número máximo
        de los 5 primeros números positivos introducidos.
    </p>

    <form method="POST" class="formulario">

        <input type="number" step="any" name="n1" placeholder="Número 1" required>

        <input type="number" step="any" name="n2" placeholder="Número 2" required>

        <input type="number" step="any" name="n3" placeholder="Número 3" required>

        <input type="number" step="any" name="n4" placeholder="Número 4" required>

        <input type="number" step="any" name="n5" placeholder="Número 5" required>

        <button type="submit" name="calcular">
            Calcular
        </button>

    </form>

    <?php if($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if(!empty($resultado)): ?>

    <div class="tabla">

        <table>

            <tr>
                <th>Dato</th>
                <th>Resultado</th>
            </tr>

            <tr>
                <td>Media</td>
                <td><?php echo number_format($resultado['media'], 2); ?></td>
            </tr>

            <tr>
                <td>Desviación Estándar</td>
                <td><?php echo number_format($resultado['desviacion'], 2); ?></td>
            </tr>

            <tr>
                <td>Número Mínimo</td>
                <td><?php echo $resultado['minimo']; ?></td>
            </tr>

            <tr>
                <td>Número Máximo</td>
                <td><?php echo $resultado['maximo']; ?></td>
            </tr>

        </table>

    </div>

    <?php endif; ?>

</div>

</body>
</html>