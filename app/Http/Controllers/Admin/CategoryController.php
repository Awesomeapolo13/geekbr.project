<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Description;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'title', 'slug', 'description', 'created_at')
            ->with('news')
            ->paginate(7);

        return view('admin.news.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'title' => 'required'
        ]);

        $data = $request->only('title', 'description');
        $data['slug'] = \Str::slug($data['title']);

        $create = Category::create($data);

        if ($create) {
            return redirect()->route('admin.categories.index')->with('success', 'New category added successfully');
        }

        return back()->withInput()->with('errors', 'New category not added');

    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return  view('admin.news.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.news.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $data = $request->only('title', 'description');
        $data['slug'] = \Str::slug($data['title']);

        $update = $category->fill($data)->save();

        if ($update) {
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully ');
        }

        return back()->withInput()->with('errors', 'Category not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
