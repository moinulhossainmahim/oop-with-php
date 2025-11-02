<?php

/**
 * INHERITANCE EXAMPLE: Employee Hierarchy
 * 
 * Demonstrates inheritance with Employee (parent) and Developer/Manager (children)
 * Shows: protected properties, method overriding, constructor chaining
 */

// Base class - common behavior for all employees
class Employee
{
    protected $name;
    protected $id;
    protected $salary;

    public function __construct($name, $id, $salary)
    {
        $this->name = $name;
        $this->id = $id;
        $this->salary = $salary;
    }

    public function takeBreak()
    {
        return "{$this->name} is taking a break.";
    }

    public function work()
    {
        return "{$this->name} is working on general tasks.";
    }

    public function getInfo()
    {
        return "ID: {$this->id} | Name: {$this->name} | Salary: \${$this->salary}";
    }
}

class Developer extends Employee
{
    private $language;

    public function __construct($name, $id, $salary, $language)
    {
        parent::__construct($name, $id, $salary);
        $this->language = $language;
    }

    public function work()
    {
        return "{$this->name} is writing {$this->language} code.";
    }

    public function debugCode()
    {
        return "{$this->name} is debugging code.";
    }
}

class Manager extends Employee
{
    private $teamSize;

    public function __construct($name, $id, $salary, $teamSize)
    {
        parent::__construct($name, $id, $salary);
        $this->teamSize = $teamSize;
    }

    public function work()
    {
        return "{$this->name} is managing a team of {$this->teamSize} people.";
    }

    public function conductMeeting()
    {
        return "{$this->name} is conducting a meeting.";
    }
}

echo "=== INHERITANCE EXAMPLE ===\n\n";

$developer = new Developer('Alice', 'EMP001', 95000, 'PHP');
$manager = new Manager('Bob', 'EMP002', 120000, 8);

echo "1. Shared method (inherited from Employee):\n";
echo "   " . $developer->takeBreak() . "\n";
echo "   " . $manager->takeBreak() . "\n\n";

echo "2. Overridden methods (each child has its own implementation):\n";
echo "   " . $developer->work() . "\n";
echo "   " . $manager->work() . "\n\n";

echo "3. Child-specific methods:\n";
echo "   " . $developer->debugCode() . "\n";
echo "   " . $manager->conductMeeting() . "\n\n";

echo "4. Using parent methods:\n";
echo "   " . $developer->getInfo() . "\n";
echo "   " . $manager->getInfo() . "\n";
