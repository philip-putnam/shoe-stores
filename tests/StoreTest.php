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

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
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

        function test_find()
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
            $result = Store::find($payless->getId());

            //Assert
            $this->assertEquals($payless, $result);
        }

        function test_delete()
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
            $nike_factory->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$payless], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Nike Factory";
            $address = "2650 NE Martin Luther King Jr Blvd";
            $phone = "503-281-5901";
            $nike_factory = new Store($name, $address, $phone);
            $nike_factory->save();

            $new_name = 'Nike City';
            $new_address = '8889 Port Number Whoa';
            $new_phone = '1-800-838-8439';
            $id = $nike_factory->getId();
            $new_nike_store = new Store($new_name, $new_address, $new_phone, $id);

            //Act
            $nike_factory->update($new_name, $new_address, $new_phone);
            $result = Store::find($nike_factory->getId());

            //Assert
            $this->assertEquals($new_nike_store, $result);
        }

        function test_addBrand()
        {
            //Arrange
            $name = "Payless Shoes";
            $address = "606 SW Alder St";
            $phone = "503-222-4394";
            $payless = new Store($name, $address, $phone);
            $payless->save();

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
            $payless->addBrand($nike);
            $payless->addBrand($adidas);
            $result = $payless->getBrands();

            //Assert
            $this->assertEquals([$nike, $adidas], $result);
        }

        function test_getBrands()
        {
            //Arrange
            $name = "Payless Shoes";
            $address = "606 SW Alder St";
            $phone = "503-222-4394";
            $payless = new Store($name, $address, $phone);
            $payless->save();

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
            $payless->addBrand($nike);
            $payless->addBrand($adidas);
            $payless->addBrand($puma);
            $result = $payless->getBrands();

            //Assert
            $this->assertEquals([$nike, $adidas, $puma], $result);
        }

    }

?>
