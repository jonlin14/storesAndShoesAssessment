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

        function test_getBrandName()
        {
            $new_name = "Puma";
            $new_brand = new Brand($new_name);

            $result = $new_brand->getBrandName();

            $this->assertEquals("Puma", $result);
        }

        function test_setBrandName()
        {
            $new_name = "Nike";
            $new_brand = new Brand($new_name);
            $change_name = "Saucony";

            $new_brand->setBrandName($change_name);
            $result = $new_brand->getBrandName();

            $this->assertEquals("Saucony", $result);
        }

        function test_save()
        {
            $new_name = "Nike";
            $new_brand = new Brand($new_name);
            $new_brand->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand], $result);

        }

        function test_getAll()
        {
            $new_name = "Puma";
            $new_brand = new Brand($new_name);
            $new_brand->save();

            $new_name1 = "Nike";
            $new_brand1 = new Brand($new_name1);
            $new_brand1->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand, $new_brand1], $result);
        }

    }


 ?>
