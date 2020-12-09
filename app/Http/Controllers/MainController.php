<?php

namespace App\Http\Controllers;

use App\Category;
use App\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home(){
        $data = Pay::all()->sortByDesc('time')->sortByDesc('date')->where('date', '>', Carbon::now()->subDays(30));

        $profit = Pay::all()->sortByDesc('date')->where('type','=',true)->sum('money');
        $spend = Pay::all()->sortByDesc('date')->where('type','=',false)->sum('money');
//        $sum = $profit - $spend;

        return view('pages/home',[
            'data' => $data,
            'profit' => $profit,
            'spend' => $spend
        ]);
    }

    public function addCategory(){
        return view('pages/addCategory');
    }

    public function check_category(Request $request){

        $validation = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $category = new Category();
        if(!empty($request)){
            $category->name = $request->input('name');
            $category->type = $request->input('type');
        }
        if($category->save()){
            return back()->with('success','Данные успешно добавлени в базу данных!');
        }

        return redirect()->route('addCategory');

    }

    public function createList(){
        return view('pages/createList');
    }
    public function getSubCat($type){
        echo json_encode(DB::table('categories')->where('type', $type)->get());
    }

    public function check_list(Request $request){
        $validation = $request->validate([
            'type' => 'required',
            'money' => 'required',
            'category' => 'required',
        ]);
//        dd($request->input('date'));
        $list = new Pay();
        date_default_timezone_set('Asia/Tashkent');
        if(!empty($request)){

            $list->type = $request->input('type');
            $list->money = $request->input('money');
            $list->comment = $request->input('comment');
            $list->category_id = $request->input('category');

            if (empty($request->input('date'))){
                $list->date = date('Y-m-d');
            }else{
                $list->date = $request->input('date');
            }

            if (empty($request->input('time'))){
                $list->time = date('H:i');
            }else{
                $list->time = $request->input('time');
            }

            if($list->save()){
                return back()->with('success','Данные успешно добавлени в базу данных!');
            }

        }
        return redirect()->route('createList');
    }

    public function checkFilter(Request $request){

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $profit = Pay::all()->whereBetween('date',[$startDate, $endDate])->where('type','=',true)->sum('money');
        $spend = Pay::all()->whereBetween('date',[$startDate, $endDate])->where('type','=',false)->sum('money');
//        $sum = $profit - $spend;
        $data = Pay::all()->sortByDesc('time')->sortByDesc('date')->whereBetween('date',[$startDate, $endDate])->all();

        return view('pages/home',[
            'data' => $data,
            'profit' => $profit,
            'spend' => $spend
        ]);
    }

}
