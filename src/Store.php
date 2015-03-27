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
        }



    }


 ?>
