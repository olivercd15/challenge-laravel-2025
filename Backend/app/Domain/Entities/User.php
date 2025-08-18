<?php

namespace App\Domain\Entities;

class User
{
    public string $id;
    public string $email;
    public string $password;

    public function __construct(string $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }
}
