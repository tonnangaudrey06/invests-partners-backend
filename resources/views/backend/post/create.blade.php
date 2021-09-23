@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card corona-gradient-card">
                <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                        <div class="col-4 col-sm-3 col-xl-2">
                            <img src="{{ asset('backend/assets/images/dashboard/Group126@2x.png')}}"
                                class="gradient-corona-img img-fluid" alt="">
                        </div>
                        <div class="col-5 col-sm-7 col-xl-8 p-0">
                            <h4 class="mb-1 mb-sm-0">Welcome to Easy News</h4>

                        </div>
                        <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                            <span>
                                <a href="{{ url('/') }}" target="_blank"
                                    class="btn btn-outline-light btn-rounded get-started-btn">Visit Frontend ?</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New Post Insert</h4>

                <form class="forms-sample" action="{{ route('store.post') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Title English</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="title_en">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Title French</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="title_fr">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Category</label>
                            <select class="form-control" id="exampleSelectGender" name="category_id">
                                <option disabled="" selected="">-- Select Category --</option>
                                @foreach($category as $row)
                                <option value="{{ $row->id }}">{{ $row->category_en}} | {{ $row->category_fr}} </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">SubCategory</label>
                            <select class="form-control" id="subcategory_id" name="subcategory_id">
                                <option disabled="" selected="">-- Select SubCategory --</option>

                            </select>
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">District</label>
                            <select class="form-control" id="exampleSelectGender" name="district_id">
                                <option disabled="" selected="">-- Select District --</option>
                                @foreach($district as $row)
                                <option value="{{ $row->id }}">{{ $row->district_en}} | {{ $row->district_fr}} </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">SubDistrict</label>
                            <select class="form-control" id="subdistrict_id" name="subdistrict_id">
                                <option disabled="" selected="">-- Select SubDistrict --</option>
                            </select>
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">News Image Upload</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Tag English</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="tags_en">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Tag French</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="tags_fr">
                        </div>

                    </div>
                    {{-- End Row --}}

                    <div class="form-group">
                        <label for="exampleTextarea1">Details English</label>
                        <textarea class="form-control" name="details_en" id="summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Details French</label>
                        <textarea class="form-control" name="details_fr" id="summernote1"></textarea>
                    </div>

                    <hr>
                    <h4 class="text-center"> Extra Options</h4> <br>

                    <div class="row">
                        <label class="form-check-label col-md-3">
                            <input type="checkbox" class="form-check-input" value="1" name="headline"> Headline <i
                                class="input-helper"></i></label>

                        <label class="form-check-label col-md-3">
                            <input type="checkbox" class="form-check-input" value="1" name="bigthumbnail"> General Big Thumbnail
                            <i class="input-helper"></i></label>

                        <label class="form-check-label col-md-3">
                            <input type="checkbox" class="form-check-input" value="1" name="first_section"> First Section <i
                                class="input-helper"></i></label>

                        <label class="form-check-label col-md-3">
                            <input type="checkbox" class="form-check-input" value="1" name="first_section_thumbnail"> First
                            Section BigThumbnail <i class="input-helper"></i></label>

                    </div>
                    {{-- End row --}} <br><br>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>


{{-- This is for Category --}}
<script type="text/javascript">
    $(document).ready(function() {
          $('select[name="category_id"]').on('change', function(){
              var category_id = $(this).val();
              if(category_id) {
                  $.ajax({
                      url: "{{  url('/get/subcategory/') }}/"+category_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         $("#subcategory_id").empty();
                               $.each(data,function(key,value){
                                   $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_en+'</option>');
                               });
                        // console.log(data);
                      },
                     
                  });
              } else {
                  alert('danger');
              }
          });
      });
</script>

{{-- This is for District --}}
<script type="text/javascript">
    $(document).ready(function() {
          $('select[name="district_id"]').on('change', function(){
              var district_id = $(this).val();
              if(district_id) {
                  $.ajax({
                      url: "{{  url('/get/subdistrict/') }}/"+district_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         $("#subdistrict_id").empty();
                               $.each(data,function(key,value){
                                   $("#subdistrict_id").append('<option value="'+value.id+'">'+value.subdistrict_en+'</option>');
                               });
                        // console.log(data);
                      },
                     
                  });
              } else {
                  alert('danger');
              }
          });
      });
</script>


@endsection