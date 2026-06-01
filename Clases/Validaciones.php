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
}
?>