<?php
include_once 'DataAccess.php';
include_once 'Connection.php';

/**
 * Acceso a datos para el controlador reportes
 */
class GenAsignacionesMod
{

    /**
    * Undocumented function
    *
    * @return object regresa el object connection
    */
    public function Connection()
    {
            $cn = new Connection(HOST, DATABASE, USER, PASSWORD);
            $conn = $cn->SimpleConnectionPDO();
            return $conn['obj_'];
    }

    public function RecuperarProgramaMes($id_mes) 
    {

        $qry_string = <<<EOF
SELECT * FROM vymic.programa_view WHERE id_mes = ?;
EOF;
        $JsonData = '{'
            . '"params":{ ":id_mes":"'.$id_mes.'" },'
            . '"vars":{"NumFuncion":"0","QueryString":"'.$qry_string.'"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';

        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats['obj_'];

    }


    public function RecuperarPublicadores()
    {
        $qry_string = <<<EOF
SELECT id, pub as text FROM cat_pubs WHERE stat = ?;
EOF;

        $JsonData = '{'
            . '"params":{ ":stat":"1" },'
            . '"vars":{"NumFuncion":"0","QueryString":"' . $qry_string . '"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';

        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats['obj_'];
        
    }


    public function RecuperarEstudios()
    {
        $qry_string = <<<EOF
SELECT id, estudio as text FROM cat_estudi WHERE 1 = ?;
EOF;

        $JsonData = '{'
            . '"params":{ ":1":1 },'
            . '"vars":{"NumFuncion":"0","QueryString":"' . $qry_string . '"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';

        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats['obj_'];
        
    }

    public function GenerarAsignacionesAutomaticas($id_mes)
    {

        $qry_string = "call asignarPrimeraVisita($id_mes);";

        $JsonData = '{'
            . '"params":{ ":id_mes":"' . $id_mes . '" },'
            . '"vars":{"NumFuncion":"0","QueryString":"' . $qry_string . '"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';

        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats['obj_'];

    }

    /**
     * Undocumented function
     *
     * @return object regresa un objecto con los datos solicitados por el query
     */
    public function RecuperarAsignadoLecturaBiblica($id_mes) 
    {

        $qry_string = <<<EOF
SELECT id_pub, COUNT(id) AS Participaciones FROM vymic.master_asignaciones WHERE id_asig = 3 AND sex = 'h' GROUP BY id_pub ORDER BY participaciones asc, id_sem LIMIT 1;
EOF;
        $JsonData = '{'
            . '"params":{ ":id_sem":"'.$id_mes.'" },'
            . '"vars":{"NumFuncion":"0","QueryString":"'.$qry_string.'"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';

        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats['obj_'];

    }


}
