<?php

    class Store {

        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stores (name) VALUES ('{$this->getName()}') RETURNING id;");
            $query = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($query['id']);
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getID()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE id = {$this->getId()};");
        }


        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = $query->fetchAll(PDO::FETCH_ASSOC);
            $return_stores = array();

            foreach($stores as $element)
            {
                $new_name = $element['name'];
                $new_id = $element['id'];
                $new_store = new Store($new_name, $new_id);
                array_push ($return_stores, $new_store);
            }
            return $return_stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores *;");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands *;");
        }

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores where id = {$search_id};");
            $query_fetched = $query->fetch(PDO::FETCH_ASSOC);
            $found_store = null;

            foreach ($query_fetched as $element)
            {
                $new_name = $query_fetched['name'];
                $new_id = $query_fetched['id'];
                $found_store = new Store($new_name, $new_id);
            }
            return $found_store;
        }

        function addBrand($add_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (stores_id, brands_id) VALUES ({$this->getId()}, {$add_brand->getId()});");
        }

        function getBrands()
        {
            $query = $GLOBALS['DB']->query("SELECT brands.* FROM brands JOIN stores_brands ON (brands.id = stores_brands.brands_id) JOIN stores ON (stores_brands.stores_id = stores.id) WHERE stores.id = {$this->getId()};");
            $query_fetched = $query->fetchAll(PDO::FETCH_ASSOC);
            $return_brands = array ();

            foreach ($query_fetched as $element)
            {
                $brand_name = $element['name'];
                $brand_id = $element['id'];
                $brand = new Brand($brand_name, $brand_id);
                array_push($return_brands, $brand);
            }
            return $return_brands;
        }


    }


 ?>
