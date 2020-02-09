<?php

require '../../vendor/autoload.php';
use Addressbook\Book;
use Addressbook\Person;
use Addressbook\Group;
class BookTest {

    public static $book;

    public function __construct()
    {
        self::$book = new Book();
    }

    /**
 * @test
 */
    public function shouldAddNewPersonsToBook()
    {
        self::$book::addPerson(new Person('1', 'firstName1', 'lastName1', ['address1', 'address2', 'address3'], ['email1@dgdfg', 'email2', 'email3'], ['phone1', 'phone2', 'phone3'], ['group1', 'group2', 'group3']));
        self::$book::addPerson(new Person('2', 'firstName2', 'lastName2', ['address3', 'address4', 'address5'], ['email1', 'email4', 'email5'], ['phone3', 'phone4', 'phone5'], ['group3', 'group4', 'group5']));
        self::$book::addPerson(new Person('3', 'firstName3', 'lastName3', ['address6', 'address7', 'address8'], ['email6', 'email7', 'email8'], ['phone6', 'phone7', 'phone8'], ['group1', 'group7', 'group8']));
        self::$book::addPerson(new Person('4', 'firstName3', 'lastName3', ['address6', 'address7', 'address8'], ['email6', 'email7', 'email8'], ['phone6', 'phone7', 'phone8'], ['group6', 'group7', 'group8']));

        return self::$book::getPersons();
    }

    /**
     * @test
     */
    public function shouldAddNewGroupsToBook()
    {
        self::$book::addGroup(new Group('1', 'group1'));
        self::$book::addGroup(new Group('2', 'group2'));
    }

    /**
     * @test
     * @depends shouldAddNewPersonsToBook
     */
    public function shouldGetPersonByName()
    {
        $this->shouldAddNewPersonsToBook();
        return self::$book::getPersonByName('firstName3');
    }

    /**
     * @test
     */
    public function shouldGetPersonsGroups()
    {
        $this->shouldAddNewPersonsToBook();
        return self::$book::getPersonGroups('firstName2');
    }

    /**
     * @test
     */
    public function shouldGetPersonsByEmail()
    {
        $this->shouldAddNewPersonsToBook();
        return self::$book::getPersonByEmail('email1');
    }

    /**
     * @test
     */
    public function shouldGetPersonsByGroupName()
    {
        $this->shouldAddNewPersonsToBook();
        return self::$book::getPersonByGroupName('group1');
    }
}
$testBook = new BookTest();
echo 'Persons in the book';
echo '<pre>';
print_r($testBook->shouldAddNewPersonsToBook());
echo '</pre>';

$testBook->shouldAddNewGroupsToBook();

echo 'Get person by name  "firstName3"';
echo '<pre>';
print_r($testBook->shouldGetPersonByName());
echo '</pre>';

echo 'Get groups of person with name "firstName2"';
echo '<pre>';
print_r($testBook->shouldGetPersonsGroups());
echo '</pre>';

echo 'Get person by email "email1"';
echo '<pre>';
print_r($testBook->shouldGetPersonsByEmail());
echo '</pre>';

echo 'Get persons by group name "group1"';
echo '<pre>';
print_r($testBook->shouldGetPersonsByGroupName());
echo '</pre>';