<?php 

class Model extends MEDOOHelper{

    public static function authenticate($email, $password){
        $res = parent::selectOne("admin_tbl",'*',['email'=> $email]);
        if(!empty($res) && password_verify($password, $res['password'])){
            return [
                'type' => 'success',
                'message'=> 'sign in successful',
                'email' => $email,
                'role' => $res['role'],
                'Oauth' => $res['status'] == 'on' ? '../limvo/admin/Oauth' : 'Off',
                'url' => '/admin/limvo/admin/home'
            ];
        }else{
            return [
                'type' => 'error',
                'message'=> 'Wrong email or password'
            ];
        }
    }

    public static function getAllUsers($page, $limit) {
        $startpoint = ($page * $limit) - $limit;
        $data = parent::query(
            "SELECT uid, username, nickname FROM users LIMIT :offset, :limit",
            ['offset' => $startpoint, 'limit' => $limit]
        );
        return $data;
    }

    public static function paginateAllUsers(mixed $currentPage, mixed $itemPerPage) {

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