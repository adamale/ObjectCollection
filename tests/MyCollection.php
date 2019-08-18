<?php
declare(strict_types=1);

use ObjectCollection\Collection;

class MyCollection extends Collection
{
    public function __construct()
    {
        $this->allowed_item = MyClass::class;
    }
}