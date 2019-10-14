@if (session()->has('success'))
   <div class="alert alert-success text-center" style="font-weight: 500; margin-top: 5%">{{ session()->get('success') }}</div>
@elseif (session()->has('warning'))
    <div class="alert alert-danger  text-center" style="font-weight: 500; margin-top: 5%">{{ session()->get('warning') }}</div>
@endif

@if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert alert-danger text-center" style="font-weight: 500; margin-top: 5%">{{ $error }}</div>
  @endforeach
@endif