<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Http\Services\FoodService;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    protected $foodService;
    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }
    //
    public function index()
    {
        if (Auth::check()){
            $user = Auth::user();
        } else{
            $user = null;
        }
        return view('menu.menu',[
            'title'=>'Menu',
            'foods' => $this->foodService->getAll(),
            'user' => $user
        ]);
    }

    public function add()
    {
        return view('menu.addEditFood',[
           'title'=> 'Add Food'
        ]);
    }

    public function postadd(FoodRequest $request)
    {
        $result = $this->foodService->create($request);
        if ($result){
            return redirect('/menu');
        } else{
            return redirect()->back();
        }
    }

    public function edit(Food $food)
    {
        return view('menu.addEditFood',[
            'title'=>'Edit Food',
            'food'=>$food
        ]);
    }

    public function postedit(Food $food, FoodRequest $request)
    {
        $result = $this->foodService->edit($food,$request);
        if ($result){
            return redirect('/menu');
        } else{
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $result = $this->foodService->delete($request);
        return redirect('/menu');
    }
}
