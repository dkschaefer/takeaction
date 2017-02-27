<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Petition;


class PetitionCRUDController extends Controller
{
    // list and sort all petitions that exist in DB
    public function index(Request $request)
    {
        $petitions = Petition::orderBy('id','DESC')->paginate(5);
        return view('PetitionCRUD.index',compact('petitions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // return a 'create' view w/ input forms
    public function create()
    {
        return view('PetitionCRUD.create');
    }

    // take in request, and write the petition to the DB
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $params = $request->all();
        $petition = new Petition($params);
        $petition->user()->associate(Auth::user());
        $petition->save();

        return redirect()->route('petitionCRUD.index')
                        ->with('success','Petition created successfully');
    }

    // list all petitions in the DB
    public function show($id)
    {
        $petition = Petition::find($id);
        return view('PetitionCRUD.show',compact('petition'));
    }

    // return view to edit an existing petition
    public function edit($id)
    {
        $petition = Petition::find($id);
        return view('PetitionCRUD.edit',compact('petition'));
    }

    // update & store changes to an existing petition in the DB
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Petition::find($id)->update($request->all());
        return redirect()->route('petitionCRUD.index')
                        ->with('success','Petition updated successfully');
    }

    // delete a petition / record from the DB
    public function destroy($id)
    {
        Petition::find($id)->delete();
        return redirect()->route('petitionCRUD.index')
                        ->with('success','Petition deleted successfully');
    }
}