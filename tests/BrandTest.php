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


    }


?>
