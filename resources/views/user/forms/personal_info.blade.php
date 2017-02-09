<div class="col-sm-6">
  <div class="panel">

    {{ Form::open(['route' => 'profile.update_personal_info' ]) }}
      <h2>Personal info</h2>
      {{ Form::token() }}

      @foreach($personal as $key => $field)
        {{ Form::text($key, $field, ['placeholder' => ucfirst($key) . "*"]) }}
      @endforeach

      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}

    {{ Form::close() }}
  </div>
</div>
