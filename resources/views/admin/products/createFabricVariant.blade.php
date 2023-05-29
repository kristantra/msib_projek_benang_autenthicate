@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Fabric Variant</h2>
        <form method="POST" action="{{ route('admin.fabricVariants.store') }}">
            @csrf
            <div class="form-group">
                <label for="fabric-type">Fabric Type</label>
                <select class="form-control" id="fabric-type" name="fabric_type_id" required>
                    @foreach($fabricTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Variant Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Fabric Variant</button>
        </form>
    </div>
@endsection
