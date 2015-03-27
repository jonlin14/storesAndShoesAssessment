<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    class StoreTest extends PHPUnit_Framework_TestCase
    {
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

        function test_getBrandName()
        {
            $name = "K-Mart";
            $new_store = new Store($name);

            $result = $new_store->getBrandName();

            $this->assertEquals("K-Mart", $result);

        }

        function test_setBrandName()
        {
            $name = "K-Mart";
            $new_store = new Store($name);
            $new_name = "Macys";

            $new_store->setBrandName($new_name);
            $result = $new_store->getBrandName();

            $this->assertEquals("Macys", $result);

        }


    }




 ?>
