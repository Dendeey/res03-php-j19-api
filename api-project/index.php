<?php

require "autoload.php";

try {

    $router = new Router();

    if(isset($_GET['path']))
    {
        $request = "/".$_GET['path'];
    }
    else
    {
        $request = "/";
    }
    
    $router->route($routes, $request);
}
catch(Exception $e)
{
    if($e->getCode() === 404)
    {
        
    }
}

$pushUserInDatabase = new User(6, "Dendeey", "David", "Sim", "david@david.fr");
var_dump(createUser($pushUserInDatabase));

?>