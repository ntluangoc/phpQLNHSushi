<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Http\Services\TableService;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    protected $tableService;
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }
    //
    public function index()
    {
        $user = Auth::user();
        $listTable = $this->tableService->getAll();
        return view('manager.table',[
            'title'=>'List Table',
            'user' => $user,
            'listTable' => $listTable
        ]);
    }
    public function addTablePage()
    {
        return view('manager.addEditTable',[
            'title'=>'Add Table'
        ]);
    }

    public function postaddTable(TableRequest $request)
    {
        $result = $this->tableService->addTable($request);
        if ($result) return redirect('/admin/listTable');
        else return redirect()->back();
    }

    public function editTablePage(Table $table)
    {
        return view('manager.addEditTable',[
            'title'=>'Add Table',
            'table' => $table
        ]);
    }

    public function posteditTable(Table $table, TableRequest $request)
    {
        $result = $this->tableService->editTable($table, $request);
        if ($result) return redirect('/admin/listTable');
        else return redirect()->back();
    }

    public function deleteTable($idTable)
    {
        $result = $this->tableService->deleteTable($idTable);
        return redirect()->back();
    }
}
