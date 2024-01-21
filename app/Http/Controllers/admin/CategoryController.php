<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use Str;
use Storage;
use File;

class CategoryController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row) {
                        $category = Category::find($row->id);

                        if ($category) {
                            return $category->name;
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('image', function($row) {
                        return '<img src="' . $row->image . '" alt="Image" width="100px" height="100px">'; // Assuming 'image' holds the image URL
                    })
                    ->addColumn('parent_id',function($row){
                        $parent= Category::select('name')->where('id',$row->parent_id)->first();
                            if(isset($parent->name))
                            {
                                return $parent->name;
                            }
                            return "-";
                        })
                   
                    ->addColumn('status',function($row){
                        $checked = ($row->status =='0') ? 'checked' : '';
                        $status = '<label class="switch">
                        <input type="checkbox" class="toggle-class" data-status="status" data-id="'.$row->id.'" '.$checked.'>
                        <span class="slider round"></span>
                      </label>';
                      return $status;
                    })
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'. route('admin.category.edit', $row->id) .'" class="edit btn btn-success btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['name', 'image','parent_id','status','action'])
                    ->make(true);
        }
      
        return view('admin.category.index');
    }
    public function addItems(){

        $category = Category::where('parent_id',0)->get();
        // $category = Category::get();

        
            return view('admin.category.add',compact('category'));
        


    }
    public function storeItems(Request $request){

        $request->validate([
            'name'=>'required',
            'image'=>'required',
        ]);
        $slug = Str::slug($request->input('name'));
        if(isset($request->parent_id)){
            $parent_id = $request->parent_id;
        }
        else{
            $parent_id = 0;
        }        
        $category = Category::create([
			'name'=>$request->name,
			'slug'=>$slug,
			'parent_id'=>$parent_id,
			'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
			'image'=>$this->uploadImage($request->image),
		]);
        if($category)
        {
            return redirect()->back()->with('success','Category Added Successfully');
        }
        // return redirect()->back()->with('errors','Something Went Wrong');


    }
    
    public function deleteItems(Request $request){
        $id = $request->id;
        $category = Category::where('id',$id)->first();
        if($category){
            $category->delete();
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
        }
        return response()->json(['status'=> 'error' ,'message'=>'Something Went Wrong']);

    }
    // public function uploadImage($file){
	// 	$fileName   = time() . $file->getClientOriginalName();
	// 	Storage::disk('public')->put('images/category' . $fileName, File::get($file));
	// 	$file_name  = $file->getClientOriginalName();
	// 	$file_type  = $file->getClientOriginalExtension();
	// 	$filePath   =  $fileName;
	// 	return $filePath;
	// }
    public function uploadImage($file){
        $fileName = time() . $file->getClientOriginalName();
        $filePath = 'images/category/' . $fileName; // Path relative to the storage 'public' disk
        
        Storage::disk('public')->put($filePath, File::get($file));
    
        // Get the URL for the stored file
        // $fileUrl = Storage::disk('public')->url($filePath);
    
        return $fileName    ; // Return the URL to the uploaded file
    }
    public function changeStatus(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        $newStatus = $category->status === '0' ? '1' : '0';
        $category->status = $newStatus;
        $category->save();
      
        if($category){
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Something Went Wrong']);

       
    }
    public function editItems($id){
        // $category = Category::where('id',$id)->first();
        // $categories = Category::whereNull('parent_id')->get();
        $categories = Category::where('parent_id',0)->get();
        
        // echo "<pre>";
        // print_r($categories);die;
        $category = Category::where('id',$id)->first();
        // echo "<pre>";
        // print_r($category);die;
        if($category){
            return view('admin.category.edit',compact('category','categories'));
        }
       return redirect()->back()->with('error','something went wrong');

    }
    public function saveItems(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
        $slug = Str::slug($request->input('name'));
        if(isset($request->parent_id)){
            $parent_id = $request->parent_id;
        }else{
            $parent_id = 0;
        }
         $data = [

            'name'=>$request->name,
			'slug'=>$slug,
			'parent_id'=>$parent_id,
			'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'meta_keywords'=>$request->meta_keywords,
         ];

            if(array_key_exists('image',$request->all()) && !empty($request->image)){
                $category = Category::find($request->id); // Retrieve existing category by ID
              if ($category) {
        // Store the existing image path before updating
        $existingImage = $category->image;

        // Delete existing image if it exists
        if ($existingImage && file_exists($existingImage)) {
            unlink($existingImage);
        }
    }
                $picture_name =$this->uploadImage($request->file('image'));
                $data['image']=$picture_name;
        
            }

            Category::where('id',$request->id)->update($data);
            return redirect()->back()->with('success','Category Saved Successfully');

        

    }
}