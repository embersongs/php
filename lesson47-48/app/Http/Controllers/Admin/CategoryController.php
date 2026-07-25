<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->orderByDesc('id')->paginate(10);

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {


        try {
            Category::create($request->validated());

            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно создана!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка при создании категории: ' . $e->getMessage())
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:categories,name'],
        ],
            [
                'name.required' => 'Заголовок обязателен для заполнения',
                'name.string' => 'Заголовок должен быть строкой',
                'name.max' => 'Заголовок не должен превышать 255 символов',
                'name.min' => 'Заголовок должен содержать минимум 3 символа',
                'name.unique' => 'Категория должна быть уникальной',
            ]
        );

        try {
            $category->update($validated);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно изменена!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Произошла ошибка при изменении категории: ' . $e->getMessage())
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            // Удаляем пост
            $categoryName = $category->name;
            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', "Категория \"{$categoryName}\" успешно удален!");

        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Ошибка при удалении категории: ' . $e->getMessage());
        }
    }
}
