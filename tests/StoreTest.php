<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    require_once __DIR__.'/../src/Store.php';

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Nike Factory";
            $address = "2650 NE Martin Luther King Jr Blvd";
            $phone = "503-281-5901";
            $nike_factory = new Store($name, $address, $phone);
            $nike_factory->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$nike_factory], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Nike Factory";
            $address = "2650 NE Martin Luther King Jr Blvd";
            $phone = "503-281-5901";
            $nike_factory = new Store($name, $address, $phone);
            $nike_factory->save();

            $name2 = "Payless Shoes";
            $address2 = "606 SW Alder St";
            $phone2 = "503-222-4394";
            $payless = new Store($name2, $address2, $phone2);
            $payless->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$nike_factory, $payless], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Nike Factory";
            $address = "2650 NE Martin Luther King Jr Blvd";
            $phone = "503-281-5901";
            $nike_factory = new Store($name, $address, $phone);
            $nike_factory->save();

            $name2 = "Payless Shoes";
            $address2 = "606 SW Alder St";
            $phone2 = "503-222-4394";
            $payless = new Store($name2, $address2, $phone2);
            $payless->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }

?>
