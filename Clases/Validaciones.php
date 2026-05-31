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
}
?>