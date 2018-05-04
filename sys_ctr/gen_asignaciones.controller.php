<?php
require_once PATH_MODEL . '/gen_asignaciones.php';

class GenAsignacionesCtler
{

    function GenerarAsignadoLecturaBiblica($id_mes) {
    
        $asi_lb = new GenAsignacionesMod();
        $dat_asi_lb = $asi_lb->RecuperarAsignadoLecturaBiblica($id_mes);
        return $dat_asi_lb;
    }

    function RecuperarProgramaMes($id_mes)
    {
        $asig_mes = new GenAsignacionesMod();
        $dat_asig_mes = $asig_mes->RecuperarProgramaMes($id_mes);
        return $dat_asig_mes;
    }
    
    function RecuperaPublicadores()
    {
        $pubs = new GenAsignacionesMod();
        $dats_pubs = $pubs->RecuperarPublicadores();
        return $dats_pubs;
    }

    function RecuperaEstudios()
    {
        $estud = new GenAsignacionesMod();
        $dats_estud = $estud->RecuperarEstudios();
        return $dats_estud;
    }

    public function GenerarAsignacionesAutomaticas($id_mes) 
    {
        $lecbib = new GenAsignacionesMod();
        $dats_lecbib = $lecbib->GenerarAsignacionesAutomaticas($id_mes);
        return $dats_lecbib;
    }    

}

// SE RECUPERAN LOS DATOS SOLICITADOS POR AJAX =================================

if (isset($_POST['MyJson'])) {

    $MiJson = array();
    $MiJson = $_POST['MyJson'];

    foreach ($MiJson as $key => $value) {
        if ($key === 'vars') {
            $ArrayVars = $value;
        }
    }

    $ajx = new GenAsignacionesCtler();

    if ($ArrayVars['NomFunction'] == 'GenerarReporteAsignaciones') {
        $dats = $ajx->GenerarAsignadoLecturaBiblica($ArrayVars['id_mes']);
        echo json_encode($dats);
    } else if ($ArrayVars['NomFunction'] == 'RecuperarProgramaMes') {
        $dats = $ajx->RecuperarProgramaMes($ArrayVars['id_mes']);
        echo json_encode($dats);
    } else if ($ArrayVars['NomFunction'] == 'RecuperaPublicadores') {
        $dats = $ajx->RecuperaPublicadores();
        echo json_encode($dats);
    } else if ($ArrayVars['NomFunction'] == 'RecuperaEstudios') {
        $dats = $ajx->RecuperaEstudios();
        echo json_encode($dats);
    } else if ($ArrayVars['NomFunction'] == 'GenerarAsignacionesAutomaticas') {
        $dats = $ajx->GenerarAsignacionesAutomaticas($ArrayVars['id_mes']);
        echo json_encode($dats);
    }

}

// =============================================================================
