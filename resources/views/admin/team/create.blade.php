@extends('admin.master')

@section('title', 'Create')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create Team</h1>

<form action="{{route('admin.team.store')}}" method="POST"
  enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="name"> Team Name </label>
    <input type="text" name="name" placeholder="Team Name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <small class="invalid-feedback"> {{$message}} </small>
    @enderror
  </div>

  <div class="mb-3">
    <label for="body"> Team Describtion </label>
    <textarea name="body" placeholder="Team Describtion" value="{{old('body')}}"
      class="form-control @error('body') is-invalid @enderror">

   </textarea>
    @error('body')
    <small class="invalid-feedback"> {{$message}} </small>
    @enderror
  </div>


  <div class="mb-3">
    <label for="image"> Team Image </label>
    <input type="file" onchange="return showImg(event)" name="image"
      class="form-control @error('image') is-invalid @enderror">
    @error('image')
    <small class="invalid-feedback"> {{$message}} </small>
    @enderror
    <img src="" width="100" id="preview">
  </div>

  <div class="mb-3">
    <button class="btn btn-success"> <i class="fas fa-save"></i> Save </button>
  </div>



</form>
@endsection
@section('js')
<script type="text/javascript">
  function showImg(e) {
    const [file] = e.target.files;
    if (file) {
      preview.src = URL.createObjectURL(file);
    }
  }
</script>
@endsection