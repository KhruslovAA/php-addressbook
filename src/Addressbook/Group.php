<?php


namespace Addressbook;


class Group
{
    /**
     * @var integer|string
     */
    public $group_id;
    public $group_name;

    public function __construct($group_id, $group_name)
    {
        $this->group_id = $group_id;
        $this->group_name = $group_name;
    }

    /**
     * @return integer|string
     */
    public function getId()
    {
        return $this->group_id;
    }
    /**
     * @return string
     */
    /*public function addPersonToGroup()
    {
        return $this;
    }*/
}