<?php

class StudentValidator
{
  public static function isValidMarks($marks)
  {
    return is_numeric($marks) && $marks >= 0 && $marks <= 100;
  }
}

class StudentUtils
{
  public static function calculateGrade($marks)
  {
    if ($marks >= 80) return 'A';
    if ($marks >= 60) return 'B';
    if ($marks >= 40) return 'C';
    return 'F';
  }
}

class Student
{
  public $name;
  public $marks;
  public static $count = 0;

  public function __construct($name, $marks)
  {
    if (!StudentValidator::isValidMarks($marks)) {
      throw new Exception("Invalid marks for $name");
    }

    $this->name = $name;
    $this->marks = $marks;
    self::$count++;
  }

  public function getGrade()
  {
    return StudentUtils::calculateGrade($this->marks);
  }

  public function show()
  {
    echo "{$this->name} scored {$this->marks}, Grade: {$this->getGrade()}\n";
  }
}

// Create a single student
$student = new Student("Moinul", 75);
$student->show();

echo "Total students: " . Student::$count . "\n";

// Create multiple students
$studentsData = [
  ['name' => 'Alice', 'marks' => 85],
  ['name' => 'Bob', 'marks' => 55],
  ['name' => 'Charlie', 'marks' => 35],
];

$students = [];
foreach ($studentsData as $data) {
  $students[] = new Student($data['name'], $data['marks']);
}

echo "Total students: " . Student::$count . "\n";
