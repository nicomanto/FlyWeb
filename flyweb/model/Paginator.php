<?php

namespace model;

class Paginator {
    
    public static $pageSize = 6;


    /**
     * Sets pageSize globally
     *
     * @param integer $pageSize
     * @return void
     */
    public static function setPageSize(int $pageSize): void {
        self::$pageSize = $pageSize;
    }

    /**
     * Returns the page number $page of $list
     *
     * @param array $list
     * @param integer $page
     * @return array
     */
    public static function paginate(array $list, int $page): array {
        $totalPages = self::getNumOfPages($list);

        // Check if given page index is acceptable, if not, change it to first or last page
        if ($page < 1) {
            $page = 1;
        } else if ($page > $totalPages) {
            $page = $totalPages;
        }
        $pageStart = ($page - 1) * self::$pageSize;

        return [
            'elements' => array_slice($list, $pageStart, self::$pageSize),
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];
    }

    /**
     * Returns in how many pages the array will be divided into
     *
     * @param array $list
     * @return integer
     */
    private static function getNumOfPages(array $list): int {
        return ceil(sizeof($list) / self::$pageSize);
    }
}