<?php 

require_once PATH_MODEL . '/index.php';

if (filter_input(INPUT_POST, 'user') !== null && filter_input(INPUT_POST, 'passw') !== null)
{
    $credential = new Index();
    $credential->setUser(filter_input(INPUT_POST, 'user'));
    $credential->setPass(filter_input(INPUT_POST, 'passw'));
    $resp = $credential->CredentialsUser();

    # Si ($resp['num_'] = 1 existe el usuario
    if($resp['num_'] === 1)
    {
        # Si no existe la sesion se crea
        if(!isset($_SESSION['logged']))
        {
            $_SESSION['logged'] = true;
            header("Location: redirect.php");
        }
    }
    else
    {
        $_SESSION['logged'] = false;
    }
}

if (filter_input(INPUT_POST, 'logout') !== null)
{

    // Destruir todas las variables de sesión.
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();
    header("Location: redirect.php");

}

if(isset($_SESSION['logged']))
{
    include_once PATH_VIEW . '/index.php';
    
}
else
{
    include_once PATH_ROOT . '/login.php';
}

