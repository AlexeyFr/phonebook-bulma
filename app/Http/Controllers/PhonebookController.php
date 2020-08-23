<?php

namespace App\Http\Controllers;

use App\Phonebook;

use Illuminate\Http\Request;

use App\Http\Requests\PhonebookRequest;

use Exception;

class PhonebookController extends Controller
{

    public function index()
    {
        return view('phonebook');
    }

    public function getData()
    {
        return Phonebook::orderBy('name','ASC')->get();
    }

    public function store(PhonebookRequest $request)
    {

        try{
            $phonebook = new Phonebook;
            $phonebook->name = $request->name;
            $phonebook->phone = $request->phone;
            $phonebook->email = $request->email;
            $phonebook->description = $request->description;
            $phonebook->save();
            return $phonebook;
        }
        catch(Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }

    public function update(PhonebookRequest $request)
    {
        try{
            $phonebook = Phonebook::findOrFail($request->id);
            $phonebook->name = $request->name;
            $phonebook->phone = $request->phone;
            $phonebook->email = $request->email;
            $phonebook->description = $request->description;
            $phonebook->update();
        }
        catch(Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try{
            $phonebook = Phonebook::findOrFail($id);
            $phonebook->delete($id);
        }
        catch(Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 404);
        }
    }

}