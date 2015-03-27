<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getId()
        {
            $id = 2;
            $name = "Macys";
            $test_store = New Store ($name, $id);

            $result = $test_store->getId();

            $this->assertEquals(2, $result);

        }

        function test_setId()
        {
            $id = 2;
            $name = "Macys";
            $test_store = new Store($name,$id);
            $new_id = 3;
            $test_store->setId($new_id);

            $result = $test_store->getId();

            $this->assertEquals(3, $result);
        }

        function test_getName()
        {
            $name = "K-Mart";
            $test_store = new Store($name);

            $result = $test_store->getName();

            $this->assertEquals("K-Mart", $result);

        }

        function test_setName()
        {
            $name = "K-Mart";
            $test_store = new Store($name);
            $new_name = "Macys";

            $test_store->setName($new_name);
            $result = $test_store->getName();

            $this->assertEquals("Macys", $result);

        }

        function test_save()
        {
            $name = "K-Mart";
            $test_store = new Store($name);

            $test_store->save();
            $result = Store::getAll();

            $this->assertEquals($test_store, $result[0]);

        }

        function test_getAll()
        {
            $name = "K-Mart";
            $test_store = new Store($name);
            $test_store->save();

            $name1 = "Target";
            $new_store1 = new Store($name1);
            $new_store1->save();

            $result = Store::getAll();

            $this->assertEquals([$test_store, $new_store1], $result);
        }

        function test_deleteAll()
        {
            $name = "K-Mart";
            $test_store = new Store($name);

            $name1 = "Maycs";
            $new_store1 = new Store($name1);

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([], $result);
        }

        function test_update()
        {
            $name = "K-Mart";
            $test_store = new Store($name);
            $new_name = "Target";

            $test_store->update($new_name);
            $result = $test_store->getName();

            $this->assertEquals("Target", $result);

        }

        function test_updateDatabase()
        {
            $name = "K-Mart";
            $test_store = new Store($name);
            $new_name = "Macys";
            $test_store->save();

            $test_store->update($new_name);
            $result = Store::getAll();

            $this->assertEquals("Macys", $result[0]->getName());
        }

        function test_singleDelete()
        {
            $name = "K-Mart";
            $test_store = new Store($name);
            $test_store->save();

            $name1 = "Macys";
            $new_store1 = new Store($name1);
            $new_store1->save();

            $test_store->delete();

            $result = Store::getAll();

            $this->assertEquals([$new_store1], $result);
        }

        function test_find()
        {
            $name = "K-Mart";
            $test_store = new Store ($name);
            $test_store->save();

            $name1 = "Macys";
            $new_store1 = new Store ($name1);
            $new_store1->save();

            $search_id = $new_store1->getId();
            $result = Store::find($search_id);

            $this->assertEquals($new_store1, $result);

        }

        function test_addBrand()
        {
            $store_name = "K-Mart";
            $test_store = new Store ($store_name);
            $test_store->save();

            $brand_name = "Puma";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $test_store->addBrand($test_brand);
            $result = $test_store->getBrands();

            $this->assertEquals([$test_brand], $result);
        }

        function test_getBrands()
        {
            $store_name = "Target";
            $test_store = new Store ($store_name);
            $test_store->save();

            $brand_name = "Puma";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name1 = "Nike";
            $test_brand1 = new Brand($brand_name1);
            $test_brand1->save();

            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand1);
            $result = $test_store->getBrands();

            $this->assertEquals([$test_brand, $test_brand1], $result);
        }

        function test_singleDeleteBrandJoinTable()
        {
            $store_name = "Target";
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = "Puma";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $test_store->addBrand($test_brand);
            $test_brand->delete();

            $result = $test_store->getBrands();

            $this->assertEquals([], $result);
        }


    }




 ?>
