<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
class EmployeeController extends Controller
{

    // function addEmployee(Request $request){
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'name' => 'required',
    //         'compId' => 'required',
    //     ]);


    //     $listData = $request->all(); 

    //     // foreach($listData as $empData){
    //     //     // $emp = new Employee();
    //     //     // $emp->name =$empData['name'];      
    //     //     // $emp->id = $empData['id'];         
    //     //     // $emp->compId = $empData['compId'];

    //     //     $this->validate($request, [
    //     //         'id' => $empData['id'],
    //     //         'name' => $empData['name'],
    //     //         'compId' => $empData['compId']
    //     //     ]);

    //     //     $resp = $emp->save();
    //     //     if( $resp){
    //     //         $result = ["Result" => "Data was not successfully saved"];
    //     //         break;
    //     //     }
    //     // }     
    //     return response()->json($listData, 201);








    // }

    function addEmployee(Request $req){
        /*$result = ["Result" => "Data was  successfully saved"];
        return $result;*/

        $emp = new Employee();
        $emp->name =$req->name;      //data in $req comes from postman during test of api
        $emp->id = $req->id;         //data in $req comes from postman during test of api
        $emp->compId = $req->compId; //data in $req comes from postman during test of api
        $resp = $emp->save();
        $result = ["Result" => "Data was not successfully been saved"];
        if( $resp){
            $result = ["Result" => "Data was  successfully saved"];
        }
        return $result;
    }

    function addEmployees(Request $req)
    {
        $listData = $req->all(); //data in $req comes from postman during test of api
        //return ["data 1" => $listData[0]['name']];
        $result = ["Result" => "Data was not successfully been saved"];
        foreach ($listData as $empData) {
            $emp = new Employee();
            $emp->name = $empData['name'];
            $emp->id = $empData['id'];
            $emp->compId = $empData['compId'];
            $resp = $emp->save();
            if ($resp) {
                $result = ["Result" => "Data was not successfully saved"];
                break;
            }
        }
        return $result;
    }

    function updateEmployee(Request $req)
    {
        $emp = Employee::find($req->id);
        $emp->name = $req->name;      //data in $req comes from postman during test of api
        $emp->compId = $req->compId; //data in $req comes from postman during test of api
        $resp = $emp->save();
        $result = ["Result" => "Data was not successfully updated"];
        if ($resp) {
            $result = ["Result" => "Data was  successfully updated"];
        }
        return $result;
    }

    function deleteEmployee($id)
    {
        /*
        $result = ["Result" => "Data was  successfully deleted"];
        return $result;
        */

        $emp = Employee::find($id);

        $resp = $emp->delete();
        $result = ["Result" => "Data was not successfully deleted"];
        if ($resp) {
            $result = ["Result" => "Data was  successfully deleted"];
        }
        return $result;

    }

    function searchEmployee($name){
        //Only for search by name:
        // return Employee::where("name", $name)->get();

        return Employee::where("name", "like", "%".$name."%")->get();
    }

    function validatedDataPost(Request $req){
        
        $rules = array(
            "id" => "required|min:1|max:4"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return   response()->json($validator->errors(),401);
        }else{

            return  $this->addEmployee($req);
        }
    }

}