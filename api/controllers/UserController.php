<?php
class UserController
{
    private $user;

    public function __construct($db)
    {
        $this->user = new User($db);
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->user->email = $data->email;
        $this->user->password = $data->password;
        $this->user->fullname = $data->fullname;

        if ($this->user->register()) {
            return true;
        }

        return false;
    }

    public function login()
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->user->email = $data->email;
        $this->user->password = $data->password;

        $stmt = $this->user->login();
        return $stmt;
    }

    public function showProfile($id)
    {
        $stmt = $this->user->showProfile($id);
        return $stmt;
    }

    public function updateProfile($id)
    {
        $data = json_decode(file_get_contents("php://input"));

        $this->user->fullname = $data->fullname;
        $this->user->password = $data->password;
        $this->user->dob = $data->dob;
        $this->user->gender = $data->gender;
        $this->user->work_department = $data->work_department;

        if ($this->user->updateProfile($id)) {
            return true;
        }

        return false;
    }
}
