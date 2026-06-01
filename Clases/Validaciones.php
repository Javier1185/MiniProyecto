<?php

class Validaciones
{
    public static function esNumero($valor)
    {
        return is_numeric($valor);
    }

    public static function esPositivo($valor)
    {
        return $valor > 0;
    }
     public static function rangoValido($valor)
    {
        return $valor >= 1 && $valor <= 9;
    }
    public static function validarPositivos($numeros)
    {
        foreach($numeros as $numero)
        {
            if(!is_numeric($numero) || $numero <= 0)
            {
                return false;
            }
        }

        return true;
    }

    // ── PROBLEMA 3: Validar N para múltiplos 
    public static function validarN($valor)
    {
        if(!preg_match('/^\d+$/', trim($valor)))
            return ['ok' => false, 'error' => 'N debe ser un número entero positivo (solo dígitos).', 'valor' => 0];

        $n = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 10000]]);

        if($n === false)
            return ['ok' => false, 'error' => 'N debe estar entre 1 y 10,000 para evitar desbordamiento.', 'valor' => 0];

        return ['ok' => true, 'error' => '', 'valor' => $n];
    }

    // ── PROBLEMA 5: Validar una edad 
    public static function validarEdad($valor, $indice)
    {
        if(trim($valor) === '')
            return ['ok' => false, 'error' => "La edad #{$indice} es requerida.", 'valor' => 0];

        if(!preg_match('/^\d+$/', trim($valor)))
            return ['ok' => false, 'error' => "La edad #{$indice} debe ser un número entero sin decimales.", 'valor' => 0];

        $edad = filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 150]]);

        if($edad === false)
            return ['ok' => false, 'error' => "La edad #{$indice} debe estar entre 0 y 150 años.", 'valor' => 0];

        return ['ok' => true, 'error' => '', 'valor' => $edad];
    }

    // ── PROBLEMA 8: Validar fecha 
    public static function validarFecha($valor)
    {
        $vacio = ['ok' => false, 'error' => '', 'dia' => 0, 'mes' => 0, 'anio' => 0];

        if(trim($valor) === '')
            return array_merge($vacio, ['error' => 'La fecha es requerida.']);

        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $valor))
            return array_merge($vacio, ['error' => 'Formato de fecha inválido. Use YYYY-MM-DD.']);

        [$anio, $mes, $dia] = explode('-', $valor);

        if(!checkdate((int)$mes, (int)$dia, (int)$anio))
            return array_merge($vacio, ['error' => 'La fecha ingresada no existe en el calendario.']);

        return ['ok' => true, 'error' => '', 'dia' => (int)$dia, 'mes' => (int)$mes, 'anio' => (int)$anio];
    }

    // ── Sanitizar entrada (OWASP: prevenir XSS) ─────────────────
    public static function sanear($valor)
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
    }
}
?>
