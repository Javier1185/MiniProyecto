<?php

require_once '../Clases/Calculos.php';
require_once '../Clases/Validaciones.php';

$error      = '';
$estacion   = null;
$info       = [];
$fechaInput = '';
$procesado  = false;

if(isset($_POST['calcular']))
{
    $fechaInput = Validaciones::sanear($_POST['fecha'] ?? '');
    $validacion = Validaciones::validarFecha($fechaInput);

    if(!$validacion['ok'])
    {
        $error = $validacion['error'];
    }
    else
    {
        $estacion  = Calculos::determinarEstacion($validacion['mes'], $validacion['dia']);
        $info      = Calculos::infoEstacion($estacion);
        $procesado = true;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Problema #8 — Estación del Año</title>
<link rel="stylesheet" href="../Componentes/estilos.css">
<link rel="stylesheet" href="estilos.css">
</head>
<body class="<?php echo $estacion ? 'season-'.$estacion : ''; ?>">

<?php include '../Componentes/navbar.php'; ?>

<div class="contenedor <?php echo $estacion ? 'card-season card-'.$estacion : ''; ?>">

    <h1> Problema #8 — Estación del Año</h1>

    <p class="descripcion">
        Ingresa una fecha para descubrir la estación del año correspondiente.
    </p>

    <form method="POST" class="formulario">
        <input type="date" name="fecha" value="<?php echo $fechaInput; ?>" required>
        <button type="submit" name="calcular" class="btn-season-submit">
             Determinar Estación
        </button>
    </form>

    <?php if($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if($procesado && $estacion && !empty($info)): ?>

    <!-- Video de fondo -->
    <div class="season-stage season-<?php echo $estacion; ?>">
        <video class="season-video" autoplay muted loop playsinline>
            <source src="videos/<?php echo $estacion; ?>.mp4" type="video/mp4">
        </video>
        <div class="season-overlay"></div>
        <div class="season-content">
            <div class="season-icon"><?php echo $info['icono']; ?></div>
            <div class="season-name"><?php echo $info['nombre']; ?></div>
            <div class="season-date">
                 <?php echo date('d/m/Y', strtotime($fechaInput)); ?>
            </div>
            <div class="season-range">⏱ <?php echo $info['rango']; ?></div>
        </div>
    </div>

    <!-- Tarjetas de info -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">🌡 Temperatura</div>
            <div class="info-val"><?php echo $info['temperatura']; ?></div>
        </div>
        <div class="info-card">
            <div class="info-label">☁️ Clima</div>
            <div class="info-val"><?php echo $info['clima']; ?></div>
        </div>
        <div class="info-card">
            <div class="info-label">📆 Período</div>
            <div class="info-val"><?php echo $info['rango']; ?></div>
        </div>
        <div class="info-card" style="grid-column:1/-1">
            <div class="info-label">ℹ️ Descripción</div>
            <div class="info-val"><?php echo $info['descripcion']; ?></div>
        </div>
    </div>

    <?php endif; ?>

</div>

<?php include '../Componentes/footer.php'; ?>

</body>
</html>