<?php

class Businessflow extends MEDOOHelper
{

    public static function FetchTrsansactionData($page, $limit): array
    {
        $startpoint = ($page * $limit) - $limit;
        $data = parent::query(
            "SELECT transaction.*, COALESCE(game_type.name, 'N/A') AS lottery_name FROM transaction  
            JOIN game_type ON game_type.gt_id = transaction.game_type  ORDER BY trans_id DESC LIMIT :offset, :limit",
            ['offset' => $startpoint, 'limit' => $limit]
        );
        return $data;
    }

    public static function getUserName($uid): String
    {
        return parent::selectOne("users", ["username"], ["uid" => $uid])['username'];
    }

    public static function getLottery($gameId): String
    {
        return parent::selectOne("game_type", ["name"], ["gt_id" => $gameId])['name'];
    }

    public static function getbetID($oder_ID, $beTable)
    {
        $betTable = self::getGameIdsByGameType()[$beTable]['bet_table'];
        return  $result = parent::selectOne($betTable, ["bid"], ["bet_code" => $oder_ID])['bid'] ?? 1;
    }


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
