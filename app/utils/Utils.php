<?php

class Utils extends MEDOOHelper
{
    public static function getGameIdsByGameType(): array
    {
        $res = parent::selectAll("gamestable_map", ["game_type", "draw_table", "bet_table", "draw_storage"]);
        $mainData = [];
        foreach ($res as $data) {
            $mainData[$data['game_type']] = $data;
        }
        return $mainData;
    }


    public static function paginateAllUsers(mixed $currentPage, mixed $itemPerPage)
    {

        $totalRecords  = parent::count('users');
        $pages = ceil($totalRecords / $itemPerPage) ?? 1;

        $pagination = [
            'prev' => ($currentPage > 1) ? $currentPage - 1 : 1,
            'next' => ($currentPage < $pages) ? $currentPage + 1 : $pages,
            'pages' => []
        ];

        for ($i = 1; $i <= $pages; $i++) {
            $pagination['pages'][] = $i;
        }

        return $pagination;
    }
}
