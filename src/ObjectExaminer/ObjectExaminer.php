<?php

namespace ObjectExaminer;

use ObjectExaminer\Exception\ObjectExaminerException;
use ObjectExaminer\Reflection\ObjectReflection;

class ObjectExaminer
{
    private static $instance;

    /**
     * @return ObjectExaminer
     */
    public static function init()
    {
        self::$instance = (self::$instance) ? self::$instance : new self();

        return self::$instance;
    }

    /**
     * @param $object
     */
    public function examine($object)
    {
        if (!is_object($object)) {
            throw new ObjectExaminerException('ObjectExaminerException: ObjectExaminer::examine() has to receive an object');
        }

        $objectReflection = new ObjectReflection($object);
        $objectReflection->constructArray()->dump();
    }
}