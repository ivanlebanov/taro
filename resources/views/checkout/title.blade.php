<div class="row">
  <div class="container">
    <div class="col-md-8">
      <h1>Checkout</h1>
    </div>
    <div class="col-md-4">
      {{ Form::open(['route' => 'checkout.post']) }}
        <button type="submit" class="btn red-btn big-btn procced-btn" name="button">Place order</button>
      {{ Form::close() }}
    </div>
  </div>
</div>
