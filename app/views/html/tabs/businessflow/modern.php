<?php
ini_set('display_errors', 1);
// require_once('../../autoload.php');
// $lang = $_SESSION['lang'] ?? 'en';
// $translator = include "../lang/{$lang}.php";
?>
<style>
    .loader-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.3);
        /* Light overlay */
        z-index: 1000;
        display: none;
        /* Hide initially **/
    }

    /* Loader Styles */
    .loader {
        width: 50px;
        aspect-ratio: 1;
        display: grid;
        border: 4px solid #0000;
        border-radius: 50%;
        border-color: #ccc #0000;
        animation: l16 1s infinite linear;
    }

    .loader::before,
    .loader::after {
        content: "";
        grid-area: 1/1;
        margin: 2px;
        border: inherit;
        border-radius: 50%;
    }

    .loader::before {
        border-color: #f03355 #0000;
        animation: inherit;
        animation-duration: .5s;
        animation-direction: reverse;
    }

    .loader::after {
        margin: 8px;
    }

    @keyframes l16 {
        100% {
            transform: rotate(1turn);
        }
    }
</style>

<button id="refreshButton" class="btn">Refresh Page</button>

<div class="loader-container" id="loader">
    <div class="loader"></div>
</div>


<div style="padding:15px;">
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom">
            <!-- <h4 class="card-title mb-0">Basic Table 2</h4> -->

            <div class="row" id="filters-container">
                <div class="col-xl-2">
                    <div class="card">
                        <div class="card-body" style="background-color: white;">
                            <div class="form-group mb-0" style="position: relative;">
                                <input type="text" id="myInput" class="form-control" onkeyup="filterUsers()" placeholder="Search  usernames" autocomplete="on">
                                <select id="userDropdown" class="form-control mt-1 custom-select" size="5" onclick="selectUser()" style="position: absolute; top: 100%; left: 0; width: 100%; display: none; z-index: 1000;">
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-2">
                    <div class="card">
                        <div class="card-body" style="background-color: white;">
                            <!-- <span style="position:relative;bottom:10px">Transaction Type</span> -->
                            <div class="form-group mb-0">

                                <select name="order_type" class="myInputClass form-control form-select select2 categorys" data-bs-placeholder="Select Type">
                                    <option value="all">all</option>
                                    <option value="1">Deposit</option>
                                    <option value="2">Win Bonus</option>
                                    <option value="3">Bet Awarded</option>
                                    <option value="4">Withdrawal</option>
                                    <option value="6">Bet Cancelled</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-2">
                    <div class="card">
                        <div class="card-body" style="background-color: white;">
                            <!-- <span style="position:relative;bottom:10px">Transaction Type</span> -->
                            <div class="form-group mb-0">

                                <select name="order_type" class="myInputClass form-control form-select select2 categorys" data-bs-placeholder="Select Type">
                                    <option value="all">all</option>
                                    <option value="1">Deposit</option>
                                    <option value="2">Win Bonus</option>
                                    <option value="3">Bet Awarded</option>
                                    <option value="4">Withdrawal</option>
                                    <option value="6">Bet Cancelled</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2">
                    <div class="card">

                        <div class="card-body" style="background-color: white;">
                            <!-- <span style="position:relative;bottom:10px">Start Date</span> -->
                            <div class="form-group mb-0">
                                <input type="date" class="myInputClass form-control startdate" name="datecreated" placeholder="" type="text">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2">
                    <div class="card">

                        <div class="card-body" style="background-color: white;">
                            <!-- <span style="position:relative;bottom:10px">Start Date</span> -->
                            <div class="form-group mb-0">
                                <input type="date" class="myInputClass form-control startdate" name="datecreated" placeholder="" type="text">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2">
                    <div class="card">

                        <div class="card-body" style="background-color:white; padding:25px">
                            <div class="form-group mb-0">
                                <!-- <a id="query" class="btn btn-outline-secondary ">Execute Query</a> -->
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="" id="btnradio21" checked>
                                    <label class="btn btn-outline-primary transquery"> <i class="ti ti-search text-xs mr-2"></i>Search
                                    </label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio33">
                                    <label class="btn btn-outline-primary betrefresht refresh" id="refresh"><i class="ti ti-reload text-xs mr-2"></i>Refresh</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- <div class="card-body p-4  table-scroll-container"> -->
            <!-- <button class="scroll-btn left" data-direction="left" onclick="scrollTable(this)">&larr;</button> -->
            <!-- <button class="scroll-btn left" onclick="scrollTable('left')">&larr;</button> table-striped-->
            <!-- <div class="table-responsive mb-4 border rounded-1 table-wrappers"> -->
            <table class="table text-nowrap mb-0 align-middle table table-striped">
                <thead class="text-gray-500">
                    <tr>
                        <th>ID Number</th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Username</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Transaction Type</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0"> Debit Amount</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0"> Credit Amount</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Balance</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Date/Time</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Transaction ID</h6>
                        </th>


                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>


                    </tr>
                </thead>
                <tbody id="trans-dtholder">
                    <?php

                    $pageNum = isset($_GET['page']) ? $_GET['page'] : 1;
                    $results = (new Businessflow)::FetchTrsansactionData($pageNum, 10);
                    echo "<pre>";
                    // var_dump($results);
                    foreach ($results as $data) {

                        $username = BusinessFlow::getUserName($data['uid']);
                        $lotteryName = BusinessFlow::getLottery($data['game_type']);
                        $betID = BusinessFlow::getbetID($data['order_id'], $data['game_type']);

                        $total_income = 0;
                        $total_incomes = 0;
                        // $Tablename = ;
                        $order_type = [
                            1 => '<span style ="background-color:#4CAF50;color: #faebd7;min-width:152px; display: inline-block; text-align:center;padding: 5px; border-radius: 5px;">Deposit</span>', //background-color:#4CAF50;color: #faebd7;
                            2 => '<span class="tag" style="min-width: 120px;background-color:#FFD700;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Win Bonus</span>',
                            3 => '<span class="tag tag-success" style="background-color:#1E90FF;color: #faebd7;min-width: 152px; display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Bet Awarded</span>', //background-color:#1E90FF;color: #faebd7;
                            4 => '<span class="tag"  style="min-width: 152px;background-color:#FF4500;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Withdrawal</span>',
                            5 => '<span class="tag" style="min-width:  152px;background-color:#DC143C;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Bet Deduct</span>',
                            6 => '<span class="tag" style="min-width:  152px;background-color:#A9A9A9;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Bet Cancelled</span>',
                            7 => '<span class="tag" style="min-width:  152px;background-color:#8A2BE2;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Rebates</span>',
                            8 => '<span class="tag" style="min-width:  152px;background-color:#9370DB;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Self Rebate</span>',
                            9 => '<span class="tag" style="min-width: 152px;background-color:#FF6347;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Sending Red Envelope</span>',
                            10 => '<span class="tag" style="min-width: 152px;background-color:#FF69B4;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Red Envelope Receive</span>',
                            11 => '<span class="tag" style="min-width:  152px;background-color:#4682B4;color: #faebd7;display: inline-block; text-align: center;padding: 5px; border-radius: 5px;">Bet Refund</span>',

                        ];



                        $status = $order_type[$data['order_type']] ?? 'Unknown';

                        $trans_state = [
                            1 => '<span class="badge text-success" ">Completed</span>',
                            0 => '<span class="tag tag-warning" style="">Pending</span>',
                            -1 => '<span class="tag tag-danger" style="">Failed</span>',

                        ];

                        $trans_status = $trans_state[$data['status']] ?? 'Unknown';

                        if ($data['transaction_type'] == 1) {
                            $total_income = '<span style="color:re;"> +' . $data['account_change'] . ' </span>';
                        } else {
                            $total_incomes = '<span style="color:re;"> ' . $data['account_change'] . ' </span>';
                        }

                        $lottery_name = ($data['order_type'] != 1 && $data['order_type'] != 4 && $data['order_type'] != 9 && $data['order_type'] != 10) ? $lotteryName : '--/--';

                        $transid = substr("T" . $data['order_id'], 0, 10);

                        // $totalExpenditure  =  BusinessFlow::TotalExpenditureTransaction($transtype = 1);
                        // $totalIncome = BusinessFlow::TotalIncomeTransaction( $transtypes = 2); 
                        $totalResult[] = $data['balance'];

                        $transid = substr("T" . $data['order_id'], 0, 10);

                    ?>



                        <tr>

                            <td><?= $transid ?></td>
                            <td>
                                <p class="fs-3 fw-semibold mb-0"><?= $username ?></p>
                            </td>
                            <td><?= $status ?></td>
                            <td><?= $total_incomes ?></td>
                            <td><?= $total_income ?></td>
                            <td><?= $data['balance'] ?></td>
                            <td><?= $data['dateTime'] ?></td>
                            <td><a data-bs-effect="effect-fall" data-bs-toggle="modal" href="#LargeModalview1" id="<?= $betID . '|' . $data['game_type'] . '|' . $lottery_name . '|' . $data['order_id'] ?>"><span class="badge bg-primary-subtle text-primary" style="cursor: pointer;color:#4DEEEA"><?= $data['order_id'] ?></span> </a></td>
                            <td> <i class=""></i><?= $trans_status ?></td>


                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>

        </div>
        <!-- <button class="scroll-btn right" data-direction="right" onclick="scrollTable(this)">&#8594;</button> -->
    </div>
</div>
<!-- <hr> -->

<div class="px-4 py-3 border-top pager">
    <span class="top-left-btn">
        <div class="btn-group mb-2" role="group" aria-label="Basic example" style="border:solid 1px #eee;color:#bbb">
            <button type="button" class="btn bg-white-subtle ">
                <i class='bx bx-chevron-left' style="font-size:20px"></i>
            </button>
            <button type="button" class="btn bg-white-subtle ">
                <i class='bx bx-minus' style="font-size:20px"></i>
            </button>
            <button type="button" class="btn bg-white-subtle ">
                <i class='bx bx-chevron-right' style="font-size:20px"></i>
            </button>
        </div>
    </span>
    <span class="top-right" aria-label="Page navigation example">
        <?php

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pages = (new Model)->paginateAllUsers($page, 5);
        $totalPages = count($pages['pages']);

        $pagLink = "<ul class='pagination justify-content-end'>";

        // Previous button
        $prevPage = max(1, $page - 1);
        $pagLink .= "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'><a class='page-link' href='index.php?page=$prevPage'><i class='bx bx-chevron-left'></i></a></li>";

        // Page numbers with ellipsis
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                $pagLink .= "<li class='page-item active'><a class='page-link'>$i</a></li>";
            } elseif ($i <= 1 || $i >= $totalPages || abs($i - $page) <= 2) {
                $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
            } elseif ($i == $page - 3 || $i == $page + 3) {
                $pagLink .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
            }
        }

        // Next button
        $nextPage = min($totalPages, $page + 1);
        $pagLink .= "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'><a class='page-link' href='./home/$nextPage'><i class='bx bx-chevron-right'></i></a></li>";

        $pagLink .= "</ul>";

        echo $pagLink;

        ?>



    </span>

</div>

</div>
</div>