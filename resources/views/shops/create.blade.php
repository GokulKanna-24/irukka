@extends('layouts.app2')
@section('content')

<div class="container" style="top: 5rem; ">
  <h2>Create Shop</h2>
  <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Alias</label>
        <input type="text" name="alise_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Address Line 1</label>
      <input type="text" name="adress_line1" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Address Line 2</label>
      <input type="text" name="adress_line2" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="owner_id">Select Owner</label>
      <select name="owner_id" class="form-control">
        <option value="">N/A</option>
        @foreach ($owners as $owner)
          <option value="{{ $owner->id }}">{{ $owner->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
        <label>Banner Image</label>
        <input type="file" name="banner_img" class="form-control">
    </div>
    <div class="form-group">
        <label>Logo Image</label>
        <input type="file" name="logo_img" class="form-control">
    </div>
    <div class="form-group">
        <label>Shop Image</label>
        <input type="file" name="shop_img" class="form-control">
    </div>
    <button type="submit" class="btn btn-success w-100 mt-2">Save</button>
  </form>
</div>

@endsection