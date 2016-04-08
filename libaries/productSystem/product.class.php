<?php
namespace yourgiftcards;

/**
.---------------------------------------------------------------------------.
|  Software:                                 |
|  Version: 0.4 (Last Updated on 2015 September 1)                          |
|  Contact: http://github.com/subins2000/logsys                             |
|  Documentation: https://subinsb.com/php-logsys                            |
'---------------------------------------------------------------------------'
*/

class product extends Singleton{

  private static function run($sql) {
    $db = Singleton::getInstance();
    return $db->query($sql);
  }


  //get products linked to $cate_id
  public static function getProductFromCate($cate){

    $str_cate = str_replace(' ', '-', $cate);

    try{

      $query = 'SELECT *
                FROM products
                  LEFT JOIN categories
                    ON product_cate_id = cate_id
                  LEFT JOIN vouchers
                    ON voucher_cate_id = cate_id
                WHERE cate_name = ? AND voucher_value = product_value
                HAVING (voucher_cate_id > 0); ';

      $stmt = self::run($query);

      $stmt->bindValue(1, $str_cate, \PDO::PARAM_STR);

      $stmt->execute();

      $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $row;

    }catch (\Exception $e){
      return $e;
    }

  }


  //
  public static function getProduct($cate, $value){

    $str_cate = str_replace(' ', '-', $cate);

    try{

      $query = 'SELECT * FROM products
                  LEFT JOIN categories
                    ON cate_id = product_cate_id
                WHERE cate_name = ?
                  AND product_value = ? LIMIT 1;';

      $stmt = self::run($query);

      $stmt->bindValue(1, $str_cate, \PDO::PARAM_STR);
      $stmt->bindValue(2, $value, \PDO::PARAM_INT);

      $stmt->execute();

      $row = $stmt->fetch(\PDO::FETCH_ORI_FIRST);

      return $row;

    }catch (\Exception $e){
      return $e;
    }

  }


  public static function getProductRelations($cate, $value){

    $str_cate = str_replace(' ', '-', $cate);

    try{

      $query = 'SELECT * FROM products
                  LEFT JOIN categories
                    ON cate_id = product_cate_id
                  LEFT JOIN vouchers
                    ON voucher_cate_id = cate_id
                WHERE cate_name = ?
                  AND product_value <> ?
                  AND voucher_value = product_value
                GROUP BY product_id
                HAVING (voucher_cate_id > 0)
                ORDER BY product_value ASC ;';

      $stmt = self::run($query);

      $stmt->bindValue(1, $str_cate, \PDO::PARAM_STR);
      $stmt->bindValue(2, $value, \PDO::PARAM_INT);

      $stmt->execute();

      $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $row;

    }catch (\Exception $e){
      return $e;
    }

  }

  public static function getProductCategories(){

    try{

      $query = 'SELECT * FROM categories';

      $stmt = self::run($query);

      $stmt->execute();

      $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $row;

    }catch (\Exception $e){
      return $e;
    }

  }


}

