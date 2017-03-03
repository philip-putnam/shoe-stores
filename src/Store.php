<?php
    class Store
    {
        private $name;
        private $address;
        private $phone;
        private $id;

        function __construct($name, $address, $phone, $id = null)
        {
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getAddress()
        {
            return $this->address;
        }

        function setAddress($new_address)
        {
            $this->address = $new_address;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, address, phone) VALUES ('{$this->getName()}', '{$this->getAddress()}', '{$this->getPhone()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $found_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = [];

            foreach($found_stores as $store)
            {
                $name = $store['name'];
                $address = $store['address'];
                $phone = $store['phone'];
                $id = $store['id'];
                $new_store = new Store($name, $address, $phone, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }


    }



?>
