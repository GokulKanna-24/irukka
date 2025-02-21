@extends('layouts.app2')
@section('content')
<div class="container" style="top: 5rem; ">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="number" name="mobile" class="form-control" value="{{ $user->mobile }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (Leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2">Update</button>
    </form>
</div>
@endsection