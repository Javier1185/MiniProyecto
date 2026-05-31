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
}
?>