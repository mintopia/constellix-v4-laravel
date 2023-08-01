<?php

namespace Tiggee\ConstellixApiLaravel;

use Constellix\Client\Interfaces\PaginatorFactoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class IlluminatePaginatorFactory implements PaginatorFactoryInterface
{
    /**
     * @param array<mixed> $items The items to be paginated
     * @param int $totalItems Total number of items
     * @param int $perPage Number of items per page
     * @param int $currentPage The current page
     * @return LengthAwarePaginator
     */
    public function paginate(array $items, int $totalItems, int $perPage, int $currentPage = 1)
    {
        return new LengthAwarePaginator(
            items: $items,
            total: $totalItems,
            perPage: $perPage,
            currentPage: $currentPage
        );
    }
}
