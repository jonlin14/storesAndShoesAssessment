<?php

    class Brand
    {
        private $brand_name;
        private $id;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
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

        function getBrandName()
        {
            return $this->brand_name;
        }

        function setBrandName($new_brand_name)
        {
            $this->brand_name = $new_brand_name;
        }

        function save()
        {
            $query = $GLOBALS['DB']->query("INSERT INTO brands (name) VALUES ('{$this->getBrandName()}') RETURNING id;");
            $query_fetched = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($query_fetched['id']);
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $query_fetched = $query->fetchAll(PDO::FETCH_ASSOC);
            $return_brands = array();

            foreach($query_fetched as $element)
            {
                $new_brand_name = $element['name'];
                $new_id = $element['id'];
                $new_brand = new Brand($new_brand_name, $new_id);
                array_push($return_brands, $new_brand);
            }
            return $return_brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands *;");
        }

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
            $query_fetched = $query->fetchAll(PDO::FETCH_ASSOC);
            $found_brand = null;

            foreach ($query_fetched as $element)
            {
                $new_brand_name = $element['name'];
                $new_id = $element['id'];
                $found_brand = new Brand($new_brand_name, $new_id);
            }
            return $found_brand;
        }


    }

 ?>
