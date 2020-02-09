<?php


namespace Addressbook;

class Book
{
    protected static $persons = [];
    protected static $groups = [];

    /**
     * Add Person to the AddressBook
     *
     * @param Person $person
     * @return void
     */
    public static function addPerson(Person $person)
    {
        Book::addGroups($person->groups);

        self::$persons[$person->getId()] = $person;
    }

    /**
     * Check existing groups
     *
     * @param array $groups_names
     * @return array $groups_ids
     */
    public static function addGroups($groups_names)
    {
        $groups_ids = [];
        self::$groups = array_map(function ($a, $b) {
            if ($a === $b) return $a;
            return [$a, $b];
        }, self::$groups, $groups_names);
        foreach ($groups_names as $name) {
            if (!is_bool(array_search($name, self::$groups))) {
                $groups_ids[] = array_search($name, self::$groups);
            }
        }
        return $groups_ids;
    }

    /**
     * Add Group to the AddressBook
     *
     * @param Group $group
     * @return void
     */
    public static function addGroup(Group $group)
    {
        self::$groups[$group->getId()] = $group;
    }

    /**
     * Get all persons from the AddressBook
     *
     * @param Person $person
     * @return array | string  Persons with the same names | no results
     */
    public static function getPersons()
    {
        return Book::getResults(self::$persons);
    }

    /**
     * Get person from the AddressBook by id
     *
     * @param integer|string $id - person id
     * @return Person $person
     */
    public static function getPersonById($id)
    {
        return isset(self::$persons[$id]) ? self::$persons[$id] : null;
    }

    /**
     * Get group from the AddressBook by id
     *
     * @param integer|string $id - group id
     * @return Group $group
     */
    public static function getGroupById($id)
    {
        return isset(self::$groups[$id]) ? self::$groups[$id] : null;
    }

    /**
     * Get person from the AddressBook by name
     *
     * @param string $name - person First name | last name | First name + Last name
     * @return array | string  Persons with the same names | no results
     */
    public static function getPersonByName($name)
    {
        $result = [];
        foreach (self::$persons as $person) {
            if (!strripos($name, ' ')) {
                if (!strcasecmp($person->firstName, $name) || !strcasecmp($person->lastName, $name)) {
                    $result[] = Book::getPersonById($person->id);
                }
            } else {
                $person_name = explode(" ", $name);
                if ((!strcasecmp($person->firstName, $person_name[0]) && !strcasecmp($person->lastName, $person_name[1])) || (!strcasecmp($person->firstName, $person_name[1]) && !strcasecmp($person->lastName, $person_name[0]))) {
                    $result[] = Book::getPersonById($person->id);
                }
            }
        }
        return Book::getResults($result);
    }

    /**
     * Get person from the AddressBook by email
     *
     * @param string $email - person email
     * @return array | string  Persons with the same names | no results
     */
    public static function getPersonByEmail($email)
    {
        $result = [];
        foreach (self::$persons as $person) {
            foreach ($person->emails as $p_email) {
                if (!strcasecmp($p_email, $email) || !strcasecmp(stristr($p_email, '@', true), $email)) {
                    $result[] = Book::getPersonById($person->id);
                }
            }
        }
        return Book::getResults($result);
    }

    /**
     * Get person from the AddressBook by Group name
     *
     * @param string $group_name - group name
     * @return array | string  Persons with the same names | no results
     */
    public static function getPersonByGroupName($group_name)
    {
        $result = [];
        foreach (self::$persons as $person) {
            if (in_array($group_name, $person->groups)) {
                $result[] = Book::getPersonById($person->id);
            }
        }
        return Book::getResults($result);
    }

    /**
     * Get person Groups from the AddressBook by person name name
     *
     * @param string $group_name - group name
     * @return array | string  Persons with the same names | no results
     */
    public static function getPersonGroups($name)
    {
        $result =[];
        $persons_arr = Book::getPersonByName($name);
        if(is_array($persons_arr)){
            foreach ($persons_arr as $person){
                $result= array_merge($result, $person->groups);
            }
        }
        return Book::getResults($result);
    }

    /**
     * Print results
     *
     * @param array $results - founded persons
     * @return array | string  Founded persons | no results
     */
    public static function getResults($result)
    {
        if (!empty($result)) {
            return $result;
        } else {
            return 'Nothing found';
        }
    }
}