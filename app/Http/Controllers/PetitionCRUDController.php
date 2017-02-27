<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Petition;


class PetitionCRUDController extends Controller
{

    public function index(Request $request)
    {
        $petitions = Petition::orderBy('id','DESC')->paginate(5);
        return view('PetitionCRUD.index',compact('petitions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

 
    public function create()
    {
        return view('PetitionCRUD.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $params = $request->all();
        //$params['user_id'] = Auth::id();

        $petition = new Petition($params);
        $petition->user()->associate(Auth::user());
        $petition->save();

        return redirect()->route('petitionCRUD.index')
                        ->with('success','Petition created successfully');
    }

    public function show($id)
    {
        $petition = Petition::find($id);
        return view('PetitionCRUD.show',compact('petition'));
    }

    public function edit($id)
    {
        $petition = Petition::find($id);
        return view('PetitionCRUD.edit',compact('petition'));
    }

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

    public function destroy($id)
    {
        Petition::find($id)->delete();
        return redirect()->route('petitionCRUD.index')
                        ->with('success','Petition deleted successfully');
    }
}