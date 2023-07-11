<?php

class Expense
{
    private $conn;
    private $table_name = "expenses";

    public $id;
    public $id_user;
    public $type;
    public $payment_method;
    public $price;
    public $date;
    public $detail;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllExpense($userId)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userId);
        $stmt->execute();

        return $stmt->fet;
    }

    public function getExpensePrice($userId)
    {
        $query = "SELECT SUM(price) AS totalExpense FROM " . $this->table_name . " WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userId);
        $stmt->execute();

        $data = $stmt->fetch();

        return $data['totalExpense'];
    }

    public function CreateExpense()
    {
        $query = "INSERT INTO " . $this->table_name . " (id_user, type, price, payment_method, date, detail) VALUES (:id_user, :type, :price, :payment_method, :date, :detail)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":detail", $this->detail);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getExpenseById($idExpense)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $idExpense);
        $stmt->execute();

        return $stmt;
    }

    public function updateExpense($idExpense)
    {
        $query = "UPDATE " . $this->table_name . " SET type = :type, price = :price, payment_method = :payment_method, date = :date, detail = :detail WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":detail", $this->detail);
        $stmt->bindParam(":id", $idExpense);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteExpense($idExpense)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $idExpense);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
