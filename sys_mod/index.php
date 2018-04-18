<?php
include_once 'DataAccess.php';
include_once 'Connection.php';

/**
 * Acceso a datos para el controlador Index y login
 */
class Index
{

    private $user = '';
    private $pass = '';
    
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
    public function CredentialsUser() 
    {
        $JsonData = '{'
            . '"params":{":user":"'.$this->user.'", "pass":"'.$this->pass.'" },'
            . '"vars":{"NumFuncion":"0","QueryString":"SELECT `id`, `user`, `pass`, `fecha` FROM `sys_login` WHERE user = ? and pass = ?"},'
            . '"logs":{"usuario":"Rene","fecha":""}'
            . '}';
        $exc = new DataAccess();
        $exc->SetConn($this->Connection());
        $exc->SetJsonParams(json_decode($JsonData));

        $dats = $exc->ExecStoredProcedure();
        return $dats;

    }


    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}

