<?php
# Constantes del  Sistema...
require_once $_SERVER['DOCUMENT_ROOT'] . '/edmit/sys_config/config.php';
/**
 * Description of AJAX
 *
 * @author jazzd
 */
if (isset($_POST['MyJson'])) {

    $MiJson = array();
    $MiJson = $_POST['MyJson'];

    foreach ($MiJson as $key => $value) {
        if ($key === 'vars') {
            $ArrayVars = $value;
        }
    }

    switch ($ArrayVars['NomFunction']) {
        case 'CreaTablaAsignaciones':
            include_once PATH_CLLER . '/reportes.controller.php';
            break;
        case 'CreaComboSemanas':
            include_once PATH_CLLER . '/reportes.controller.php';
            break;
        case 'CreaComboMes':
            include_once PATH_CLLER . '/reportes.controller.php';
            break;
        case 'CreaTablaAsignacionesMes':            
            include_once PATH_CLLER . '/reportes.controller.php';
            break;
        default:
            break;
    }
}
