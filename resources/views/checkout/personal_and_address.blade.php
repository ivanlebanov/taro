<div class="col-sm-6">
  <div class="panel">
    <!-- user address update -->
    {{ Form::open(['route' => 'profile.update', 'method' => 'PUT' ]) }}
      <h2>Personal info and adress</h2>


        <!-- listing all fields -->
        @foreach($user as $key => $field)
          @if($key == "town_city")
            <div class="col-md-6">
              {{ Form::text($key, $field, ['placeholder' => ucfirst(str_replace('_', ' ', $key)) . "*"]) }}
            </div>
          @elseif($key == "country")
          <div class="col-md-6">
            <div class="select-style">
              {{ Form::select($key, get_countries(),  $field, ['placeholder' => ucfirst(str_replace('_', ' ', $key)) . "*"]) }}
            </div>
          </div>
          @elseif($key == "postcode")
            <div class="input-row">
              <div class="col-md-6">
                {{ Form::text($key, $field, ['placeholder' => ucfirst(str_replace('_', ' ', $key)) . "*"]) }}
              </div>
            </div>
          @else
            {{ Form::text($key, $field, ['placeholder' => ucfirst(str_replace('_', ' ', $key)) . "*"]) }}
          @endif
        @endforeach
        <!-- end of listing all fields -->

        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
      {!! Form::close() !!}
      <!-- end of user address update -->
  </div>
</div>
