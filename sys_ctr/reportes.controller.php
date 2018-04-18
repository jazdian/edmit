<?php

require_once PATH_MODEL . '/reportes.php';
require_once PATH_CTRLS . '/DataTable.php';
require_once PATH_CTRLS . '/ComboBox.php';


class ReportesController
{

    public function TablaSemanas($id) 
    {

        $rep_sem = new Reportes();
        $dat_rep_sem = $rep_sem->AsignacionesSemana($id);

        $tab_rep_sem = new DataTable();
        $tab_rep_sem->SetID('TabSemana');
        $tab_rep_sem->SetClass('display');
        $tab_rep_sem->SetDataSource($dat_rep_sem);
        $html_table = $tab_rep_sem->CreateDT();
        return $html_table;
  
    }

    public function ComboCatSemana()
    {
        $num_sem = date("W");
        $anio = date('Y');
        $id = $anio . $num_sem;

        $obj_dat = new Reportes();
        $dat_sem = $obj_dat->CatSemanas();

        $cmb_dat_sem = new ComboBox();
        $cmb_dat_sem->SetID('CmbCatSemanas');
        $cmb_dat_sem->SetClass('form-control');
        $cmb_dat_sem->SetDataValueField('id');
        $cmb_dat_sem->SetDataTextField('semana');
        $cmb_dat_sem->SetValSelected($id);
        $cmb_dat_sem->SetAddRowFirst('.:Selecciona una semana:.');
        $cmb_dat_sem->SetOnChange('CreaTablaAsignaciones()');
        $cmb_dat_sem->SetDataSource($dat_sem);
        return $cmb_dat_sem->RunComboBox();
    }
    
}

// SE RECUPERAN LOS DATOS SOLICITADOS POR AJAX =================================

$ajx = new ReportesController();

if (isset($_POST['MyJson'])) {

    $MiJson = array();
    $MiJson = $_POST['MyJson'];

    foreach ($MiJson as $key => $value) {
        if ($key === 'vars') {
            $ArrayVars = $value;
        }
    }

    if ($ArrayVars['NomFunction'] == 'CreaTablaAsignaciones') {
        $dats = $ajx->TablaSemanas($ArrayVars['id_sem']);
        echo $dats;
    } else if ($ArrayVars['NomFunction'] == 'SaveNewClient') {

        $ajx->SetId($ArrayVars['id']);
        $ajx->setName($ArrayVars['name']);
        $ajx->setApaterno($ArrayVars['apaterno']);
        $ajx->setAmaterno($ArrayVars['amaterno']);
        $ajx->setCallenum($ArrayVars['callenum']);
        $ajx->setDireccion($ArrayVars['direction']);
        $ajx->setTelefono($ArrayVars['telefono']);
        $ajx->setSexo($ArrayVars['sexo']);

        $dats = $ajx->SaveData();
        $jdats = json_encode($dats);
        echo $jdats;
    }

}

// =============================================================================

$combo_semanas = new ReportesController();

include_once PATH_VIEW . '/rep_semana.php';
