<?php
    require_once __DIR__.'/../src/Brand.php';

    class BrandTest extends PHPUnit_Framework_TestCase
    {
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
    }


?>
