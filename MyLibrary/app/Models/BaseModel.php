<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
	public $timestamps = false;
    protected $guarded = ['id'];
    
	public function isExist(array $column)
    {
        return $this->whereExists(function ($query) use ($column) {
            $query->where($column)->take(1);
        })->count() > 0;
    }

    public function keyValues(array $column, array $values)
    {
        $model = $this->where($column)->first($values);

        if ($model) {
            return $model;
        } else {
            return null;
        }
    }

    public function updateValue($index, $id, array $column)
    {
        return $this->where($index, $id)->update($column);
    }
}