<?php

namespace App\Http\Services;
use App\Models\Food;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodService
{
    public function getAll()
    {
        return Food::where('isActive', 1)->get();
    }

    public function create($request)
    {
        try {
            $user = Auth::user();
            DB::beginTransaction();
            if ($request->hasFile('imgFood')){
                $file = $request->file('imgFood');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();
                if (
                    Food::create([
                        'nameFood' => (string)$request->input('nameFood'),
                        'priceFood' => (float)$request->input('priceFood'),
                        'typeFood' => (string)$request->input('typeFood'),
                        'forPerson' => (integer)$request->input('forPerson'),
                        'amountFood'=> (integer)$request->input('amountFood'),
                        'imgFood'=> $newFileName
                    ])
                ){
                    // Lưu file ảnh mới vào thư mục đích
                    $file->move(public_path('upload/menu'), $newFileName);
                } else{
                    throw new Exception('Failed to create new food!');
                }

            } else{
                Food::create([
                    'nameFood' => (string)$request->input('nameFood'),
                    'priceFood' => (float)$request->input('priceFood'),
                    'typeFood' => (string)$request->input('typeFood'),
                    'forPerson' => (integer)$request->input('forPerson'),
                    'amountFood'=> (integer)$request->input('amountFood'),
                ]);
            }

            DB::commit();
            Session()->flash('success', 'Create food successfully');
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
    public function edit($food, $request){
        try {
            $user = Auth::user();
            DB::beginTransaction();
            $oldFileName = (string)$request->input('oldFileName');
            if ($request->hasFile('imgFood')){
                $file = $request->file('imgFood');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();

                //xóa ảnh cũ
                if ($oldFileName && file_exists(public_path('upload/menu/' . $oldFileName))) {
                    unlink(public_path('upload/menu/' . $oldFileName));
                }

                // Lưu file ảnh mới vào thư mục đích
                $file->move(public_path('upload/menu'), $newFileName);
                $food->imgFood = $newFileName;
            } else{
                $food->imgFood = $oldFileName;
            }
            $food->nameFood = (string)$request->input('nameFood');
            $food->priceFood = (float)$request->input('priceFood');
            $food->typeFood = (string)$request->input('typeFood');
            $food->forPerson = (integer)$request->input('forPerson');
            $food->amountFood = (integer)$request->input('amountFood');
            $food->save();
            DB::commit();
            Session()->flash('success', 'Edit food successfully');
            return true;

        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function delete($request)
    {
        $food = Food::where('idFood', $request->input('idFood'))->first();
        $food->isActive = false;
        if($food->save()){
            Session()->flash('success', 'Delete food successfully');
            return true;
        } else{
            Session()->flash('error', 'Failed to delete food!');
            return false;
        }
    }
}
