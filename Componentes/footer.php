<?php
// Footer reutilizable — DRY: un solo archivo para los 9 problemas
// La fecha se genera automáticamente con date() de PHP
$meses = [
    'January'=>'enero','February'=>'febrero','March'=>'marzo',
    'April'=>'abril','May'=>'mayo','June'=>'junio',
    'July'=>'julio','August'=>'agosto','September'=>'septiembre',
    'October'=>'octubre','November'=>'noviembre','December'=>'diciembre'
];
$fechaActual = strtr(date('d \d\e F \d\e Y'), $meses);
?>
<footer class="footer-principal">
    <div class="footer-contenido">
        <span class="footer-uni">Universidad Tecnológica de Panamá</span>
        <span class="footer-sep">|</span>
        <span class="footer-materia">Desarrollo Web VII</span>
        <span class="footer-sep">|</span>
        <span class="footer-fecha"><?php echo $fechaActual; ?></span>
    </div>
</footer>