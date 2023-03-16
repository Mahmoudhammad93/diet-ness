@extends('admin.layouts.app')
<style>
    .parent_id_show{
        display: none
    }
</style>
@section('content')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <form action="{{ aurl('categories/update/'.$category->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="floating-label" for="ar_name">{{ trans('admin.Name Ar') }} <span class="redStar">*</span></label>
                        <input type="text" name="ar_name" class="form-control" id="ar_name" value="{{$category->ar_name}}">
                    </div>

                    <div class="form-group">
                        <label class="floating-label" for="en_name">{{ trans('admin.Name En') }} <span class="redStar">*</span></label>
                        <input type="text" name="en_name" class="form-control" id="en_name" value="{{$category->en_name}}">
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_sub_category" {{($category->parent_id != 0)?'checked':''}}>
                        <label class="form-check-label" for="is_sub_category">Is Subcategory</label>
                    </div>
                    <div class="form-group parent_id_show" id="main_categories">
                        <select name="parent_id" id="parent_id" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-pill btn-outline-primary btn-air-primary"><i class="fas fa-save"></i>&nbsp;{{ trans('admin.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        if($('#is_sub_category')[0].checked == true){
            $.ajax({
                url: "{{route('admin.get.main_categories')}}",
                type: "GET",
                success: function(data){
                    console.log(data);
                    HTML = '';
                    data.forEach(res => {
                        HTML += `
                            <option value="${res.id}">${res.name}</option>
                        `;
                    })
                    $('#parent_id').html('')
                    $('#parent_id').append(HTML)
                    $('#main_categories').removeClass('parent_id_show');
                }
            });
        }else{
            $('#parent_id').html('')
            $('#main_categories').addClass('parent_id_show');
        }
    })

    $(document).on('change', '#is_sub_category', function(e){
        if(e.target.checked == true){
            $.ajax({
                url: "{{route('admin.get.main_categories')}}",
                type: "GET",
                success: function(data){
                    console.log(data);
                    HTML = '';
                    data.forEach(res => {
                        HTML += `
                            <option value="${res.id}">${res.name}</option>
                        `;
                    })
                    $('#parent_id').html('')
                    $('#parent_id').append(HTML)
                    $('#main_categories').removeClass('parent_id_show');
                }
            });
        }else{
            $('#parent_id').html('')
            $('#main_categories').addClass('parent_id_show');
        }
    })
</script>
@endpush
