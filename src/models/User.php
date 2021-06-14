<?php


class User
{
    private $name;
    private $surname;
    private $email;
    private $password;
    private $id;

    public function __construct()
    {
        $parameters = func_get_args();
        $this->name = $parameters[0];
        $this->surname = $parameters[1];
        $this->email = $parameters[2];
        $this->password = $parameters[3];
        $this->id = $parameters[4];

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }




}