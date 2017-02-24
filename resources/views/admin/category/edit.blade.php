@extends('layouts.admin')

@section('title') Add category  @endsection

@section('content')
<div class="col-md-9">
  <h2>Categories</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <h2>Edit category</h2>
    {{ Form::open([ 'route' => ['admin.categories.update', 'id' =>  $category['pc_id'] ] , 'method' => 'PUT']) }}
      {{ Form::text('pc_name', $category['pc_name'], ['placeholder' => "Category name*"] ) }}
      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection
