<?php

namespace Utils;

use ReflectionClass;
use ReflectionProperty;

function getObjectProperties($object) {
    $reflectionClass = new ReflectionClass($object);
    $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PRIVATE);
    $data = [];
  
    foreach ($properties as $property) {
      $property->setAccessible(true);
      $propertyName = $property->getName();
      $propertyValue = $property->getValue($object);
      $data[$propertyName] = $propertyValue;
    }
  
    return $data;
  }
  