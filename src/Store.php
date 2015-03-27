<?php

    class Store {

        private $brand_name;
        private $id;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name  = $brand_name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

    }


 ?>
