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
    require_once __DIR__.'/../src/Brand.php';

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = 'Puma';
            $id = 42;
            $puma = new Brand($name, $id);

            //Act
            $result = $puma->getId();

            //Assert
            $this->assertEquals(42, $result);
        }

        function test_getName()
        {
            //Arrange
            $name = 'Puma';
            $puma = new Brand($name);

            //Act
            $result = $puma->getName();

            //Assert
            $this->assertEquals('Puma', $result);
        }

        function test_setName()
        {
            //Arrange
            $name = 'Puma';
            $new_name = 'Nike';
            $puma = new Brand($name);

            //Act
            $puma->setName($new_name);
            $result = $puma->getName();

            //Assert
            $this->assertEquals('Nike', $result);
        }

        function test_save()
        {
            //Arrange
            $name = 'Puma';
            $puma = new Brand($name);
            $puma->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$puma], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = 'Puma';
            $puma = new Brand($name);
            $puma->save();

            $name2 = 'Nike';
            $nike = new Brand($name2);
            $nike->save();

            $name3 = 'Adidas';
            $adidas = new Brand($name3);
            $adidas->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$puma, $nike, $adidas], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = 'Puma';
            $puma = new Brand($name);
            $puma->save();

            $name2 = 'Nike';
            $nike = new Brand($name2);
            $nike->save();

            $name3 = 'Adidas';
            $adidas = new Brand($name3);
            $adidas->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_addStore()
        {
            //Arrange
            $name = 'Nike';
            $nike = new Brand($name);
            $nike->save();

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
            $nike->addStore($nike_factory);
            $nike->addStore($payless);
            $result = $nike->getStores();

            //Assert
            $this->assertEquals([$nike_factory, $payless], $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = 'Nike';
            $nike = new Brand($name);
            $nike->save();

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

            $name3 = "Footwise";
            $address3 = "1433 NE Broadway St";
            $phone3 = "503-493-0070";
            $footwise = new Store($name3, $address3, $phone3);
            $footwise->save();

            //Act
            $nike->addStore($nike_factory);
            $nike->addStore($payless);
            $nike->addStore($footwise);
            $result = $nike->getStores();

            //Assert
            $this->assertEquals([$nike_factory, $payless, $footwise], $result);
        }

    }


?>
