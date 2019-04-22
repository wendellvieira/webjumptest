<?php
    require __DIR__ . "/vendor/autoload.php";

    use \Core\RouterService\Router;
    use \Core\BuilderService\Build;
    use \Core\ProviderService\Provider;    

    Provider::provide();

    $app = new Build;
    $app->build();    

?>