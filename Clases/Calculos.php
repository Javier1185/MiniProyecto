<?php

class Calculos
{
    public static function calcularSuma($n)
    {
        return ($n * ($n + 1)) / 2;
    }

    public static function calcularPresupuesto($presupuesto)
    {
        return [
            'ginecologia' => $presupuesto * 0.40,
            'traumatologia' => $presupuesto * 0.35,
            'pediatria' => $presupuesto * 0.25
        ];
    }
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
}
?>