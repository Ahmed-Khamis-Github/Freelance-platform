<select name="country" class="form-select" aria-label="Default select example">
    @foreach ($countries as $code => $name )
    <option value="{{ $code }}" @selected($code == $selected)> {{ $name }} </option>

    @endforeach
  </select>