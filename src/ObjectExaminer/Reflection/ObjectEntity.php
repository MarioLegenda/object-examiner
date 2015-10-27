<?php

namespace ObjectExaminer\Reflection;

class ObjectEntity implements ObjectEntityInterface
{
    private $class;
    private $entityName;
    private $object;

    private $metadata = array();

    /**
     * @param \ReflectionClass $class
     * @param $object
     */
    public function __construct(\ReflectionClass $class, $object)
    {
        $this->class = $class;
        $this->entityName = $class->getName();
        $this->object = $object;
    }

    /**
     * @return $this
     */
    public function run()
    {
        $methods = $this->class->getMethods();
        $properties = $this->class->getProperties();

        $tempMetadata[$this->entityName] = array(
            'methods' => array(),
        );

        foreach ($methods as $method) {
            if ($method->isPublic()) {
                $tempMetadata[$this->entityName]['methods'][] = $method->getName();
            }
        }

        if (empty($properties)) {
            $this->metadata = $tempMetadata;

            return $this;
        }

        foreach ($properties as $property) {
            if ($property->isPrivate()) {
                $property->setAccessible(true);
            }

            $value = $property->getValue($this->object);

            if (!is_object($value)) {
                continue;
            }

            $objectEntity = new ObjectEntity(new \ReflectionClass($value), $value);
            $innerMetadata = $objectEntity->run()->getMetadata();

            $tempMetadata[$this->entityName]['properties'] = $innerMetadata;
        }

        $this->metadata = $tempMetadata;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}