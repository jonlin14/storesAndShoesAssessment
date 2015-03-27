<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";
    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function TearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getId()
        {
            $new_name = "Nike";
            $new_id = 2;
            $test_brand = new Brand($new_name, $new_id);

            $result = $test_brand->getId();

            $this->assertEquals(2, $result);
        }

        function test_setId()
        {
            $new_name = "Adidas";
            $new_id = 2;
            $test_brand = new Brand($new_name);
            $test_brand->setId($new_id);

            $result = $test_brand->getId();

            $this->assertEquals(2, $result);
        }

        function test_getBrandName()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);

            $result = $test_brand->getBrandName();

            $this->assertEquals("Puma", $result);
        }

        function test_setBrandName()
        {
            $new_name = "Nike";
            $test_brand = new Brand($new_name);
            $change_name = "Saucony";

            $test_brand->setBrandName($change_name);
            $result = $test_brand->getBrandName();

            $this->assertEquals("Saucony", $result);
        }

        function test_save()
        {
            $new_name = "Nike";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $result = Brand::getAll();

            $this->assertEquals([$test_brand], $result);

        }

        function test_getAll()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $new_name1 = "Nike";
            $new_brand1 = new Brand($new_name1);
            $new_brand1->save();

            $result = Brand::getAll();

            $this->assertEquals([$test_brand, $new_brand1], $result);
        }

        function test_deleteAll()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $new_name1 = "Nike";
            $new_brand1 = new Brand($new_name1);
            $new_brand1->save();

            Brand::deleteAll();

            $this->assertEquals([], Brand::getAll());
        }

        function test_find()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $new_name1 = "Nike";
            $new_brand1 = new Brand($new_name1);
            $new_brand1->save();

            $search_id = $new_brand1->getId();
            $result = Brand::find($search_id);

            $this->assertEquals($new_brand1, $result);
        }

        function test_addStore()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $new_store_name = "Target";
            $test_store = new Store($new_store_name);
            $test_store->save();

            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();

            $this->assertEquals([$test_store], $result);
        }

        function test_getStores()
        {
            $new_name = "Puma";
            $test_brand = new Brand($new_name);
            $test_brand->save();

            $new_store_name = "Target";
            $test_store = new Store($new_store_name);
            $test_store->save();

            $new_store_name1 = "Macys";
            $test_store1 = new Store($new_store_name1);
            $test_store1->save();

            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store1);
            $result = $test_brand->getStores();

            $this->assertEquals([$test_store, $test_store1], $result);
        }

    }


 ?>
