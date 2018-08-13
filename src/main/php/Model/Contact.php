<?php

namespace lmarqs\Spa\Model;

class Contact extends Model
{

    private $id;
    private $name;
    private $phone;
    private $email;
    private $birthday;

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'birthday' => $this->getBirthday(),
        ];
    }

    public function fromArray($array)
    {
        $this->setId($array['id']);
        $this->setName($array['name']);
        $this->setPhone($array['phone']);
        $this->setEmail($array['email']);
        $this->setEmail($array['birthday']);

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
}
