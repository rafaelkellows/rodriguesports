<?php
 
class Pessoa {
    private $codigo = 0;
    private $nome = "Eduardo";
 
    public function getCodigo() {
        return $this->codigo;
    }
 
    public function getNome() {
        return $this->nome;
    }
 
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
 
    public function setNome($nome) {
        $this->nome = $nome;
    }
}
 
$objeto = new Pessoa();

print $objeto->getNome();
 
#transform o objeto Pessoa em texto
$texto = serialize($objeto);
 
#mostra o texto
print "<pre>";
print htmlentities($texto);
print "</pre>";
 
#transforma o texto em objeto novamente
$objeto = unserialize($texto);
 
#mostra o conteúdo do objeto
var_dump($objeto);
 
?>