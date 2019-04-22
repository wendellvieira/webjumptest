<?php

    require __DIR__ . "/vendor/autoload.php";

    use \App\Models\Categorie;
    use \App\Models\Product;

    class ImportFiles {
        private $args;
        private $indexs;
        private $cat;
        private $prod;

        public function __construct(){
            $this->cat = new Categorie;
            $this->prod = new Product;
            $this->args = $this->arguments($GLOBALS["argv"]);
            echo "Iniciando importacao...\n";

            if( isset($this->args['file']) ){
                $file = __DIR__ . "/{$this->args['file']}";
                if( is_file($file) ){
                    $arquivo = fopen( $file,'r' );
        
                    // Montando a linha zero...
                    $this->indexs = fgets($arquivo);
                    $this->indexs = explode( ";", $this->clearLine($this->indexs) );

                    echo "Importando";
                    $count = 0;
        
                    // Iniciando a importação dos dados...
                    while(!feof($arquivo)) {
                        $linha = fgets($arquivo);
                        $linha = $this->clearLine($linha);
                        if( !empty($linha) ){
                            $count++;
                            $linha = $this->relation($linha);    
                            if( isset($linha['category']) ) 
                                $linha['category'] = $this->importCategories($linha['category']);
                            
                            $this->importProducts($linha);
                            echo ".";
                        }

                        // if($count == 5) break;
                    }
                    fclose($arquivo);
                    echo "\n Importacao realizado com sucesso \n Total de: {$count} registros";
                }else{
                    echo "Arquivo inexistente...";
                }
            }else{
                echo "Informe um arquivo...";
            }
        }

        protected function importProducts($prod){
            $cloneProd = clone $this->prod;
            $cloneProd->fill($prod);
            $cloneProd->save();
        }

        protected function importCategories($cats){
            $codsCats = [];
            foreach ($cats as $cat) {
                $cloneCat = clone $this->cat;
                $dbCat = $cloneCat->select("code")->where("code", md5($cat))->get();
                if( $dbCat == null ){
                    $cloneCat = clone $this->cat;
                    $cloneCat->code = md5($cat);
                    $cloneCat->name = $cat;
                    $cloneCat->save();
                    $codsCats[] = md5($cat);
                }else{
                    $codsCats[] =  md5($cat);
                }             
            }
            return $codsCats;
        }

        protected function clearLine($line){
            $clears = ['\r','\n'];
            return json_decode( str_replace($clears, "", json_encode($line)) );
        }

        private function relation($line){
            $arrRel = [];
            $line = explode( ";", $line );
            foreach ($this->indexs as $key => $value) {
                if($value == "category") $arrRel[$value] = explode("|", $line[$key]);
                else $arrRel[$value] = $line[$key];
            }
            return $arrRel;
        }

        private function arguments($argv) {
            $_ARG = array();
            foreach ($argv as $arg) {
                if(preg_match('/--([^=]+)=(.*)/',$arg,$reg)) {
                    $_ARG[$reg[1]] = $reg[2];
                } else if(preg_match('/-([a-zA-Z0-9])/',$arg,$reg)) {
                    $_ARG[$reg[1]] = 'true';
                }   
            }
            return $_ARG;
        }

    }

    new ImportFiles;
    exit();


    

    