<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];



    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }


    public function delete()
    {

        if ($this->id == 1) {
            echo "You can't delete this speshial category(Слющай ти самий умний, да ? нэлзя значыт НЭЛЗЯ!!!!)";
            return false;
        }
        \App\Models\Post::where('category_id',$this->id)->update(['category_id' => 1]);


        return parent::delete(); // TODO: Change the autogenerated stub
    }

}
