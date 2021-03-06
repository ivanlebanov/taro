<div class="col-sm-6">
  <div class="panel">
    {{ Form::open(['route' => 'profile.update_personal_info' ]) }}
      <h2>Personal info</h2>
      {{ Form::token() }}

      <!-- listing all fields -->
      @foreach($personal as $key => $field)
        {{ Form::text($key, $field, ['placeholder' => ucfirst($key) . "*"]) }}
      @endforeach
      <!-- end of listing all fields -->

      {{ Form::submit('Save personal info', ['class' => 'btn red-btn']) }}

    {{ Form::close() }}
  </div>
</div>
