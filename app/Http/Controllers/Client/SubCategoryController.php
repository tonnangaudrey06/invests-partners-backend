<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
   public function index(){
   		$subcategory = DB::table('subcategories')
		   ->join('categories', 'subcategories.category_id', 'categories.id')
		   ->select('subcategories.*', 'categories.category_en')  
		   ->orderBy('id','desc')->paginate(3);
   		return view('backend.subcategory.index', compact('subcategory'));
   }

   public function addSubCategory(){
   		$category = DB::table('categories')->get();
   		return view('backend.subcategory.create', compact('category'));
   }

   public function storeSubCategory(Request $request){
	 $validated = $request->validate([
		'subcategory_en' => 'required|unique:subcategories|max:255',
		'subcategory_fr' => 'required|unique:subcategories|max:255',
    ]);

	 	$data = array();
	 	$data['subcategory_en'] = $request->subcategory_en;
	 	$data['subcategory_fr'] = $request->subcategory_fr;
	 	$data['category_id'] = $request->category_id;
	 	DB::table('subcategories')->insert($data);

	 	Toastr::success('SubCategory inserted succesfully');

   		return redirect()->route('subcategories');
   }

   public function editSubCategory($id){
   		$subcategory = DB::table('subcategories')->where('id',$id)->first();
		$category = DB::table('categories')->get();
   		return view('backend.subcategory.edit', compact('subcategory', 'category'));
   }

   public function updateSubCategory(Request $request, $id){
	 $validated = $request->validate([
		'subcategory_en' => 'required|max:255',
		'subcategory_fr' => 'required|max:255',
    ]);

	 	$data = array();
	 	$data['subcategory_en'] = $request->subcategory_en;
	 	$data['subcategory_fr'] = $request->subcategory_fr;
	 	$data['category_id'] = $request->category_id;
	 	DB::table('subcategories')->where('id',$id)->update($data);

	 	Toastr::success('SubCategory updated succesfully');

   		return redirect()->route('subcategories');
   }

   public function deleteSubCategory($id){

	 	DB::table('subcategories')->where('id',$id)->delete();

	 	Toastr::success('SubCategory deleted succesfully');

   		return redirect()->route('subcategories');
   }
}
