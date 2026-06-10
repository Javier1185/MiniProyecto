<?php

require_once '../Clases/Validaciones.php';
require_once '../Clases/Calculos.php';

$error = "";
$resultados = null;

if(isset($_POST['iniciar']))
{
    $presupuesto = trim($_POST['presupuesto']);

    if(
        Validaciones::esNumero($presupuesto) &&
        Validaciones::esPositivo($presupuesto)
    )
    {
        $resultados =
            Calculos::calcularPresupuesto($presupuesto);
    }
    else
    {
        $error =
            "⚠️ Ingrese un presupuesto válido mayor que cero.";
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
    <title>Presupuesto Hospitalario</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>
<body>
    <?php include '../Componentes/navbar.php'; ?>
<div class="contenedor">

    <h1> Presupuesto Hospitalario</h1>

    <!-- FORMULARIO -->
    <form method="POST" class="formulario">
        <label><strong>Presupuesto Anual</strong></label>
        <br><br>
        <input
            type="number"
            name="presupuesto"
            step="0.01"
            min="0.01"
            placeholder="Ejemplo: 20000"
            value="<?php echo htmlspecialchars($_POST['presupuesto'] ?? ''); ?>"
            required
        >
        <button type="submit" name="iniciar">Iniciar</button>
    </form>

    <!-- ERROR -->
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- RESULTADOS -->
    <?php if ($resultados): ?>

        <div class="resultados">
            <div class="card gine">
                <h3>🩺 Ginecología (40%)</h3>
                <p>$<?php echo number_format($resultados['ginecologia'], 2); ?></p>
            </div>
            <div class="card trauma">
                <h3>🦴 Traumatología (35%)</h3>
                <p>$<?php echo number_format($resultados['traumatologia'], 2); ?></p>
            </div>
            <div class="card pedia">
                <h3>👶 Pediatría (25%)</h3>
                <p>$<?php echo number_format($resultados['pediatria'], 2); ?></p>
            </div>
        </div>

        <div class="grafica-card">
            <canvas id="grafica"></canvas>
        </div>

        <script>
            Chart.register(ChartDataLabels);

            new Chart(document.getElementById('grafica'), {
                type: 'pie',
                data: {
                    labels: ['Ginecología', 'Traumatología', 'Pediatría'],
                    datasets: [{
                        data: [
                            <?php echo $resultados['ginecologia']; ?>,
                            <?php echo $resultados['traumatologia']; ?>,
                            <?php echo $resultados['pediatria']; ?>
                        ],
                        backgroundColor: ['#4e79a7', '#f28e2b', '#e15759'],
                        borderColor: '#ffffff',
                        borderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribución del Presupuesto Hospitalario',
                            font: { size: 20 }
                        },
                        legend: {
                            position: 'bottom',
                            labels: { font: { size: 14 } }
                        },
                        datalabels: {
                            color: '#fff',
                            font: { weight: 'bold', size: 18 },
                            formatter: (value, context) => {
                                const total = context.chart.data.datasets[0].data
                                    .reduce((a, b) => a + b, 0);
                                return ((value / total) * 100).toFixed(0) + '%';
                            }
                        }
                    }
                }
            });
        </script>

    <?php endif; ?>

</div>

<?php include '../Componentes/footer.php'; ?>

</body>
</html>