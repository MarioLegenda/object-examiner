<?php

namespace ObjectExaminer\Reflection;


interface ObjectEntityInterface
{
    /**
     * @return mixed
     */
    public function run();

    /**
     * @return mixed
     */
    public function getMetadata();
}