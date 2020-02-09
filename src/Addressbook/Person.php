<?php


namespace Addressbook;


class Person
{
    /**
     * @var integer|string
     */
    public $id;
    public $firstName;
    public $lastName;

    /**
     * @var array
     */
    protected $addresses;
    public $emails;
    protected $phones;
    public $groups;


    public function __construct($id, $firstName, $lastName, $addresses, $emails, $phones, $groups)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->addresses = $addresses;
        $this->emails = $emails;
        $this->phones = $phones;
        $this->groups = $groups;

    }

    /**
     * @return integer|string
     */
    public function getId()
    {
        return $this->id;
    }
}