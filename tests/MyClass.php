<?php
declare(strict_types=1);

/**
 * Class MyClass
 */
class MyClass
{
    /**
     * @var int|null
     */
    public $my_var;

    /**
     * MyClass constructor.
     * @param int|null $my_var
     */
    public function __construct(?int $my_var = null)
    {
        $this->my_var = $my_var;
    }
}