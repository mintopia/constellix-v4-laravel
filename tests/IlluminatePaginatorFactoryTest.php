<?php

namespace Tiggee\ConstellixApiLaravel\Tests;

use Tiggee\ConstellixApiLaravel\IlluminatePaginatorFactory;
use PHPUnit\Framework\TestCase;

class IlluminatePaginatorFactoryTest extends TestCase
{
    protected IlluminatePaginatorFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new IlluminatePaginatorFactory();
    }
    public function testReturnsCorrectClass(): void
    {
        $page = $this->factory->paginate([], 0, 10);
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $page);
    }

    public function testItemsAreCorrect(): void
    {
        $items = [
            'Apple',
            'Orange',
            'Banana',
            'Pear',
        ];
        $page = $this->factory->paginate($items, 4, 10);
        $this->assertEquals($items, $page->items());
        $this->assertEquals(4, $page->count());
    }

    public function testTotalItems(): void
    {
        $page = $this->factory->paginate([], 1234, 10);
        $this->assertEquals(1234, $page->total());
    }

    public function testPerPage(): void
    {
        $page = $this->factory->paginate([], 10, 15);
        $this->assertEquals(15, $page->perPage());
    }

    public function testCurrentPage(): void
    {
        $page = $this->factory->paginate([], 200, 10, 4);
        $this->assertEquals(4, $page->currentPage());
        $this->assertTrue($page->hasMorePages());
        $this->assertFalse($page->onFirstPage());
        $this->assertFalse($page->onLastPage());
    }
}
