<?php
    use Core\RouterService\Router;

    function basicCRUD($ctrl, $callback = null){
        return function() use ($ctrl, $callback){
            Router::get("", "{$ctrl}@read");
            Router::get("{id}", "{$ctrl}@read");
            Router::get("delete/{id}", "{$ctrl}@delete");        
            Router::post("", "{$ctrl}@save");
            if($callback != null) $callback();
        };
    }

    Router::get("", "WebCtrl@dashboard");    
    Router::post("upload/{path}", "WebCtrl@fileUpload");    
    Router::prefix("categories", basicCRUD("CategoriesCtrl"));     
    Router::prefix("products", basicCRUD("ProductsCtrl"));