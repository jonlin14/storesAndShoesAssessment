<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function test_getId()
        {
            $new_name = "Nike";
            $new_id = 2;
            $new_brand = new Brand($new_name, $new_id);

            $result = $new_brand->getId();

            $this->assertEquals(2, $result);
        }

        function test_setId()
        {
            $new_name = "Adidas";
            $new_id = 2;
            $new_brand = new Brand($new_name);
            $new_brand->setId($new_id);

            $result = $new_brand->getId();

            $this->assertEquals(2, $result);
        }

    }


 ?>
