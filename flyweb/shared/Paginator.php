<?php

namespace shared;

class Paginator {
    
    public static $pageSize = 10;


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
        $pageStart = ($page - 1) * self::$pageSize;

        return [
            'elements' => array_slice($list, $pageStart, self::$pageSize),
            'currentPage' => $page,
            'totalPages' => self::getNumOfPages($list)
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
