<?php

class Student
{
  public $name;
  public $id;
  public static $count = 0;

  public function __construct($name)
  {
    self::$count++;
    $this->id = self::$count;
    $this->name = $name;
  }

  public function show()
  {
    echo "ID: $this->id, Name: $this->name\n";
  }
}

$stu1 = new Student("Alice");
$stu2 = new Student("Bob");
$stu3 = new Student("Charlie");

echo "Total students: " . Student::$count . "\n";
