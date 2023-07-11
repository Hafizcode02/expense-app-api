<?php

// error_reporting(0);

require_once '../api/config/database.php';
require_once '../api/models/Expense.php';
require_once '../api/models/User.php';
require_once '../api/controllers/UserController.php';
require_once '../api/controllers/ExpenseController.php';

$database = new Database();
$db = $database->getConnection();

$expenseController = new ExpenseController($db);
$userController = new UserController($db);

// route Expenses (For get all expenses and count expenses)
if ($_GET['route'] === 'expenses' && $_GET['id']) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $expenseController->getAllExpenses($_GET['id']);
        $expensesList = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $expenseItem = array(
                'id' => $row['id'],
                'type' => $row['type'],
                'payment_method' => $row['payment_method'],
                'price' => $row['price'],
                'date' => $row['date'],
                'detail' => $row['detail']
            );

            array_push($expensesList, $expenseItem);
        }
        echo json_encode($expensesList);
        return;
    } else {
        echo json_encode(array('message' => 'Request Method not Allowed'));
        return;
    }
} else if ($_GET['route'] === 'expenses/count' && $_GET['id']) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $expenseController->getExpensePrice($_GET['id']);
        if ($stmt) {
            echo json_encode(array('totalExpense' => $stmt));
            return;
        }
        echo json_encode(array('totalExpense' => "0"));
        return;
    }
    echo json_encode(array('message' => 'Request Method not Allowed'));
    return;
}
// route expense (Create, Update, Delete)
else if ($_GET['route'] === 'expense') {
    if (!$_GET['id']) {
        // route for insert
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(array('message' => 'Request Method not Allowed'));
            return;
        }

        if ($expenseController->createExpense()) {
            echo json_encode(array('message' => 'Data Created Successfully'));
            return;
        }

        echo json_encode(array('message' => 'Fail to Create Data'));
        return;
    } else {
        // route for edit, update, delete
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $stmt = $expenseController->getExpenseById($_GET['id']);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $expenseItem = array(
                    'id' => $row['id'],
                    'type' => $row['type'],
                    'payment_method' => $row['payment_method'],
                    'price' => $row['price'],
                    'date' => $row['date'],
                    'detail' => $row['detail']
                );
                echo json_encode($expenseItem);
                return;
            }
            echo json_encode(array('message' => 'Expense Data not found'));
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if ($expenseController->updateExpense($_GET['id'])) {
                echo json_encode(array('message' => 'Data Updated Successfully'));
                return;
            }

            echo json_encode(array('message' => 'Fail to Update Data'));
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            if ($expenseController->deleteExpense($_GET['id'])) {
                echo json_encode(array('message' => 'Data Deleted Successfully'));
                return;
            }

            echo json_encode(array('message' => 'Fail to Delete Data'));
            return;
        }
        echo json_encode(array('message' => 'Request Method not Allowed'));
        return;
    }
}
// route for users
else if ($_GET['route'] === 'users') {
    if (!$_GET['id']) {
        // route for insert
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(array('message' => 'Request Method not Allowed'));
            return;
        }

        if ($userController->register()) {
            echo json_encode(array('message' => 'User Created Successfully'));
            return;
        }

        echo json_encode(array('message' => 'Fail to Create User Data'));
        return;
    } else {
        // route for edit, update, delete
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $stmt = $userController->showProfile($_GET['id']);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $item = array(
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'fullname' => $row['fullname'],
                    'dob' => $row['dob'],
                    'gender' => $row['gender'],
                    'work_department' => $row['work_department']
                );
                echo json_encode($item);
                return;
            }
            echo json_encode(array('message' => 'User Data not found'));
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if ($userController->updateProfile($_GET['id'])) {
                echo json_encode(array('message' => 'User Data Updated Successfully'));
                return;
            }

            echo json_encode(array('message' => 'Fail to Update User Data'));
            return;
        }
        echo json_encode(array('message' => 'Request Method not Allowed'));
        return;
    }
}
// route for login
else if ($_GET['route'] === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $userController->login();
        $stmt_json = json_encode($stmt);
        if ($stmt) {
            echo json_encode(array('message' => 'Login Berhasil', 'data' => json_decode($stmt_json)));
            return;
        }
        echo json_encode(array('message' => 'Login Gagal'));
        return;
    }
}
