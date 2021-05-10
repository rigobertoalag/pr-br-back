<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::oldest()->paginate(10);

        return view('categories.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'image' => 'image|nullable|max: 1999|required'
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

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $fileNameToStore;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max: 1999|required'
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
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $fileNameToStore;
        //$category->save();
        $category->update();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria eliminada con exito');
    }
}
