<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Code;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
        $allcat  = Category::where('status',1)->select('id')->get();
        $category_ids  = [];
        foreach($allcat  as $cat):
            $subcat = SubCategory::where('category_id',$cat->id)->where('status',1)->first();
            if(!empty($subcat))
            {
                $codecheck = Code::where('sub_category_id',$subcat->id)->where('status',1)->first();
                if(!empty($codecheck))
                {
                    array_push($category_ids,$cat->id);
                }

            }
        endforeach;

        $category  = Category::whereIn('id',$category_ids)->where('status',1)->select('id','name')->get()->sortBy('name');

        $codes = Code::where('status',1)->orderBy('id','DESC')->get();

        return view('user.code')->withcategory($category)->withcodes($codes);
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('viewcode/{id}', [HomeController::class, 'viewCode']);
Route::post('filtercodes', [HomeController::class, 'filtercodes']);
