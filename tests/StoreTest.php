<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
        }$

        function test_getId()
        {
            $id = 2;
            $name = "Macys";
            $new_store = New Store ($name, $id);

            $result = $new_store->getId();

            $this->assertEquals(2, $result);

        }

        function test_setId()
        {
            $id = 2;
            $name = "Macys";
            $new_store = new Store($name,$id);
            $new_id = 3;
            $new_store->setId($new_id);

            $result = $new_store->getId();

            $this->assertEquals(3, $result);
        }

        function test_getName()
        {
            $name = "K-Mart";
            $new_store = new Store($name);

            $result = $new_store->getName();

            $this->assertEquals("K-Mart", $result);

        }

        function test_setName()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_name = "Macys";

            $new_store->setName($new_name);
            $result = $new_store->getName();

            $this->assertEquals("Macys", $result);

        }

        function test_save()
        {
            $name = "K-Mart";
            $new_store = new Store($name);

            $new_store->save();
            $result = Store::getAll();

            $this->assertEquals($new_store, $result[0]);

        }

        function test_getAll()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_store->save();

            $name1 = "Target";
            $new_store1 = new Store($name1);
            $new_store1->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store, $new_store1], $result);
        }

        function test_deleteAll()
        {
            $name = "K-Mart";
            $new_store = new Store($name);

            $name1 = "Maycs";
            $new_store1 = new Store($name1);

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([], $result);
        }

        function test_update()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_name = "Target";

            $new_store->update($new_name);
            $result = $new_store->getName();

            $this->assertEquals("Target", $result);

        }

        function test_updateDatabase()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_name = "Macys";
            $new_store->save();

            $new_store->update($new_name);
            $result = Store::getAll();

            $this->assertEquals("Macys", $result[0]->getName());
        }

        function test_singleDelete()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_store->save();

            $name1 = "Macys";
            $new_store1 = new Store($name1);
            $new_store1->save();

            $new_store->delete();

            $result = Store::getAll();

            $this->assertEquals([$new_store1], $result);
        }

        function test_find()
        {
            $name = "K-Mart";
            $new_store = new Store ($name);
            $new_store->save();

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
            $new_store = new Store ($store_name);
            $new_store->save();

            $brand_name = "Puma";
            $new_brand = new Brand($brand_name);
            $new_brand->save();

            $new_store->addBrand($new_brand);
            $result = $new_store->getBrands();

            $this->assertEquals($new_brand, $result);
        }

        function test_getBrands()
        {
            $store_name = "Target";
            $new_store = new Store ($store_name);
            $new_store->save();

            $brand_name = "Puma";
            $new_brand = new Brand($brand_name);
            $new_brand->save();

            $brand_name1 = "Nike";
            $new_brand1 = new Brand($brand_name1);
            $new_brand1->save();

            $new_store->addBrand($new_brand);
            $new_store->addBrand($new_brand1);
            $result = $new_store->getBrands();

            $this->assertEquals([$new_brand, $new_brand1], $result);
        }
    }




 ?>
