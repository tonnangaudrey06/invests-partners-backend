<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
	public function index()
	{
		$category = DB::table('categories')->orderBy('id', 'desc')->paginate(5);
		return view('backend.category.index', compact('category'));
	}

	public function addCategory()
	{
		return view('backend.category.create');
	}

	public function storeCategory(Request $request)
	{
		$validated = $request->validate([
			'category_en' => 'required|unique:categories|max:255',
			'category_fr' => 'required|unique:categories|max:255',
		]);

		$data = array();
		$data['category_en'] = $request->category_en;
		$data['category_fr'] = $request->category_fr;
		DB::table('categories')->insert($data);

		Toastr::success('Category inserted succesfully');

		return redirect()->route('categories');
	}

	public function editCategory($id)
	{
		$category = DB::table('categories')->where('id', $id)->first();
		return view('backend.category.edit', compact('category'));
	}

	public function updateCategory(Request $request, $id)
	{
		$validated = $request->validate([
			'category_en' => 'required|unique:categories|max:255',
			'category_fr' => 'required|unique:categories|max:255',
		]);

		$data = array();
		$data['category_en'] = $request->category_en;
		$data['category_fr'] = $request->category_fr;
		DB::table('categories')->where('id', $id)->update($data);

		Toastr::success('Category updated succesfully');

		return redirect()->route('categories');
	}

	public function deleteCategory($id)
	{

		DB::table('categories')->where('id', $id)->delete();

		Toastr::success('Category deleted succesfully');

		return redirect()->route('categories');
	}
}
