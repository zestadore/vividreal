<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $guarded=[];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($model)
        {
            if($model->logo!=null){
                $d=unlink(public_path('uploads/logos/'. $model->logo));
            }
            $model->logo = Null;
            $model->save();
        });
    }
}
