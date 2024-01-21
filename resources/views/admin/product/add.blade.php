@extends('admin.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Product</h4>
                    <p class="card-category">Create Product</p>
                </div>
                <div class="card-body">
                    <form name="category-form" method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <!-- <label class="bmd-label-floating">Parent Category</label> -->
                                    <select class="form-control" name="cat_id">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                <input type="checkbox" id="vehicle1" name="trending">
                                <label for="vehicle1">trending</label><br>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Price</label>
                                    <input type="number" name="original_price" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Price</label>
                                    <input type="number" name="selling_price" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Small Description</label>
                                    <div class="form-group bmd-form-group">
                                        <!-- <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label> -->
                                        <textarea name="small_description" class="form-control" rows="5"></textarea>
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
                                        <textarea name="description" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">tax</label>
                                    <input type="text" name="tax" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Qty</label>
                                    <input type="number" name="qty" class="form-control">
                                </div>
                            </div>
</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">meta title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">meta keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                <label for="exampleFormControlFile1">Image</label>
                                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                            </div>
                        </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Description</label>
                            <div class="form-group bmd-form-group">
                                <!-- <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label> -->
                                <textarea class="form-control" name="meta_description" rows="5"></textarea>
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