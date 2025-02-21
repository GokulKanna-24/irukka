@extends('layouts.app2')

@section('content')
<div class="container">
    <h2>Edit Shop</h2>
    <form action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $shop->name }}" required>
        </div>

        <div class="form-group">
            <label>Alias</label>
            <input type="text" name="alise_name" class="form-control" value="{{ $shop->alise_name }}" required>
        </div>

        <div class="form-group">
            <label>Address Line 1</label>
            <input type="text" name="adress_line1" class="form-control" value="{{ $shop->details->adress_line1 }}" required>
        </div>

        <div class="form-group">
            <label>Address Line 2</label>
            <input type="text" name="adress_line2" class="form-control" value="{{ $shop->details->adress_line2 }}">
        </div>

        <div class="form-group">
          <label for="owner_id">Select Owner</label>
          <select name="owner_id" class="form-control">
            <option value="">N/A</option>
            @foreach($owners as $owner)
              <option value="{{ $owner->id }}" 
                  {{ old('owner_id', $shop->details->owner_id) == $owner->id ? 'selected' : '' }}>
                {{ $owner->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
            <label>Opening Time</label>
            <input type="time" name="start_time" class="form-control" value="{{ $shop->details->start_time }}">
        </div>

        <div class="form-group">
            <label>Closing Time</label>
            <input type="time" name="end_time" class="form-control" value="{{ $shop->details->end_time }}">
        </div>

        <div class="form-group">
            <label>Banner Image</label>
            <input type="file" name="banner_img" class="form-control">
            @if($shop->details->banner_img)
                <img src="data:image/png;base64,{{ $shop->details->banner_img }}" width="100" />
            @endif
        </div>

        <div class="form-group">
            <label>Logo Image</label>
            <input type="file" name="logo_img" class="form-control">
            @if($shop->details->logo_img)
                <img src="data:image/png;base64,{{ $shop->details->logo_img }}" width="100" />
            @endif
        </div>

        <div class="form-group">
            <label>Shop Image</label>
            <input type="file" name="shop_img" class="form-control">
            @if($shop->details->shop_img)
                <img src="data:image/png;base64,{{ $shop->details->shop_img }}" width="100" />
            @endif
        </div>

        <div class="form-group">
            <label>Is Open</label>
            <select name="is_open" class="form-control">
                <option value="1" {{ $shop->is_open ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$shop->is_open ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label>Is Active</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $shop->is_active ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$shop->is_active ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100 mt-2">Update Shop</button>
    </form>
</div>
@endsection