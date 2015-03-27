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


    }




 ?>
