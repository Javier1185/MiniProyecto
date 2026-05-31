<?php
// ── LÓGICA ────────────────────────────────────────────────────────────────────
$error      = null;
$resultados = null;

if (isset($_POST['iniciar'])) {
    $presupuesto = trim($_POST['presupuesto'] ?? '');

    if ($presupuesto === '' || !is_numeric($presupuesto) || (float)$presupuesto <= 0) {
        $error = '⚠️ Ingresa un presupuesto válido mayor a 0.';
    } else {
        $presupuesto = (float)$presupuesto;

        $resultados = [
            'ginecologia'   => $presupuesto * 0.40,
            'traumatologia' => $presupuesto * 0.35,
            'pediatria'     => $presupuesto * 0.25,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Componentes/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto Hospitalario</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #f5f7fa);
            min-height: 100vh;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .12);
        }

        h1 {
            text-align: center;
            color: #1565c0;
            margin-bottom: 30px;
        }

        .formulario {
            text-align: center;
            margin-bottom: 25px;
        }

        input[type="number"] {
            width: 250px;
            padding: 12px;
            border: 2px solid #90caf9;
            border-radius: 10px;
            font-size: 16px;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #1976d2;
        }

        button {
            padding: 12px 25px;
            background: #1976d2;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: .3s;
            margin-left: 10px;
        }

        button:hover {
            background: #0d47a1;
            transform: translateY(-2px);
        }

        .error {
            color: #d32f2f;
            text-align: center;
            margin-top: 15px;
            font-size: 15px;
        }

        /* ── Tarjetas de resultados ── */
        .resultados {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .card {
            flex: 1;
            min-width: 220px;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .gine   { background: #e3f2fd; }
        .trauma { background: #fff3e0; }
        .pedia  { background: #ffebee; }

        .card h3 { margin: 0; }

        .card p {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* ── Gráfica ── */
        .grafica-card {
            margin-top: 35px;
            padding: 25px;
            border-radius: 20px;
            background: #fafafa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        canvas { max-height: 500px; }
    </style>
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
</body>
</html>