<?php

require_once PATH_MODEL . '/reportes.php';
require_once PATH_CTRLS . '/DataTable.php';
require_once PATH_CTRLS . '/ComboBox.php';


class ReportesController
{

    public function TablaAsignacionesSem($id) 
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
        $html_combo = $cmb_dat_sem->RunComboBox();
        return $html_combo;
    }

    public function ComboCatMes()
    {
        $num_mes = date("m");
        $cero = substr($num_mes, 0, 1);

        if($cero === '0')
        {
            $num_mes = substr($num_mes, 1, 1);
        }

        $anio = date('Y');
        $id = $anio . $num_mes;

        $obj_dat = new Reportes();
        $dat_sem = $obj_dat->CatMeses();

        $cmb_dat_mes = new ComboBox();
        $cmb_dat_mes->SetID('CmbCatMes');
        $cmb_dat_mes->SetClass('form-control');
        $cmb_dat_mes->SetDataValueField('id');
        $cmb_dat_mes->SetDataTextField('nom_mes');
        $cmb_dat_mes->SetValSelected($id);
        $cmb_dat_mes->SetAddRowFirst('.:Selecciona un mes:.');
        $cmb_dat_mes->SetOnChange('CreaTablaAsignacionesMes()');
        $cmb_dat_mes->SetDataSource($dat_sem);
        $html_combo = $cmb_dat_mes->RunComboBox();
        return $html_combo;
    }

    public function TablaAsignacionesMes($id) 
    {

        $rep_mes = new Reportes();
        $dat_rep_mes = $rep_mes->AsignacionesMes($id);

        $tab_rep_mes = new DataTable();
        $tab_rep_mes->SetID('TabMes');
        $tab_rep_mes->SetClass('display');
        $tab_rep_mes->SetDataSource($dat_rep_mes);
        $html_table = $tab_rep_mes->CreateDT();
        return $html_table;

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

    $ajx = new ReportesController();


    if ($ArrayVars['NomFunction'] == 'CreaTablaAsignaciones') {
        $dats = $ajx->TablaAsignacionesSem($ArrayVars['id_sem']);
        echo $dats;
    } else if ($ArrayVars['NomFunction'] == 'CreaComboSemanas') {
        $dats = $ajx->ComboCatSemana();
        echo $dats;
    } else if ($ArrayVars['NomFunction'] == 'CreaComboMes') {
        $dats = $ajx->ComboCatMes();
        echo $dats;
    } else if ($ArrayVars['NomFunction'] == 'CreaTablaAsignacionesMes') {
        $dats = $ajx->TablaAsignacionesMes($ArrayVars['id_mes']);
        echo $dats;
    }

}

// =============================================================================

