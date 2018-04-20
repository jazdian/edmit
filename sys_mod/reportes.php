<?php
include_once 'DataAccess.php';
include_once 'Connection.php';

/**
 * Acceso a datos para el controlador reportes
 */
class Reportes
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

    /**
     * Undocumented function
     *
     * @return object regresa un objecto con los datos solicitados por el query
     */
    public function AsignacionesSemana($id_sem) 
    {

        $qry_string = <<<EOF
SELECT T2.id_sem, T1.id, T3.asignacion AS ASIGNACION, T4.estudio AS ESTUDIO, T5.pub as PUBLICADOR, tipo AS TIPO, T6.pub AS AYUDANTE, coment AS COMENTARIOS FROM reg_asigna T1 INNER JOIN cat_sem_view T2 ON T1.id_sem = T2.id INNER JOIN cat_asig T3 ON T1.id_asig = T3.id INNER JOIN cat_estudi T4 ON T1.id_est = T4.id INNER JOIN cat_pubs T5 ON T1.id_asig = T5.id INNER JOIN cat_pubs T6 ON T1.id_ayu = T6.id WHERE T2.id_sem = ?;
EOF;

        $JsonData = '{'
            . '"params":{ ":id_sem":"'.$id_sem.'" },'
            . '"vars":{"NumFuncion":"0","QueryString":"'.$qry_string.'"},'
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
    public function AsignacionesMes($id_mes) 
    {

        $qry_string = <<<EOF
SELECT T2.id_sem, T1.id, T3.asignacion AS ASIGNACION, T4.estudio AS ESTUDIO, T5.pub as PUBLICADOR, tipo AS TIPO, T6.pub AS AYUDANTE, coment AS COMENTARIOS FROM reg_asigna T1 INNER JOIN cat_sem_view T2 ON T1.id_sem = T2.id INNER JOIN cat_asig T3 ON T1.id_asig = T3.id INNER JOIN cat_estudi T4 ON T1.id_est = T4.id INNER JOIN cat_pubs T5 ON T1.id_asig = T5.id INNER JOIN cat_pubs T6 ON T1.id_ayu = T6.id WHERE CONCAT(T2.anio, T2.mes) = ?;
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


    /**
     * Undocumented function
     *
     * @return object regresa un objecto con los datos solicitados por el query
     */
    public function CatSemanas()
    {

        $qry_string = <<<EOF
SELECT `id_sem` AS `id`, `semana` FROM `cat_sem_view` WHERE 1 = ?;
EOF;

        $JsonData = '{'
            . '"params":{ ":1":"1" },'
            . '"vars":{"NumFuncion":"0","QueryString":"'.$qry_string.'"},'
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
    public function CatMeses() 
    {

        $qry_string = <<<EOF
SELECT `id_mes` AS `id`, `nom_mes` FROM `cat_mes_view` WHERE 1 = ?;
EOF;

        $JsonData = '{'
            . '"params":{ ":1":"1" },'
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