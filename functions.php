<?php 

/*
 * 
 *  HELPER FUNCTIONS
 * 
*/

$upload_directory = "img";

function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message_text($type, $icon, $message)
{
    $structure = <<<LOIPOGI
    <span class="{$type}"><i class="fa fa-w {$icon}"></i>&nbsp;&nbsp;{$message}</span>
LOIPOGI;

    $_SESSION['notice'] = $structure;
}

function set_message_alert($type, $icon, $message)
{
    $structure = <<<LOIPOGI
    <div class="alert {$type}" role="alert"><i class="fa fa-w {$icon}" role="alert"></i>&nbsp;&nbsp;{$message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
LOIPOGI;

    $_SESSION['notice'] = $structure;
}

function display_notice()
{
    if(isset($_SESSION['notice']))
    {
        echo $_SESSION['notice'];
        unset($_SESSION['notice']);
    }
}

function redirect($location)
{
    header("Location: $location");
}

function refresh($interval, $location)
{
    header("Refresh: {$interval}; URL={$location}");
}
    
function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;

    if(!$result)
    {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

function fetch_assoc($result)
{
    return mysqli_fetch_assoc($result);
}

function row_count($query)
{
    return mysqli_num_rows($query);
}

function display_img($id)
{
    global $upload_directory;

    $get_img = query("SELECT img FROM admin WHERE id = '{$id}' ");
    confirm($get_img);

    if(row_count($get_img) == 1)
    {
        $img = fetch_assoc($get_img);
        echo $upload_directory . DS . $img['img'];
    }
}

/*
 * 
 *  FRONT END FUNCTIONS
 * 
*/

function get_positions()
{
    $positions = query("SELECT * FROM positions");
    confirm($positions);

    while($row = fetch_array($positions))
    {
        $posID = escape_string($row['id']);
        $posName = escape_string($row['name']);

        $listOfPos = <<<LOIPOGI
        <tr>
            <td>{$posName}</td>
            <td>
                <span data-toggle="tooltip" data-placement="left" title="Edit">
                <button id="{$posID}" class="btn btn-purple edit_pos" data-toggle="modal" data-target="#addPos"><i class="fa fa-edit"></i></button>
                </span>
            </td>
        </tr>
LOIPOGI;

        echo $listOfPos;
    }
}

function get_employees()
{
    $employees = query("SELECT * FROM employees WHERE status = '1' ");
    confirm($employees);

    while($row = fetch_array($employees))
    {
        $emp_name = escape_string($row['fname']) . " " . escape_string($row['lname']);
        $emp_pos = get_position_name($row['position']);
        $emp_sal = number_format($row['salary'], 2);
        $emp_ti = $row['time_in'];
        $emp_to = $row['time_out'];
        $emp_address = escape_string($row['address']);
        $emp_contact = escape_string($row['contact_num']);
        $emp_id = escape_string($row['id']);


        $listOfEmp = <<<LOIPOGI
        <tr>
            <td><span class="badge badge-pill badge-secondary">ID#: {$emp_id}</span>&nbsp;&nbsp;&nbsp;{$emp_name}</td>
            <td>{$emp_pos}</td>
            <td>&#8369; {$emp_sal}</td>
            <td>{$emp_ti} ~ {$emp_to}</td>
            <td>{$emp_address}</td>

            <td>
                <span data-toggle="tooltip" data-placement="left" title="Edit">
                    <button id="{$row['id']}" class="btn btn-purple edit_emp" data-toggle="modal" data-target="#addEmp"><i class="fa fa-edit"></i></button>
                </span>

                <span data-toggle="tooltip" data-placement="left" title="Deductions">
                    <button id="{$row['id']}" class="btn btn-warning edit_deduc" data-toggle="modal" data-target="#editDeducModal"><i class="fa fa-exclamation-circle"></i></button>
                </span>

                <span data-toggle="tooltip" data-placement="left" title="Disable">
                    <a href="#" class="btn btn-danger" data-href="disable_employee.php?emp_id={$row['id']}" data-toggle="modal" data-target="#confirm-delete-employee"><i class="fa fa-times"></i></a>
                </span>
            </td>
        </tr>
LOIPOGI;

        echo $listOfEmp;
    }
}

function get_employees_for_workhrs()
{
    $employees = query("SELECT * FROM employees WHERE status = '1' ");
    confirm($employees);

    while($empRow = fetch_array($employees))
    {
        $emp_name = escape_string($empRow['fname']) . " " . escape_string($empRow['lname']);
        $emp_id = escape_string($empRow['id']);
        $today = date("Y-m-d");

        $timeIn = "";
        $breakStart = "";
        $breakEnd = "";
        $timeOut = "";

        $queryWorkHrs = query("SELECT TIME_FORMAT(time_in, '%h:%i %p') AS timein, TIME_FORMAT(time_out, '%h:%i %p') AS timeout, TIME_FORMAT(break_start, '%h:%i %p') AS breakstart, TIME_FORMAT(break_end, '%h:%i %p') AS breakend FROM hrs_worked WHERE emp_id = '{$empRow['id']}' AND date = '{$today}'");
        confirm($queryWorkHrs);

        while($hrsWRow = fetch_array($queryWorkHrs))
        {
            $timeIn = $hrsWRow['timein'];
            $breakStart = $hrsWRow['breakstart'];
            $breakEnd = $hrsWRow['breakend'];
            $timeOut = $hrsWRow['timeout'];
        }

        $structure = <<<LOIPOGI
        <tr>
            <td><span class="badge badge-pill badge-secondary">ID#: {$emp_id}</span>&nbsp;&nbsp;&nbsp;{$emp_name}</td>
            <td>{$timeIn}</td>
            <td>{$breakStart}</td>
            <td>{$breakEnd}</td>
            <td>{$timeOut}</td>
            <td>
                <span data-toggle="tooltip" data-placement="left" title="Deductions">
                    <button id="{$emp_id}" class="btn btn-warning apply_time" data-toggle="modal" data-target="#editDeducModal"><i class="fa fa-exclamation-circle"></i></button>
                </span>
            </td>
        </tr>
LOIPOGI;

        echo $structure;
    }
}

function input_wrkhrs_emp()
{
    $employees = query("SELECT * FROM employees WHERE statis = '1' ");
    confirm($employees);

    while($empRow = fetch_array($employees))
    {
        $emp_name = escape_string($empRow['fname']) . " " . escape_string($empRow['lname']);
        $emp_id = escape_string($empRow['id']);

        $structure = <<<LOIPOGI
        <tr>
            <td><span class="badge badge-pill badge-secondary">ID#: {$emp_id}</span>&nbsp;&nbsp;&nbsp;{$emp_name}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input class="form-control selectedDate" type="text" value="" readonly></td>
            <td>
                <span data-toggle="tooltip" data-placement="left" title="Deductions">
                    <button id="{$emp_id}" class="btn btn-warning apply_time" data-toggle="modal" data-target="#editDeducModal"><i class="fa fa-exclamation-circle"></i></button>
                </span>
            </td>
        </tr>
LOIPOGI;

        echo $structure;
    }
}

function get_emp_wrkhrs()
{
    $employees = query("SELECT * FROM employees WHERE status = '1' ");
    confirm($employees);

    while($row = fetch_array($employees))
    {
        $emp_name = escape_string($row['fname']) . " " . escape_string($row['lname']);
        $emp_pos = get_position_name($row['position']);
        $emp_sal = number_format($row['salary'], 2);
        $emp_ti = $row['time_in'];
        $emp_to = $row['time_out'];
        $emp_address = escape_string($row['address']);
        $emp_contact = escape_string($row['contact_num']);
        $emp_id = escape_string($row['id']);
        $today = date('Y-m-d');



        $listOfPos = <<<LOIPOGI
        <tr>
            <td><span class="badge badge-pill badge-secondary">ID#: {$emp_id}</span>&nbsp;&nbsp;&nbsp;{$emp_name}</td>
            <td>&#8369; {$emp_sal}</td>
            <td>{$emp_ti} ~ {$emp_to}</td>
            <td>
                <form class="getDate" method="POST">
                    <input class="form-control selectedDate" value="{$today}" type="text" readonly>
                </form>
            </td>
            <td>
                <span data-toggle="tooltip" data-placement="left" title="Edit">
                    <button id="{$row['id']}" class="btn btn-purple edit_hrs" data-toggle="modal" data-target="#editHrsWorkedModal"><i class="fa fa-edit"></i></button>
                </span>

            </td>
        </tr>
LOIPOGI;

        echo $listOfPos;
    }
}

function get_position_name($pos_id)
{
    $get_name = query("SELECT name FROM positions WHERE id = '{$pos_id}' ");
    confirm($get_name);

    $row = fetch_assoc($get_name);
    $position_name = $row['name'];

    return $position_name;
}

function get_emp_name($emp_id)
{
    $get_name = query("SELECT fname, lname FROM employees WHERE id = '{$emp_id}' ");
    confirm($get_name);

    $row = fetch_assoc($get_name);
    $employee_name = $row['fname'] . " " . $row['lname'];

    return $employee_name;
}

function select_positions()
{
    $positions = query("SELECT * FROM positions");
    confirm($positions);
    
    while($row = fetch_array($positions))
    {
        $category_options = <<<LOIPOGI
        <option value="{$row['id']}">{$row['name']}</option>
LOIPOGI;
        
        echo $category_options;
    }
}

function select_employee()
{
    $employees = query("SELECT * FROM employees");
    confirm($employees);

    while($row = fetch_array($employees))
    {
        $employee_list = <<<LOIPOGI
        <option value="{$row['id']}">{$row['fname']} {$row['lname']}</option>
LOIPOGI;
        
        echo $employee_list;
    }
}

function emp_selector($id)
{
    $employees = query("SELECT * FROM employees WHERE id = '{$id}' ");
    confirm($employees);

    $empRow = fetch_assoc($employees);
    $emp_id = $empRow['id'];

    echo "<input type='text' value='{$emp_id}' name='emp_selector'>";
}

function get_active_loans()
{
    $loans_query = query("SELECT * FROM loans");
    confirm($loans_query);

    while($row = fetch_array($loans_query))
    {
        $getName_query = query("SELECT fname, lname FROM employees WHERE id = '{$row['emp_id']}' ");
        confirm($getName_query);

        $getNameRow = fetch_assoc($getName_query);
        $employeeName = $getNameRow['fname'] . " " . $getNameRow['lname'];

        $amount = number_format($row['amount'], 2);
        $paid = number_format($row['paid'], 2);

        $balance = $row['amount'] - $row['paid'];

        if($balance != 0)
        {
            $formattedBal = number_format($balance, 2);
            $active_loans = <<<LOIPOGI
    <tr>
        <td width="20%">
        <span data-toggle="tooltip" data-placement="left" title="Delete">
            <a href="#" data-href="deleteloan.php?loan_id={$row['id']}" data-toggle="modal" data-target="#confirm-delete-loan" class="btn btn-light"><i class="fa fa-times"></i><a/>
        </span><span class="badge badge-pill badge-secondary">ID#: {$row['emp_id']}</span>&nbsp;&nbsp;&nbsp;{$employeeName}</td>
        <td width="13%">&#8369; {$amount}</td>
        <td width="13%">&#8369; {$formattedBal}</td>
        <td width="13%">&#8369; {$paid}</td>
        <td width="12%">{$row['date_created']}</td>
        <td width="10%">

        <span data-toggle="tooltip" data-placement="left" title="Pay">
             <button id="{$row['id']}" class="btn btn-purple payLoan" data-toggle="modal" data-target="#payLoanModal"><i class="fa fa-money-bill"></i></button>
        </span>

        <span data-toggle="tooltip" data-placement="left" title="Description">
             <button id="{$row['id']}" class="btn btn-warning loanDesc" data-toggle="modal" data-target="#loanDescModal"><i class="fa fa-file"></i></button>
        </span>

        </td>
    </tr>

LOIPOGI;

            echo $active_loans;
        }
        else
        {

        }

        
    }
}

function get_loan_history()
{
    $loanHQuery = query("SELECT * FROM loan_history");
    confirm($loanHQuery);

    while($row = fetch_array($loanHQuery))
    {
        $getName_query = query("SELECT fname, lname FROM employees WHERE id = '{$row['emp_id']}' ");
        confirm($getName_query);

        $getNameRow = fetch_assoc($getName_query);
        $employeeName = $getNameRow['fname'] . " " . $getNameRow['lname'];

        $outputLoanH = <<<LOIPOGI
        <tr>
            <td>{$employeeName}</td>
            <td>&#8369; {$row['amount_paid']}</td>
            <td>{$row['date_paid']}</td>
        </tr>
LOIPOGI;

        echo $outputLoanH;
    }
}

function get_loan_history_deductions()
{
    $loanHQuery = query("SELECT * FROM loan_deductions");
    confirm($loanHQuery);

    while($row = fetch_array($loanHQuery))
    {
        $getName_query = query("SELECT fname, lname FROM employees WHERE id = '{$row['emp_id']}' ");
        confirm($getName_query);

        $getNameRow = fetch_assoc($getName_query);
        $employeeName = $getNameRow['fname'] . " " . $getNameRow['lname'];

        $outputLoanH = <<<LOIPOGI
        <tr>
            <td>{$employeeName}</td>
            <td>&#8369; {$row['loan_payment']}</td>
            <td>{$row['date_paid']}</td>
        </tr>
LOIPOGI;

        echo $outputLoanH;
    }
}

function count_employees()
{
    $empList = query("SELECT * FROM employees");
    confirm($empList);

    echo row_count($empList);
}

function count_positions()
{
    $posList = query("SELECT * FROM positions");
    confirm($posList);

    echo row_count($posList);
}

function count_loans()
{
    $loans_query = query("SELECT * FROM loans");
    confirm($loans_query);

    $counter = 0;

    while($row = fetch_array($loans_query))
    {
        $getName_query = query("SELECT fname, lname FROM employees WHERE id = '{$row['emp_id']}' ");
        confirm($getName_query);

        
        $balance = $row['amount'] - $row['paid'];

        if($balance != 0)
        {
            $counter++;
        }
    }

    echo $counter;
}

function get_employee_record()
{
    $get_date = query("SELECT MONTHNAME(date) AS 'nameOfMonth', MONTH(date) AS 'monthWorked', YEAR(NOW()) AS 'yrWorked' FROM hrs_worked ORDER BY monthWorked DESC");
    confirm($get_date); 

    while($dateRow = fetch_array($get_date))
    {
        $totalReleasedPayroll = 0;
        $get_history = query("SELECT * FROM hrs_worked WHERE MONTH(date) = '{$dateRow['monthWorked']}' AND YEAR(NOW()) = '{$dateRow['yrWorked']}'");
        confirm($get_history);

        $history_date = $dateRow['monthWorked'];
        $monthName = $dateRow['nameOfMonth'];
        $yearWorked = $dateRow['yrWorked'];

        $top_card = <<<LOIPOGI
        <li class="liRecord" style="list-style: none; display: none">
        <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
            <button class="btn" type="button" data-toggle="collapse" data-target="#collapse{$history_date}{$yearWorked}" aria-expanded="true" aria-controls="collapseOne">
                Record for {$monthName}, {$yearWorked}
            </button>
            </h2>
        </div>

            <div id="collapse{$history_date}{$yearWorked}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm empTable"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%">Employee</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Break Start</th>
                            <th>Break End</th>
                            <th>Date</th>
                            <th class="d-print-none">Delete</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th width="10%">Employee</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Break Start</th>
                            <th>Break End</th>
                            <th>Date</th>
                            <th class="d-print-none">Delete</th>
                        </tr>
                    </tfoot>

                    <tbody>
LOIPOGI;

        echo $top_card;

        while($historyRow = fetch_array($get_history))
        {

        $getName_query = query("SELECT fname, lname FROM employees WHERE id = '{$historyRow['emp_id']}' ");
        confirm($getName_query);

        $getNameRow = fetch_assoc($getName_query);
        $employeeName = $getNameRow['fname'] . " " . $getNameRow['lname'];


            $history = <<<LOIPOGI
            
            <tr>
                <td>{$employeeName}</td>
                <td>{$historyRow['time_in']}</td>
                <td>{$historyRow['time_out']}</td>
                <td>{$historyRow['break_start']}</td>
                <td>{$historyRow['break_end']}</td>
                <td>{$historyRow['date']}</td>
                <td class="d-print-none">
                <span data-toggle="tooltip" data-placement="left" title="Delete">
                    <a href="#" class="btn btn-danger" data-href="delete_emp_record.php?record_id={$historyRow['id']}" data-toggle="modal" data-target="#confirm-delete-record"><i class="fa fa-times"></i></a>
                </span>
                </td>
            </tr>
                    
LOIPOGI;

            echo $history;

        }


        $bot_card = <<<LOIPOGI
        </tbody>
                </table>

                
            </div>
        </div>
        </div>
    </div>
    </li>
LOIPOGI;

        echo $bot_card;
    }
}

?>