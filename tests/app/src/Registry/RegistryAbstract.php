<?php

class TestRegistryAbstract extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->abstract = $this->getMockForAbstractClass('App\Registry\RegistryAbstract');
    }

    public function providerTestMethodThrowsExceptionOnInvalidKey()
    {
        $useCases = array();

        #0 - key is number
        $useCases[] = array(1);

        #1 - key is boolean
        $useCases[] = array(TRUE);

        #2 - key is boolean
        $useCases[] = array(FALSE);

        #3 - key is array
        $useCases[] = array(array());

        #4 - key is object
        $useCases[] = array(new stdClass);

        #5 - key is null
        $useCases[] = array(NULL);

        #6 - key is empty string
        $useCases[] = array('');

        return $useCases;
    }

    /**
     * @dataProvider providerTestMethodThrowsExceptionOnInvalidKey
     * @expectedException InvalidArgumentException
     */
    public function testMethodSetThrowsExceptionOnInvalidKey($key)
    {
        $this->abstract->set($key, 'ExampleValue');
    }

    /**
     * @dataProvider providerTestMethodThrowsExceptionOnInvalidKey
     * @expectedException InvalidArgumentException
     */
    public function testMethodGetThrowsExceptionOnInvalidKey($key)
    {
        $this->abstract->get($key);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMethodSetThrowsExceptionOnInvalidValue()
    {
        $this->abstract->set('ExampleKey', NULL);
    }


    public function providerTestMethodGetBehavior()
    {
        $useCases = array();

        $useCases[] = array('ExampleKeyA', 'ExampleValueA');
        $useCases[] = array('ExampleKeyB', 'ExampleValueB');
        $useCases[] = array('ExampleKeyC', 'ExampleValueC');

        return $useCases;
    }

    /**
     * @dataProvider providerTestMethodGetBehavior
     */
    public function testMethodGetBehavior($key, $value)
    {
        $this->abstract->set($key, $value);

        $result = $this->abstract->get($key);

        $this->assertEquals($result, $value);
    }

    public function testMethodGetBehaviorWithNonExistingKey()
    {
        $result = $this->abstract->get('KeyDoesNotExist');

        $this->assertEquals($result, NULL, 'Expect method "get" returns NULL if given key is not registered!');
    }

    /**
     * @dataProvider providerTestMethodGetBehavior
     */
    public function testMethodDeleteBehavior($key, $value)
    {
        $this->abstract->set($key, $value);
        $this->abstract->delete($key);

        $result = $this->abstract->get($key);

        $this->assertEquals($result, NULL, 'Expect method "get" returns NULL after registered key was deleted!');
    }
}