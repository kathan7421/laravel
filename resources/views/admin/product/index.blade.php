@extends('admin.layout.app')
@section('content')
<div class="container">
    <h1>Product <br/> </h1>
    <table class="table table-bordered data-table text-center">
        <thead>
            <tr>
                <th width="50">No</th>
                <th width="100">Name</th>
                <th width="100">Parent Category</th>
                <th width="50">Status</th>
                <th width="50">image</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.product') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            
            {data: 'category_id',name:'category_id'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},

            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
$('body').on('click','.delete',function(){
            var id = $(this).attr('data-id');
            // alert(id);
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{route('admin.product.delete')}}",
                        method:"GET",
                        data:{'id':id,'_token':"{{csrf_token()}}"},
                        success:function(res)
                        {
                            if(res.status=="success")
                            {
                                toastr.success(res.message);
                                $('#userDataTable').DataTable().draw();
                                return true;
                            }
                            else
                            {
                                toastr.error(res.message);
                                return false;
                            }
                        }
                    })
                }
            });
        });
    });
  
</script>
@endpush
