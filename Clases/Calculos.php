<?php

class Calculos
{
    public static function calcularSuma($n)
    {
        return ($n * ($n + 1)) / 2;
    }
// ── PROBLEMA 6: Calcular presupuesto hospitalario
    public static function calcularPresupuesto($presupuesto)
    {
        return [
            'ginecologia' => $presupuesto * 0.40,
            'traumatologia' => $presupuesto * 0.35,
            'pediatria' => $presupuesto * 0.25
        ];
    }
    // ── PROBLEMA 9: Generar potencias de un número
    public static function generarPotencias($numero)
    {
        $potencias = [];

        for($i = 1; $i <= 15; $i++)
        {
            $potencias[] = [
                'exponente' => $i,
                'resultado' => pow($numero, $i)
            ];
        }

        return $potencias;
    }
    
    public static function calcularEstadisticas($numeros)
    {
        $cantidad = count($numeros);

        $media = array_sum($numeros) / $cantidad;

        $suma = 0;

        foreach($numeros as $numero)
        {
            $suma += pow($numero - $media, 2);
        }

        $desviacion = sqrt($suma / $cantidad);

        return [
            "media" => $media,
            "desviacion" => $desviacion,
            "minimo" => min($numeros),
            "maximo" => max($numeros)
        ];
    }

    public static function calcularParesImpares()
    {
        $sumaPares = 0;
        $sumaImpares = 0;

        for($i = 1; $i <= 200; $i++)
        {
            if($i % 2 == 0)
            {
                $sumaPares += $i;
            }
            else
            {
                $sumaImpares += $i;
            }
        }

        return [
            "pares" => $sumaPares,
            "impares" => $sumaImpares
        ];
    }

    // ── PROBLEMA 3: Múltiplos de 4 
    public static function generarMultiplosDeCuatro($n)
    {
        $multiplos = [];
        for($i = 1; $i <= $n; $i++)
        {
            $multiplos[] = [
                'factor'    => $i,
                'resultado' => 4 * $i
            ];
        }
        return $multiplos;
    }

    // ── PROBLEMA 5: Clasificación de edades 
    public static function clasificarEdad($edad)
    {
        if($edad >= 0  && $edad <= 12) return 'Niño';
        if($edad >= 13 && $edad <= 17) return 'Adolescente';
        if($edad >= 18 && $edad <= 64) return 'Adulto';
        return 'Adulto Mayor';
    }

    // Procesa 5 edades: clasificación + estadísticas completas.
    public static function procesarEdades($edades)
    {
        $conteo = ['Niño' => 0, 'Adolescente' => 0, 'Adulto' => 0, 'Adulto Mayor' => 0];
        $clasificaciones = [];

        foreach($edades as $edad)
        {
            $cat = self::clasificarEdad($edad);
            $conteo[$cat]++;
            $clasificaciones[] = ['edad' => $edad, 'categoria' => $cat];
        }

        $frecuencias = array_count_values($edades);
        $repetidas   = array_filter($frecuencias, fn($f) => $f > 1);
        arsort($repetidas);

        return [
            'clasificaciones' => $clasificaciones,
            'conteo'          => $conteo,
            'min'             => min($edades),
            'max'             => max($edades),
            'promedio'        => round(array_sum($edades) / count($edades), 2),
            'repetidas'       => $repetidas
        ];
    }

    // ── PROBLEMA 8: Estación del año
  public static function determinarEstacion($mes, $dia)
{
    // VERANO
    if (
        ($mes == 12 && $dia >= 21) ||
        ($mes == 1) ||
        ($mes == 2) ||
        ($mes == 3 && $dia <= 20)
    ) {
        return 'verano';
    }

    // OTOÑO
    if (
        ($mes == 3 && $dia >= 21) ||
        ($mes == 4) ||
        ($mes == 5) ||
        ($mes == 6 && $dia <= 21)
    ) {
        return 'otono';
    }

    // INVIERNO
    if (
        ($mes == 6 && $dia >= 22) ||
        ($mes == 7) ||
        ($mes == 8) ||
        ($mes == 9 && $dia <= 22)
    ) {
        return 'invierno';
    }

    // PRIMAVERA
    return 'primavera';
}

    // Retorna nombre, ícono e info de la estación.
    public static function infoEstacion($estacion)
{
    $data = [

        'verano' => [
            'nombre' => 'Verano',
            'icono' => '☀️',
            'temperatura' => '25°C – 40°C',
            'clima' => 'Soleado y cálido',
            'rango' => '21 dic – 20 mar',
            'descripcion' => 'Días largos con mucha luz solar y temperaturas máximas del año.'
        ],

        'otono' => [
            'nombre' => 'Otoño',
            'icono' => '🍂',
            'temperatura' => '15°C – 25°C',
            'clima' => 'Fresco y ventoso',
            'rango' => '21 mar – 21 jun',
            'descripcion' => 'Las hojas cambian de color; tardes frescas y amaneceres neblinosos.'
        ],

        'invierno' => [
            'nombre' => 'Invierno',
            'icono' => '❄️',
            'temperatura' => '-5°C – 8°C',
            'clima' => 'Frío y nevado',
            'rango' => '22 jun – 22 sep',
            'descripcion' => 'Noches largas, temperaturas mínimas y posibles nevadas.'
        ],

        'primavera' => [
            'nombre' => 'Primavera',
            'icono' => '🌸',
            'temperatura' => '10°C – 20°C',
            'clima' => 'Templado y florido',
            'rango' => '23 sep – 20 dic',
            'descripcion' => 'Florecimiento de la naturaleza, lluvias suaves y cielos despejados.'
        ]

    ];

    return $data[$estacion] ?? [];
}
}
?>