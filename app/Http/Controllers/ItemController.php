<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //Api calls
    public function apiIndex(){
        return Item::orderBy('created_at', 'asc')->get();  //returns values in ascending order
    }

    public function apiShow($id) {
        /**
         * $user = DB::table('users')->where('name', 'John')->first();
         * return $user->email;
         */
        $item = DB::table('items')->where('category_id', $id)->get();
        
        return $item;
        //return Item::findorFail($id); //searches for the object in the database using its id and returns it.
    }
    //End Api calls
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item::oldest()->paginate(10);
        //$cat = Category::all();

        return view('items.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::all();
        return view('items.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max: 1999|required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile("image")) {
            $filenameWithExt = $request->file("image")->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file("image")->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . "_" . time() . "." . $extension;
            // Upload Image
            $path = $request->file("image")->storeAs("public/image", $fileNameToStore);
        }
        // Else add a dummy image
        else {
            $fileNameToStore = "noimage.jpg";
        }

        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->img = $fileNameToStore;
        $item->user_id = auth()->user()->id;
        $item->save();

        return redirect()->route('items.index')
            ->with('success', 'Item guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $cat = Category::all();
        return view('items.edit', compact('item', 'cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max: 1999',
            'category_id' => 'required',
        ]);

        if ($request->hasFile("image")) {
            $filenameWithExt = $request->file("image")->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file("image")->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . "_" . time() . "." . $extension;
            // Upload Image
            $path = $request->file("image")->storeAs("public/image", $fileNameToStore);
        }
        // Else add a dummy image
        else {
            $fileNameToStore = "noimage.jpg";
        }

        //$category = new Category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->img = $fileNameToStore;
        $item->category_id = $request->category_id;
        $item->user_id = auth()->user()->id;
        //$category->save();
        $item->update();

        return redirect()->route('items.index')
            ->with('success', 'Item actulizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item eliminado con exito');
    }
}
