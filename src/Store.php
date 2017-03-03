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

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE id = {$this->getId()};");
        }

        function update($new_name, $new_address, $new_phone)
        {
            if ($new_name === '')
            {
                $new_name = $this->getName();
            }
            if ($new_address === '')
            {
                $new_address = $this->getAddress();
            }
            if ($new_phone === '')
            {
                $new_phone = $this->getPhone();
            }
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}', address = '{$new_address}', phone = '{$new_phone}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setAddress($new_address);
            $this->setPhone($new_phone);
        }

        function addBrand($new_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$new_brand->getId()});");
        }

        function removeBrand($brand_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$brand_id};");
        }

        function getBrands()
        {
            $found_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores_brands.store_id = stores.id) JOIN brands ON (stores_brands.brand_id = brands.id) WHERE stores.id = {$this->getId()};");
            $brands = [];

            foreach($found_brands as $brand)
            {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
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

        static function find($store_id)
        {
            $stores = Store::getAll();
            $found_store = null;

            foreach($stores as $store)
            {
                $id = $store->getId();
                if ($id == $store_id)
                {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

    }



?>
