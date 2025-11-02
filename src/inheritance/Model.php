<?php

class Model {
  protected $table;
  protected $fillable = [];
  protected $attributes = [];

  public function __construct(array $data) {
      $this->fill($data);
  }

  protected function fill(array $data) {
      foreach ($data as $key => $value) {
          if (in_array($key, $this->fillable)) {
              $this->attributes[$key] = $value;
          }
      }
  }

  public function show() {
      var_dump($this->attributes);
  }

  public function save() {
      echo "Saving to table: {$this->table}\n";
  }
}

class User extends Model {
  protected $table = 'users';
  protected $fillable = ['name'];
}

$user = new User(['name' => 'Moinul Hossain', 'age' => 29]);
$user->save();
$user->show(); // Only show name because age is not in fillable
