<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use App\Models\Category;
use Storage;
use File;


class ProductController extends Controller
{
  public function index(Request $request){

    if ($request->ajax()) {
        $data = Product::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category_id', function($row) {
                    $category = Category::find($row->id);

                    if ($category) {
                        return $category->name;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('name',function($row){
                  return $row->name;
                  })
                ->addColumn('image', function($row) {
                    return '<img src="' . $row->image . '" alt="Image" width="100px" height="100px">'; // Assuming 'image' holds the image URL
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
                       $btn .= '<a href="'. route('admin.product.edit', $row->id) .'" class="edit btn btn-success btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                       $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                        return $btn;
                })
                ->rawColumns(['category_id', 'image','name','status','action'])
                ->make(true);
    }
  
    return view('admin.product.index');
}
    public function addItems()
    {
        $category = Category::get();
        return view('admin.product.add',compact('category'));
    }
    public function storeItems(Request $request)
    {
        // print_r($request->all());
        $request->validate([
          'name'=>'required'
        ]);

        $product = new Product();
        $product->category_id = $request->cat_id;
        $product->name = $request->name;
        $product->small_description = $request->small_description;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->selling_price = $request->selling_price;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->trending = $request->trending == TRUE ? '1':'0';
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;
        $product->image = $this->uploadImage($request->image);
        // $product->save();
        if($product->save()){
          return redirect()->back()->with('success','Product Added Successfully');
        }


    }
    public function uploadImage($file){
      $fileName = time() . $file->getClientOriginalName();
      $filePath = 'images/product/' . $fileName; // Path relative to the storage 'public' disk
      
      Storage::disk('public')->put($filePath, File::get($file));
  
      // Get the URL for the stored file
      // $fileUrl = Storage::disk('public')->url($filePath);
  
      return $fileName; // Return the URL to the uploaded file
  }
  public function editItems($id)
  {
    $category = Category::all();
    $product = Product::where('id',$id)->first();

    return view('admin.product.edit',compact('category','product'));
  }
  public function deleteItems(Request $request){
    $id = $request->id;
    $product = Product::where('id',$id)->first();
    if($product){

      // $existingImage = $product->image;
      // if ($existingImage && file_exists($existingImage)) {
      //   unlink($existingImage);
        $product->delete();
        return response()->json(['status' => 'success', 'message' => 'Product Delete successfully']);

    // }

 }
 return response()->json(['status' => 'error', 'message' => 'Something Went Wrong']);

  }
  public function saveItems(Request $request)
  {
    $request->validate([
      'name'=>'required',
    ]);

    $data = [

      'name'=>$request->name,
      'small_description'=>$request->small_description,
      'description'=>$request->description,
      'tax'=>$request->tax,
      'category_id'=> $request->cat_id,
      'original_price'=>$request->original_price,
      'selling_price'=>$request->selling_price,
      'trending'=>$request->trending,
      'meta_title'=>$request->meta_title,
      'meta_description'=>$request->meta_description,
      'meta_keywords'=>$request->meta_keywords,
   ];

   if(array_key_exists('image',$request->all()) && !empty($request->image)){
    $product = Product::find($request->id);
    if($product){

      $existingImage = $product->image;
      if ($existingImage && file_exists($existingImage)) {
        unlink($existingImage);
    }
}
            $picture_name =$this->uploadImage($request->file('image'));
            $data['image']=$picture_name;
    
        }

        Product::where('id',$request->id)->update($data);
        return redirect()->back()->with('success','Product Saved Successfully');



  }
}
