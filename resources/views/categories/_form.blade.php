<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
        name="name"  value="{{ old('name',$category->name) }}" placeholder="Enter the name">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



<div class="form-group">
    <label for="name">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
        name="slug"  value="{{ old('slug',$category->slug) }}" placeholder="Enter the slug">
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        rows="3" placeholder="Enter the description"  >{{  old('description',$category->description) }}</textarea>
    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


 <label for="parent_id">Parent</label>

<select class="form-select" name="parent_id">
    <option value="">No Parent</option>
    @foreach ($parents as $parent)
        <option value="{{ $parent->id }}"@selected($parent->id == old('parent_id',$category->parent_id))>{{ $parent->name }}</option>
    @endforeach
</select>
@error('parent_id')
    <small class="text-danger">{{ $message }}</small>
@enderror

 

<div class="form-group">
    <label for="art_file">Art_File</label>
    <input type="file" class="form-control " id="art_file" name="art_file">
    @error('art_file')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<button type="submit" class="btn btn-primary mt-3">Submit</button>