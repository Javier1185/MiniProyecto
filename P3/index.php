<?php

require_once '../Clases/Calculos.php';
require_once '../Clases/Validaciones.php';

$multiplos  = [];
$error      = '';
$nValor     = '';
$procesado  = false;

if(isset($_POST['calcular']))
{
    $nValor    = Validaciones::sanear($_POST['n'] ?? '');
    $resultado = Validaciones::validarN($nValor);

    if(!$resultado['ok'])
    {
        $error = $resultado['error'];
    }
    else
    {
        $multiplos = Calculos::generarMultiplosDeCuatro($resultado['valor']);
        $procesado = true;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Problema #3 — Múltiplos de 4</title>
<link rel="stylesheet" href="../Componentes/estilos.css">
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php include '../Componentes/navbar.php'; ?>

<div class="contenedor">

    <h1>Problema #3 — Múltiplos de 4</h1>

    <p class="descripcion">
        Ingresa un valor <strong>N</strong> para generar los primeros N múltiplos del número 4.
    </p>

    <form method="POST" class="formulario">
        <input
            type="number"
            name="n"
            placeholder="Valor de N (ej: 5)"
            value="<?php echo $nValor; ?>"
            min="1" max="10000"
            required
        >
        <button type="submit" name="calcular">Generar Múltiplos</button>
    </form>

    <?php if($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if($procesado && !empty($multiplos)): ?>

    <div class="resumen">
        <span>✅ <?php echo count($multiplos); ?> múltiplos generados</span>
        <span>Máximo: <strong><?php echo number_format(4 * count($multiplos), 0, '.', ','); ?></strong></span>
        <span style="font-size:.78rem;color:#94a3b8;">
            PHP_INT_MAX = <?php echo number_format(PHP_INT_MAX, 0, '.', ','); ?> — sin riesgo de overflow
        </span>
    </div>

    <div class="tabla">
        <table>
            <tr>
                <th>#</th>
                <th>Operación</th>
                <th>Resultado</th>
            </tr>
            <?php foreach($multiplos as $m): ?>
            <tr>
                <td><?php echo $m['factor']; ?></td>
                <td>4 × <?php echo $m['factor']; ?> =</td>
                <td><strong><?php echo number_format($m['resultado'], 0, '.', ','); ?></strong></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php endif; ?>

</div>

<?php include '../Componentes/footer.php'; ?>

</body>
</html>