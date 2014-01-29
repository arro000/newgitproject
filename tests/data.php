<?php
error_reporting(E_ALL);

class Obj {

    private $rm = array();

    PUBLIC FUNCTION __construct($name,$price,$quant,$tot) {
        $this->rm["name"]=$name;
        $this->rm["price"]=$price;
        $this->rm["quant"]=$quant;
        $this->rm["tot"]=$tot;
       
    }
    public function Parsing($data) {
        foreach ($data as $index => $elemento) {
            $this->rm[$index] = $elemento . " Parsed";
        }
    }
    public function setId($id){
        $this->rm["id"]=$id;
    }
     
    public function ajaxRet() {
        
        echo json_encode($this->rm);
        
    }

}

interface Produi{
    public function setQt($quant);
}

class Prod extends Obj implements Produi{
    
    public $quant;
    public $name;
    public $price;
    public static $id=0;
    
    public function __construct($name, $price)
    {
        
        Prod::$id=++Prod::$id;
        $this->name=$name;
        $this->price=$price;
    }
    
    public function setQt($quant){
        $this->quant=$quant;
        
    }
    public function getId(){
        return Prod::$id;        
    }
    public function  calcolaTot(){
      
       return $this->quant*$this->price;
    }
}
$data = $_POST;
if (!sizeof($data))
    $data = $_GET;

$prodotto= new prod($data["name"],$data["price"]);
$prodotto->setQt($data["quant"]);
$tot=$prodotto->calcolaTot();
$ogge=new obj($prodotto->name,$prodotto->price,$prodotto->quant,$tot);
//$prodotto->prod.  parent::__construct($prodotto->name,$prodotto->price,$prodotto->quant,$tot);
$prodotto->setId($prodotto->id);


$ogge->ajaxRet();
/*
       $rm["name"]=$prodotto->name;
        $rm["price"]=$prodotto->price;
        $rm["quant"]=$prodotto->quant;
        $rm["tot"]=$tot;
/*
  foreach ($data as $index => $elemento) {
  $rm[$index] = $elemento . " Parsed";
  }
 $rm["id"]=$prodotto->getID();
  
 echo json_encode(
  $rm
  );*/

?>