<?php
    namespace Core\ProviderService;

    use Core\RouterService\Router;

    class RouterProvider extends ProviderBase {
        public $items = [
            "mapApiRoutes"
        ];

        public function mapApiRoutes(){
            Router::prefix("/api", function(){
                require_once __DIR__ . '/../../App/Routes/api.php';
            });
        }
    }