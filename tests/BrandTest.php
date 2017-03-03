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

            //Act

            //Assert
        }

        function test_setName()
        {
            //Arrange

            //Act

            //Assert
        }
    }


?>
