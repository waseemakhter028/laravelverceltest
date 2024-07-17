<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use DB;

class Category extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public static function getFrontSubCategory($id)
    {
        $row = DB::table('sub_categories')->where('category_id',$id)->select('name','id')->orderBy('name','ASC')->get();
        $subcat_ids = [];
        foreach($row  as $cat):
            $subcat = DB::table('codes')->where('sub_category_id',$cat->id)->first();
            if(!empty($subcat))
            {
                array_push($subcat_ids,$cat->id);
            }
        endforeach;    

        $data  =DB::table('sub_categories')->whereIn('id',$subcat_ids)->where('status',1)->select('name','id')->orderBy('name','ASC')->get();
   
        return $data;
    }
}
