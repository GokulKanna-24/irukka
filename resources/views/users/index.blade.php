@extends('layouts.app2')
@section('content')
<div class="container" style="top: 5rem; margin-bottom: 5rem;">
  <div class="row d-flex justify-content-between">
    <h2 class="col-4">User List</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary col-4">Add User</a>
  </div>
  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table">
      <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Mobile</th>
          <th>Actions</th>
      </tr>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>{{ $user->mobile }}</td>
        <td>
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
  </table>
</div>

@include('layouts.partials.bottombar')
@endsection