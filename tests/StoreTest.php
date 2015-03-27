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
            $new_id = 2;
            $new_name = "Macys";
            $new_store = New Store ($new_name, $new_id);

            $result = $new_store->getId();

            $this->assertEquals(2, $result);

        }


    }




 ?>
