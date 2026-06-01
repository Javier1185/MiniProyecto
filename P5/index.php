<?php

require_once '../Clases/Calculos.php';
require_once '../Clases/Validaciones.php';

$errores    = [];
$resultado  = null;
$inputs     = [];
$procesado  = false;

if(isset($_POST['calcular']))
{
    $edadesValidas = [];

    for($i = 1; $i <= 5; $i++)
    {
        $val        = Validaciones::sanear($_POST['edad'.$i] ?? '');
        $inputs[$i] = $val;
        $validacion = Validaciones::validarEdad($val, $i);

        if(!$validacion['ok'])
            $errores[] = $validacion['error'];
        else
            $edadesValidas[] = $validacion['valor'];
    }

    if(empty($errores))
    {
        $resultado = Calculos::procesarEdades($edadesValidas);
        $procesado = true;
    }
}

// Colores por categoría
$colores = [
    'Niño'        => '#60a5fa',
    'Adolescente' => '#a78bfa',
    'Adulto'      => '#34d399',
    'Adulto Mayor'=> '#fbbf24'
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Problema #5 — Clasificación de Edades</title>
<link rel="stylesheet" href="../Componentes/estilos.css">
<link rel="stylesheet" href="estilos.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
</head>
<body>

<?php include '../Componentes/navbar.php'; ?>

<div class="contenedor">

    <h1>Problema #5 — Clasificación de Edades</h1>

    <p class="descripcion">
        Ingresa las edades de <strong>5 personas</strong>.
        El sistema las clasificará y generará estadísticas con gráficas.
    </p>

    <form method="POST" class="formulario grid-edades">
        <?php for($i = 1; $i <= 5; $i++): ?>
        <input
            type="number"
            name="edad<?php echo $i; ?>"
            placeholder="Persona <?php echo $i; ?>"
            value="<?php echo $inputs[$i] ?? ''; ?>"
            min="0" max="150" required
        >
        <?php endfor; ?>
        <button type="submit" name="calcular" class="btn-full">Clasificar y Analizar</button>
    </form>

    <?php if(!empty($errores)): ?>
        <?php foreach($errores as $err): ?>
            <p class="error"><?php echo $err; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if($procesado && $resultado): ?>

    <!-- Tabla de clasificaciones -->
    <div class="tabla">
        <table>
            <tr><th>Persona</th><th>Edad</th><th>Categoría</th></tr>
            <?php foreach($resultado['clasificaciones'] as $i => $item): ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $item['edad']; ?> años</td>
                <td>
                    <span class="badge" style="background:<?php echo $colores[$item['categoria']]; ?>22;color:<?php echo $colores[$item['categoria']]; ?>;border:1px solid <?php echo $colores[$item['categoria']]; ?>55;">
                        <?php echo $item['categoria']; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Estadísticas -->
    <div class="stats-grid">
        <div class="stat-box" style="--c:#60a5fa">
            <div class="stat-val"><?php echo $resultado['conteo']['Niño']; ?></div>
            <div class="stat-label">Niños (0–12)</div>
        </div>
        <div class="stat-box" style="--c:#a78bfa">
            <div class="stat-val"><?php echo $resultado['conteo']['Adolescente']; ?></div>
            <div class="stat-label">Adolescentes (13–17)</div>
        </div>
        <div class="stat-box" style="--c:#34d399">
            <div class="stat-val"><?php echo $resultado['conteo']['Adulto']; ?></div>
            <div class="stat-label">Adultos (18–64)</div>
        </div>
        <div class="stat-box" style="--c:#fbbf24">
            <div class="stat-val"><?php echo $resultado['conteo']['Adulto Mayor']; ?></div>
            <div class="stat-label">Adultos Mayores (65+)</div>
        </div>
        <div class="stat-box" style="--c:#e2e8f0">
            <div class="stat-val"><?php echo $resultado['min']; ?></div>
            <div class="stat-label">Edad mínima</div>
        </div>
        <div class="stat-box" style="--c:#e2e8f0">
            <div class="stat-val"><?php echo $resultado['max']; ?></div>
            <div class="stat-label">Edad máxima</div>
        </div>
        <div class="stat-box" style="--c:#e2e8f0">
            <div class="stat-val"><?php echo $resultado['promedio']; ?></div>
            <div class="stat-label">Promedio</div>
        </div>
    </div>

    <!-- Edades repetidas -->
    <?php if(!empty($resultado['repetidas'])): ?>
    <div class="alerta-info">
        🔁 <strong>Edades repetidas:</strong>
        <?php foreach($resultado['repetidas'] as $edad => $freq): ?>
            &nbsp; La edad <strong><?php echo $edad; ?></strong> aparece <strong><?php echo $freq; ?></strong> veces.
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="alerta-ok">✅ No hay edades repetidas.</div>
    <?php endif; ?>

    <!-- Gráficas Chart.js -->
    <div class="charts-grid">
        <div class="chart-box">
            <h3>Cantidad por Categoría</h3>
            <canvas id="chartBarras"></canvas>
        </div>
        <div class="chart-box">
            <h3>Distribución Porcentual</h3>
            <canvas id="chartPie"></canvas>
        </div>
    </div>

    <script>
    const labels  = ['Niño','Adolescente','Adulto','Adulto Mayor'];
    const valores = <?php echo json_encode([
        $resultado['conteo']['Niño'],
        $resultado['conteo']['Adolescente'],
        $resultado['conteo']['Adulto'],
        $resultado['conteo']['Adulto Mayor']
    ], JSON_HEX_TAG); ?>;
    const colores = ['#60a5fa','#a78bfa','#34d399','#fbbf24'];

    const opts = { responsive:true, plugins:{ legend:{ labels:{ color:'#e2e8f0', font:{family:'Segoe UI'} } } } };

    new Chart(document.getElementById('chartBarras'), {
        type:'bar',
        data:{ labels, datasets:[{ label:'Cantidad', data:valores, backgroundColor:colores.map(c=>c+'55'), borderColor:colores, borderWidth:2, borderRadius:6 }] },
        options:{ ...opts, scales:{ y:{ beginAtZero:true, ticks:{color:'#94a3b8',stepSize:1}, grid:{color:'rgba(255,255,255,.06)'} }, x:{ ticks:{color:'#94a3b8'}, grid:{display:false} } } }
    });

    new Chart(document.getElementById('chartPie'), {
        type:'doughnut',
        data:{ labels, datasets:[{ data:valores, backgroundColor:colores.map(c=>c+'bb'), borderColor:colores, borderWidth:2, hoverOffset:8 }] },
        options:{ ...opts, cutout:'52%' }
    });
    </script>

    <?php endif; ?>

</div>
</body>
</html>
