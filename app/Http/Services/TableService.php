<?php

namespace App\Http\Services;

use App\Models\Table;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableService
{
    public function getAll()
    {
        return Table::where('isActive', 1)->get();
    }

    public function addTable($request)
    {
        try {
            $user = Auth::user();
            DB::beginTransaction();
            if ($request->hasFile('imgTable')){
                $file = $request->file('imgTable');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();
                if (
                    Table::create([
                        'typeTable' => (string)$request->input('typeTable'),
                        'amountTable' => (integer)$request->input('amountTable'),
                        'imgTable'=> $newFileName
                    ])
                ){
                    // Lưu file ảnh mới vào thư mục đích
                    $file->move(public_path('upload/table'), $newFileName);
                } else{
                    throw new Exception('Failed to create new food!');
                }

            } else{
                Table::create([
                    'typeTable' => (string)$request->input('typeTable'),
                    'amountTable' => (integer)$request->input('amountTable')
                ]);
            }

            DB::commit();
            Session()->flash('success', "Create new table successfully");
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function editTable($table, $request)
    {
        try {
            $user = Auth::user();
            DB::beginTransaction();
            $oldFileName = (string)$request->input('oldFileName');
            if ($request->hasFile('imgTable')){
                $file = $request->file('imgTable');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();

                //xóa ảnh cũ
                if ($oldFileName && file_exists(public_path('upload/table/' . $oldFileName))) {
                    unlink(public_path('upload/table/' . $oldFileName));
                }

                // Lưu file ảnh mới vào thư mục đích
                $file->move(public_path('upload/table'), $newFileName);
                $table->imgTable = $newFileName;
            } else{
                $table->imgTable = $oldFileName;
            }
            $table->typeTable = (string)$request->input('typeTable');
            $table->amountTable = (float)$request->input('amountTable');
            $table->save();
            DB::commit();
            Session()->flash('success', 'Edit table successfully');
            return true;

        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function deleteTable($idTable)
    {
        try {
            DB::beginTransaction();
            $table = Table::find($idTable);
            $table->isActive = false;
            $table->save();
            DB::commit();
            Session()->flash('success', "Delete table successfully");
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
