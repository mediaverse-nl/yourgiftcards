<?php
namespace yourgiftcards;
/**
*/

class SC extends Singleton {

  /**
   * ------------
   * BEGIN CONFIG
   * ------------
   * Edit the configuraion
   */

  private $shipping = 149;
  private $tax = 21;


  public function __construct(){
    echo 'The class "', __CLASS__, '" was initiated!<br />';
  }

  public function getProperty()
  {
    return $this->shipping . "<br />";
  }

  public static function run() {
    $db = \yourgiftcards\Singleton::getInstance();
    return $db;
  }

  public static function getProductsFromSession($product_id){

    try{

    
      return $row;

    }catch (\Exception $e){
      return $e;
    }

  }

  public static function insertOrder(){

    try{

      $query = "INSERT INTO  `orders` (
                  `id` ,
                  `paid` 
                  )
                VALUES (
                  NULL, ?
                );";

      $stmt = self::run()->query($query);

      $stmt->execute();

      return self::run()->getLastInsertId();

    }catch (\Exception $e){
      return $e;
    }

  }

  public static function insertOrderedProducts(){

    try{

      $query = "INSERT INTO `ordered_products` (
                  `ordered_id` ,
                  `ordered_order_id` ,
                  `ordered_product_price`
                  )
                VALUES (
                   NULL ,  ?,  ?
                );";

      $stmt = self::run()->query($query);

      $stmt->execute();

      return self::run()->getLastInsertId();

    }catch (\Exception $e){
      return $e;
    }

  }

}

