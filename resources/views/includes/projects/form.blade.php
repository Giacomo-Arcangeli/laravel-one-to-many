@if ($project->exists)
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
@endif
@csrf

<div class="row">

    {{-- Title --}}
    <div class="col-8">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text"
                class="form-control @error('title') is-invalid @elseif(old('title')) is-valid @enderror"
                id="title" name="title" placeholder="Title..." value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Type --}}
    <div class="col-4">
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type_id"
                @error('type_id') is-invalid @elseif(old('type_id')) is-valid @enderror>
                <option value="">Undefined</option>
                @foreach ($types as $type)
                    <option @if (old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Cover --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="image" class="form-label">Cover</label>
            <input type="file"
                class="form-control @error('cover') is-invalid @elseif(old('cover')) is-valid @enderror"
                id="cover" name="cover">
            @error('cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Description --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @elseif(old('description')) is-valid @enderror"
                name="description" id="description" rows="15">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12 text-end mt-3">
        <button class="btn btn-success" type="submit">Save</button>
    </div>

</div>
</form>
