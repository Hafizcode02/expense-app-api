<?php

class ExpenseController {
    private $expense;

    public function __construct($db) {
        $this->expense = new Expense($db);
    }

    public function getAllExpenses($userId) {
        $stmt = $this->expense->getAllExpense($userId);
        return $stmt;
    }

    public function getExpensePrice($userId) {
        $stmt = $this->expense->getExpensePrice($userId);
        return $stmt;
    }

    public function createExpense() {
        $data = json_decode(file_get_contents("php://input"));

        $this->expense->id_user = $data->id_user;
        $this->expense->type = $data->type;
        $this->expense->price = $data->price;
        $this->expense->payment_method = $data->payment_method;
        $this->expense->date = $data->date;
        $this->expense->detail = $data->detail;

        if ($this->expense->createExpense()) {
            return true;
        }

        return false;
    }

    public function getExpenseById($id) {
        $stmt = $this->expense->getExpenseById($id);
        return $stmt;
    }

    public function updateExpense($id) {
        $data = json_decode(file_get_contents("php://input"));
        
        $this->expense->type = $data->type;
        $this->expense->price = $data->price;
        $this->expense->payment_method = $data->payment_method;
        $this->expense->date = $data->date;
        $this->expense->detail = $data->detail;

        if ($this->expense->updateExpense($id)) {
            return true;
        }

        return false;
    }

    public function deleteExpense($id) {
        if ($this->expense->deleteExpense($id)) {
            return true;
        }
        
        return false;
    }
}
