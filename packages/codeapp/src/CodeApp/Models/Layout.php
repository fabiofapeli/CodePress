<?php
namespace CodePress\CodeApp\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{

    protected $table = "codepress_layouts" ;


    protected $fillable = [
    'name','dirname'
    ];


}