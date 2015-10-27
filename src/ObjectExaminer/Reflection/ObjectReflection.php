<?php

namespace ObjectExaminer\Reflection;

class ObjectReflection
{
    private $reflectedArray = array();
    private $object;

    /**
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @return $this
     */
    public function constructArray()
    {
        $objectEntity = new ObjectEntity(new \ReflectionClass($this->object), $this->object);

        $this->reflectedArray = $objectEntity->run()->getMetadata();

        return $this;
    }

    public function dump()
    {
        echo "<pre>";
        var_dump($this->reflectedArray);
        die();
    }
}