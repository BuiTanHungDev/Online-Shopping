@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
    {{Session::get('success')}}
    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
  </div>


@elseif (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
    {{Session::get('error')}}
    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
  </div>
   
@endif
