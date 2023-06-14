@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Fabric Type</h2>
        <form method="POST" action="{{ route('admin.fabricTypes.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Fabric Type Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Fabric Type</button>
        </form>
    </div>
@endsection
