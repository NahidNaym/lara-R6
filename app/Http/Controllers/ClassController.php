<?php

namespace App\Http\Controllers;

use App\Models\Cclass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Cclass::get();

        return view('classes', compact('classes')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add-class');  //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cclass::create([
            // 'k' => 'v'



       
            'className' => $request->className,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'isFulled' => isset($request->isFulled),
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            'updated_at' => $request->updated_at,
        ]);

        return "Data added successfully"; //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = Cclass::findOrFail($id);
return view('show', compact('class'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $class = Cclass::findOrFail($id);
        return view('edit-class', compact('class'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        $data = [
            
            'className' => $request->className,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'isFulled' => isset($request->isFulled),
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            'updated_at' => $request->updated_at
        ] ;

        Cclass::where('id', $id)->update($data);

        return "data updated successfully";
    }

    public function showDeleted() {
        $classes =  Cclass::onlyTrashed()->get();

        return view('trashedClasses', compact('classes'));
    }

    public function restore(string $id) {
        Cclass::where('id', $id)->restore();
        return redirect()->route('classes.showDeleted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request )
    {

        $id = $request->id;
Cclass::where('id', $id)->delete();
return "deleted";
        //
    }
}
