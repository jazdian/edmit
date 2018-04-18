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
            require_once PATH_CLLER . '/reportes.controller.php';
            break;
        case 'SaveNewClient':
            include_once PATH_CLLER . '/ajax.controller.php';
            break;
        case 'RetenerTabAgen':
            //include_once '../business/classAsignacionTabletas.php';
            break;
        default:
            break;
    }
}
