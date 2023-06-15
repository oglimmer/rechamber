<?php

namespace app\utils;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * @throws ReflectionException
 */
function getObjectProperties($object): array {
    $reflectionClass = new ReflectionClass($object);
    $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PRIVATE);
    $data = [];
  
    foreach ($properties as $property) {
        $propertyName = $property->getName();
      $propertyValue = $property->getValue($object);
      $data[$propertyName] = $propertyValue;
    }
  
    return $data;
  }
  