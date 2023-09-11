<?php

namespace App\Http\Controllers;

use App\Http\Services\EmployeeService;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    //
    public function index()
    {
        $listEmployee = $this->employeeService->getAll();
        return view('manager.listEmployee',[
            'title'=>'List Employee',
            'listEmployee'=>$listEmployee
        ]);
    }
    public function search(Request $request){
        $listEmployee = $this->employeeService->search($request);
        $nameSearch = $request->input('nameSearch');
        return view('manager.listEmployee',[
            'title'=>'List Employee',
            'listEmployee'=>$listEmployee,
            'nameSearch'=>$nameSearch
        ]);
    }

    public function addPage()
    {
        return view('manager.addEditEmployee',[
            'title'=>'Add Employee',
        ]);
    }

    public function postadd(Request $request)
    {
        $result = $this->employeeService->add($request);
        if ($result) return redirect('/admin/listEmployee');
        else return redirect()->back();
    }

    public function editPage($idEmployee)
    {
        $employee = Employee::join('user', 'user.idUser', '=', 'employee.idUser')
                                ->where('idEmployee', $idEmployee)
                                ->first();
        return view('manager.addEditEmployee',[
            'title'=>'Edit Employee',
            'employee' => $employee
        ]);
    }

    public function postedit($idEmployee, Request $request)
    {
        $result = $this->employeeService->edit($idEmployee, $request);
        if ($result) return redirect('/admin/listEmployee');
        else return redirect()->back();
    }

    public function delete($idUser)
    {
        $this->employeeService->delete($idUser);
        return redirect()->back();
    }
}
