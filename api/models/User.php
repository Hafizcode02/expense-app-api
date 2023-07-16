<?php

class User
{
    private $conn;
    protected $table_name = "users";

    public $email;
    public $password;
    public $fullname;
    public $dob;
    public $gender;
    public $photo_url;
    public $work_department;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        $query = "INSERT INTO " . $this->table_name . " (id, email, password, fullname) VALUES (:id, :email, :password, :fullname)";
        $stmt = $this->conn->prepare($query);

        $this->id = rand(1, 9) . date('yds') . rand(0, 99);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
        $stmt->bindParam(":fullname", $this->fullname);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        $data = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            if (password_verify($this->password, $data['password'])) {
                return ["id" => $data['id'], "fullname" => $data['fullname']];
            }
            return false;
        }
        return false;
    }

    public function showProfile($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    public function updateProfile($id)
    {
        $addOnQueryPassword = "";
        if ($this->password != "") {
            $addOnQueryPassword = "password = :password,";
        }
        $query = "UPDATE " . $this->table_name . " SET " . $addOnQueryPassword . "fullname = :fullname, dob = :dob, gender = :gender, work_department = :work_department WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        if ($this->password != "") {
            $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
        }

        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":work_department", $this->work_department);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
