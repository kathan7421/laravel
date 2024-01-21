@extends('admin.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">EDIT Product</h4>
                    <p class="card-category">edit Product</p>
                </div>
                <div class="card-body">
                    <form name="category-form" method="POST" action="{{route('admin.product.save')}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <!-- <label class="bmd-label-floating">Parent Category</label> -->
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <select class="form-control" name="cat_id">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option @if($cat->id == $product->category_id) {{'selected '}} @endif value="
                                            {{$cat->id}} ">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Name</label>
                                    <input type="text" name="name" value="{{$product->name}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <input type="checkbox" id="vehicle1" name="trending" @if($product->trending == '1')
                                    {{'checked'}} @endif value="{{$product->trending}}">
                                    <label for="vehicle1">trending</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Price</label>
                                    <input type="number" name="original_price" value="{{$product->original_price}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Price</label>
                                    <input type="number" name="selling_price" value="{{$product->selling_price}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Small Description</label>
                                    <div class="form-group bmd-form-group">
                                        <!-- <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label> -->
                                        <textarea name="small_description" class="form-control"
                                            rows="5">{{$product->small_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group bmd-form-group">
                                        <!-- <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label> -->
                                        <textarea name="description" class="form-control"
                                            rows="5">{{$product->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">tax</label>
                                    <input type="text" name="tax" value="{{$product->tax}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Qty</label>
                                    <input type="number" name="qty" value="{{$product->qty}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">meta title</label>
                                    <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">meta keywords</label>
                                    <input type="text" name="meta_keywords" value="{{$product->meta_keywords}}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label for="exampleFormControlFile1">Image</label>
                                    <input type="file" name="image" class="form-control-file"
                                        id="exampleFormControlFile1">
                                </div>
                                <div>
                                    <img src="{{$product->image}}" height="100px" widht="100px">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <div class="form-group bmd-form-group">
                                        <!-- <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label> -->
                                        <textarea class="form-control" name="meta_description"
                                            rows="5">{{$product->meta_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>

    </div>
</div>

@endsection