# Considerações
Entrega da avaliação de Backend; Nesta avaliação não fora aplicadas técnicas de frontend pois a mesma visa apenas avaliar backend; 
> Avaliação rodando em [Sandbox Gojumpers](http://gojumpers.kdcweb.com.br) 
> Para uma avalição de Frontend usar o seguinte teste [Avaliação Vue](https://github.com/wendellvieira/feracode-test); 

> Caso seja de interesse segue o meu portfólio mais recente:
* [Stoot Digital](https://stootdigital.com/#/)
* [ClubeSign](https://clubedosign.com.br/)
* [Galaxy BTC](http://sandbox.kdcweb.com.br/galaxybtc/beta/)
* [Primal Source](http://sandbox.kdcweb.com.br/primal_source/v5/)


## Tecnologias
* **Composer** : Gerenciador de pacotes PHP
* **Vue.js** : Api JS para a construção de interfaces de usuário.

## Instalação
* Clone os arquivos desse repositório para dentro da pasta /htdocs do seu xammp
* Crie um banco de dados e importe as as tabelas do arquivo /database/goJumpers.sql
* Configure os dados de acesso dentro do arquivo /api/src/App/Settings.php
```php
class Settings {
    protected $host='127.0.0.1';
    protected $user='root';
    protected $pass='';
    protected $db='webjump';
}
```

## Acerca do Core
Desenvolvi o Core da aplicação baseado em MVC, o mesmo tem divisão das seguintes responsabilidades
* **RouterService** : Montar a array de avalição de rotas
* **BuilderService** : Relacionar o request com as regras cadastradas pelo RouterService
* **DatabaseService** : Prover a classe de gerenciamento do banco de dados
* **ProviderService** : Gerencia as interações entre os acima listados 

## Acerca da Aplicação
Todas as configurações devem ser definidas em **Settings.php**
* **Models** : Devem estender as class de manipulação "Database" e definir a tabela a qual o model é referente
EXP:.
```php
class Categorie extends Database {
    // Definição de tabela do model
    protected $table = "categories";
}
```

* **Controllers** : Devem especificar os methodos que deverão ser invocados pelas rotas, caso seja nescessário podem estender a classe "BaseCtrl", a mesma contém instruções de comportamento para um crud simples
```php
class CategoriesCtrl extends BaseCtrl {        
    public function __construct(){
        // nesse caso uma instancia de um model deve ser criada no construct da classe
        $this->model = new Categorie;
    }        
}
```

* **Routes** : Contém informações relevantes para as rotas do projeto;
```php
//Rota simples
Router::get("", "WebCtrl@dashboard");

// Rota para Controllers que extendem o method BaseCtrl
Router::prefix("categories", basicCRUD("CategoriesCtrl"));
```

## O import CLI
O arquivo responsável por importar é "/api/import.php" ele importa automaticamente produtos e categorias presentes em arquivos .csv; para executar basta rodar o comando abaixo

```sh
$ php import.php --file=[file]
```

## O teste automatizado
Para o teste automatizado foi utilizado a extenção de [Selenium IDE](https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd). 
O teste se encontra dentro da pasta /tests

