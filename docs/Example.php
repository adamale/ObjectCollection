<?php
declare(strict_types=1);

use ObjectCollection\Collection;

require_once "vendor/autoload.php";

class CollectionItem
{
}

class CustomCollection extends Collection
{
    public function __construct()
    {
        // this decides what classes can be inserted
        $this->allowed_item = CollectionItem::class;
    }
}

// add items as you would with regular array
$collection = new CustomCollection();
$collection[] = null;
$collection[] = "foo";
$collection[] = 7;
$collection[] = new CollectionItem(); // valid
$collection[] = true;
$collection[] = 100.01;
$collection[] = new CollectionItem(); // valid
$collection[] = new StdClass();

// get the item count with standard count() function
var_dump(count($collection) === 2); // true

// iterate over the collection
$iterations = 0;
foreach ($collection as $item) {
    $iterations++;
}
var_dump($iterations === 2); // true