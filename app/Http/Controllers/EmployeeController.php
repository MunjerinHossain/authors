<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller{

    function addEmployee(Request $request){
        $listData = $request->all(); 
        $result = ["Result" => "Data was not successfully been saved"];
        foreach($listData as $empData){
            $emp = new Employee();
            $emp->name =$empData['name'];      
            $emp->id = $empData['id'];         
            $emp->compId = $empData['compId'];
            $resp = $emp->save();
            if( $resp){
                $result = ["Result" => "Data was not successfully saved"];
                break;
            }
        }

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'compId' => 'required',
        ]);

     
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);

         return response()->json($result, 201);

    }

}