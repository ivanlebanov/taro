@extends('layouts.admin')

@section('title') Edit company  @endsection

@section('content')
<div class="col-md-9">
  <h2>Companies</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <h2>Edit company</h2>
    <!-- edit company form -->
    {{ Form::open([ 'route' => ['admin.companies.update', 'id' =>  $company['id'] ] , 'method' => 'PUT']) }}
      {{ Form::text('name', $company['c_name'], ['placeholder' => "Company name*"] ) }}
      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
    <!-- end of edit company form -->
  </div>
</div>

@endsection
