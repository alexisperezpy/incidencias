<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|min:5'
        ] );

        Category::create($request->all());
        return back();

    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);

        $categoria_id = $request->input('categoria_id');
        $category = Category::find($categoria_id);
        $category->name=$request->input('name');
        $category->save();

        return back();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back();
    }
}
