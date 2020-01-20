<?php

class User
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $password;

    public function add($id, $name, $email, $role,$password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->password = Formater::hashPassword($password);

    }
}
