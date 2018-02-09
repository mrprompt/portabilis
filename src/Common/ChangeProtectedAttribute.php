<?php
declare(strict_types = 1);

namespace App\Common;

use ReflectionProperty;
use ReflectionClass;

/**
 * Reusable component to allow changing private/protected attributes
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @author Thiago Paes <mrprompt@gmail.com>
 */
trait ChangeProtectedAttribute
{
    /**
     * Configures the attribute with the given value
     *
     * @param object $object
     * @param string $name
     * @param mixed $value
     */
    public function modifyAttribute($object, $name, $value)
    {
        $attribute = new ReflectionProperty($object, $name);

        $attribute->setAccessible(true);
        $attribute->setValue($object, $value);
    }

    /**
     * Get private atribute
     * 
     * @param object $object
     * @param string $attribute
     */
    public function getPrivateAttribute($object, $name)
    {
        $reflectionClass = new ReflectionClass($object);

        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);
        
        return $reflectionProperty->getValue($object);
    }
}
