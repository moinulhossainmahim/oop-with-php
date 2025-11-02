# Object-Oriented Programming (OOP) Concepts in PHP

A comprehensive repository demonstrating fundamental Object-Oriented Programming concepts using PHP. This repository serves as a learning resource and reference guide for understanding OOP principles through practical, real-world examples.

## 📚 Table of Contents

- [About This Repository](#about-this-repository)
- [OOP Concepts Covered](#oop-concepts-covered)
- [Getting Started](#getting-started)
- [Concepts Overview](#concepts-overview)
  - [Inheritance](#inheritance)
  - [Abstraction](#abstraction)
  - [Interfaces](#interfaces)
  - [Traits](#traits)
  - [Composition](#composition)
  - [Static Methods & Properties](#static-methods--properties)
- [Code Examples](#code-examples)
- [Best Practices](#best-practices)
- [Contributing](#contributing)

## 🎯 About This Repository

This repository is designed to help developers understand and master Object-Oriented Programming concepts in PHP. Each concept is demonstrated with clear, practical examples that you can run and experiment with. Whether you're a beginner learning OOP for the first time or an experienced developer looking for a quick reference, this repository provides valuable insights into:

- How OOP principles work in PHP
- Real-world use cases for each concept
- Best practices and patterns
- Code organization techniques

## 🚀 Getting Started

### Prerequisites

- PHP 7.4 or higher
- Basic understanding of PHP syntax
- Composer (optional, for some examples)

### Running Examples

1. Clone this repository:
```bash
git clone <repository-url>
cd oop
```

2. Navigate to any concept folder:
```bash
cd concepts/inheritance
```

3. Run PHP files directly:
```bash
php Model.php
```

## 📖 OOP Concepts Covered

This repository covers the following core OOP concepts:

1. **Inheritance** - Code reusability through parent-child relationships
2. **Abstraction** - Hiding implementation details with abstract classes
3. **Interfaces** - Defining contracts that classes must implement
4. **Traits** - Horizontal code reuse and shared behavior
5. **Composition** - Building complex objects by combining simpler ones
6. **Static Methods & Properties** - Class-level functionality and utilities

## 💡 Concepts Overview

### Inheritance

**Location:** `concepts/inheritance/`

Inheritance allows a class to inherit properties and methods from another class, promoting code reusability and establishing an "is-a" relationship.

**Key Benefits:**
- Code reusability
- Method overriding
- Polymorphism
- Organized class hierarchy

**Files:**
- `Model.php` - Demonstrates base Model class with inheritance and protected properties
- `Notification.php` - Shows method overriding with EmailNotification extending Notification

**Example:**
```php
class Model {
    protected $table;
    protected $fillable = [];
    
    public function save() {
        echo "Saving to table: {$this->table}\n";
    }
}

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['name'];
}
```

### Abstraction

**Location:** `concepts/abstract/`

Abstraction allows you to define partial implementations using abstract classes. Abstract classes cannot be instantiated directly and must be extended by child classes.

**Key Characteristics:**
- Cannot be instantiated directly
- Can contain both abstract and concrete methods
- Forces child classes to implement abstract methods
- Great for template method patterns

**Files:**
- `Controller.php` - Base controller with shared response methods
- `Model.php` - Abstract base model with common traits and behaviors
- `Payment.php` - Payment gateway with template method pattern

**Example:**
```php
abstract class PaymentGateway {
    public function process() {
        $this->connect();
        $this->pay();
        $this->disconnect();
    }
    
    abstract protected function pay();
}

class StripeGateway extends PaymentGateway {
    protected function pay() {
        echo "Processing Stripe payment...\n";
    }
}
```

### Interfaces

**Location:** `concepts/interface/`

Interfaces define contracts that classes must follow. They specify what methods a class must implement without providing the implementation itself.

**Key Characteristics:**
- All methods are implicitly abstract
- Classes can implement multiple interfaces
- Enforces consistent behavior across different classes
- No properties or method implementations allowed

**Files:**
- `Payment.php` - Payment gateway interface with multiple implementations
- `Template.php` - Template interface demonstrating required method implementation
- `WithAbstractExample.php` - Interface implementation using abstract classes

**Example:**
```php
interface PaymentGateway {
    public function charge(float $amount);
    public function refund(string $transactionId);
}

class StripePayment implements PaymentGateway {
    public function charge(float $amount) {
        echo "Charging \${$amount} via Stripe\n";
    }
    
    public function refund(string $transactionId) {
        echo "Refunding {$transactionId} via Stripe\n";
    }
}
```

### Traits

**Location:** `concepts/traits/`

Traits provide a mechanism for horizontal code reuse in PHP. They allow you to share methods across multiple classes without using inheritance.

**Key Characteristics:**
- Can be used by multiple classes
- Provides actual method implementations
- Helps avoid limitations of single inheritance
- Ideal for cross-cutting concerns

**Files:**
- `ApiResponse.php` - API response formatting trait for controllers
- `logger.php` - Logging functionality trait
- `trait-vs-interface.php` - Comparison between traits and interfaces

**Example:**
```php
trait ApiResponse {
    protected function success($data = null, $message = 'Success') {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }
}

class UserController extends Controller {
    use ApiResponse;
    
    public function index() {
        return $this->success($users, 'Fetched users');
    }
}
```

### Composition

**Location:** `concepts/composition/`

Composition is a design principle where a class contains instances of other classes, representing a "has-a" relationship. This is often preferred over inheritance for flexibility.

**Key Benefits:**
- More flexible than inheritance
- Easier to change behavior at runtime
- Avoids deep inheritance hierarchies
- Follows "favor composition over inheritance" principle

**Files:**
- `Subscription.php` - Demonstrates composition with BillingPortal dependency

**Example:**
```php
class Subscription {
    protected BillingPortal $billingPortal;
    
    public function __construct(BillingPortal $billingPortal) {
        $this->billingPortal = $billingPortal;
    }
}

// Composition = "a class has another class"
// Inheritance = "a class is a kind of another class"
```

### Static Methods & Properties

**Location:** `concepts/static-methods/`

Static methods and properties belong to the class itself rather than instances of the class. They can be accessed without creating an object.

**Key Characteristics:**
- Accessed using `Class::method()` syntax
- Shared across all instances
- Useful for utility functions
- Late static binding allows polymorphism with static methods

**Files:**
- `counter.php` - Static property for counting instances
- `validation.php` - Static utility methods for validation
- `late-static-binding.php` - Demonstrates late static binding concept

**Example:**
```php
class Student {
    public static $count = 0;
    
    public function __construct($name) {
        self::$count++;
        $this->name = $name;
    }
}

// Access without instantiation
echo "Total students: " . Student::$count . "\n";
```

## 🔍 Code Examples

Each concept folder contains working PHP examples that you can run and modify:

```
concepts/
├── abstract/          # Abstract classes and methods
├── composition/       # Composition patterns
├── inheritance/       # Class inheritance examples
├── interface/         # Interface implementations
├── static-methods/    # Static methods and properties
└── traits/            # Trait usage examples
```

### Running Examples

Navigate to any concept folder and run the PHP files:

```bash
cd concepts/inheritance
php Model.php

cd concepts/interface
php Payment.php

cd concepts/traits
php ApiResponse.php
```

## 🎓 Key Differences

### Interface vs Abstract Class

| Feature | Interface | Abstract Class |
|---------|-----------|----------------|
| Instantiation | Cannot be instantiated | Cannot be instantiated |
| Methods | Only abstract methods | Can have abstract and concrete methods |
| Properties | Constants only | Can have properties |
| Multiple Inheritance | Yes (multiple interfaces) | No (single inheritance) |
| Access Modifiers | Public only | Can have protected/private |
| Use Case | Define contracts | Shared code with required implementations |

### Trait vs Interface

| Feature | Trait | Interface |
|---------|-------|-----------|
| Implementation | Provides method implementations | Only defines method signatures |
| Multiple Usage | Yes | Yes |
| Properties | Can have properties | Constants only |
| Constructor | Can have constructor | No constructor |
| Use Case | Code reuse across classes | Enforcing contracts |

### Composition vs Inheritance

| Feature | Composition | Inheritance |
|---------|-------------|-------------|
| Relationship | "has-a" | "is-a" |
| Flexibility | High (runtime changeable) | Low (compile-time) |
| Coupling | Loose | Tight |
| Use Case | Prefer when relationship is dynamic | Prefer when relationship is permanent |

## 📝 Best Practices

1. **Use Inheritance** when you have a clear "is-a" relationship and want to share code
2. **Use Composition** when you need flexibility and want to change behavior at runtime
3. **Use Interfaces** to define contracts and enforce consistent behavior
4. **Use Traits** for horizontal code reuse when inheritance doesn't fit
5. **Use Abstract Classes** when you need to share code and enforce method implementation
6. **Prefer Composition over Inheritance** for better flexibility and maintainability
7. **Keep Inheritance Hierarchies Shallow** - avoid deep inheritance chains
8. **Use Static Methods** for utility functions that don't require instance state

## 🤝 Contributing

Contributions are welcome! If you'd like to improve examples or add new concepts:

1. Fork the repository
2. Create a feature branch
3. Add your examples with clear comments
4. Submit a pull request

## 📄 License

This repository is for educational purposes. Feel free to use and modify the code examples.

## 🔗 Additional Resources

- [PHP Official Documentation - OOP](https://www.php.net/manual/en/language.oop5.php)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Design Patterns](https://refactoring.guru/design-patterns)

---

**Happy Learning! 🚀**

*This repository is maintained for educational purposes. If you find it helpful, consider giving it a star!*

