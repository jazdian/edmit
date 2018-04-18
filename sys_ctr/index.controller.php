<?php 

require_once PATH_MODEL . '/index.php';

if (filter_input(INPUT_POST, 'user') !== null && filter_input(INPUT_POST, 'passw') !== null)
{
    $credential = new Index();
    $credential->setUser(filter_input(INPUT_POST, 'user'));
    $credential->setPass(filter_input(INPUT_POST, 'passw'));
    $resp = $credential->CredentialsUser();

    if($resp['est_'])
    {
        $_SESSION['logged'] = true;
    }
    else
    {
        $_SESSION['logged'] = false;
    }
}


if(isset($_SESSION['logged']))
{
    include_once PATH_VIEW . '/index.php';
}
else
{
    include_once PATH_ROOT . '/login.php';
}

