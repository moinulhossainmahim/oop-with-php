<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class Model extends BaseModel
{
  use HasFactory;
  use HasUlids;
  use SoftDeletes;
}


// Now in any model can use that like
class Test extends Model {
  // Now it's doing
  //SoftDeletes → adds deleted_at column behavior

  // HasFactory → enables Test::factory()

  // HasUlids → automatically generates ULIDs on creation

  // All methods from Eloquent’s Model (like save(), belongsTo(), etc.)
}
