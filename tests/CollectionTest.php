<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Class CollectionTest
 * @covers ObjectCollection\Collection
 */
final class CollectionTest extends TestCase
{
    public function setUp(): void
    {
        require_once __DIR__ . "/InvalidCollection.php";
        require_once __DIR__ . "/MyClass.php";
        require_once __DIR__ . "/MyCollection.php";
    }

    /**
     * @test
     */
    public function canBeCreated()
    {
        $this->assertInstanceOf(
            MyCollection::class,
            new MyCollection()
        );
    }

    /**
     * @test
     */
    public function canContainMultipleItems()
    {
        $collection = new MyCollection();
        $collection[] = new MyClass();
        $collection[] = new MyClass();
        $collection[] = new MyClass();

        $this->assertEquals(
            3,
            $collection->count()
        );
    }

    /**
     * @test
     */
    public function canBeIteratedOver()
    {
        $iterations = 0;

        $collection = new MyCollection();
        $collection[] = new MyClass();
        $collection[] = new MyClass();
        $collection[] = new MyClass();

        /** @noinspection PhpUnusedLocalVariableInspection */
        foreach ($collection as $item) {
            ++$iterations;
        }

        $this->assertEquals(
            3,
            $iterations
        );
    }

    /**
     * @test
     */
    public function canReturnElementByKey()
    {
        $collection = new MyCollection();
        $collection[] = new MyClass(9);
        $collection[] = new MyClass(10);
        $collection[] = new MyClass(11);

        $this->assertEquals(
            10,
            $collection[1]->my_var
        );
    }

    /**
     * @test
     */
    public function cannotInsertNotSupportedElement()
    {
        $collection = new MyCollection();
        $collection[] = null;
        $collection[] = "foo";
        $collection[] = 7;
        $collection[] = new MyClass();
        $collection[] = true;
        $collection[] = 100.01;
        $collection[] = new MyClass();
        $collection[] = new StdClass();

        $this->assertEquals(
            2,
            count($collection)
        );
    }

    /**
     * @test
     */
    public function cannotCreateObjectFromInvalidClass()
    {
        $thrownException = null;

        try {
            $collection = new InvalidCollection();
            $collection[] = new MyClass();
        } catch (Exception $e) {
            $thrownException = $e;
        }

        $this->assertInstanceOf(
            UnexpectedValueException::class,
            $thrownException
        );
    }
}
