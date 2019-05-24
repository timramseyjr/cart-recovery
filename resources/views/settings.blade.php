{!! Form::open(array('url' => 'settings', 'method'=>'POST')) !!}
	<div class="form-group">
		{{Form::label('cart_recovery_first_email_time','Send Email after this many hours')}}
		{{Form::text('cart_recovery_first_email_time',$settings['cart_recovery_first_email_time'] ?? '',['id' => 'cart_recovery_first_email_time', 'class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('cart_recovery_from_email','From Email')}}
		{{Form::text('cart_recovery_from_email',$settings['cart_recovery_from_email'] ?? '',['id' => 'cart_recovery_from_email', 'class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('cart_recovery_from_name','From Name')}}
		{{Form::text('cart_recovery_from_name',$settings['cart_recovery_from_name'] ?? '',['id' => 'cart_recovery_from_name', 'class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('cart_recovery_email_subject','Email Subject')}}
		{{Form::text('cart_recovery_email_subject',$settings['cart_recovery_email_subject'] ?? '',['id' => 'cart_recovery_email_subject', 'class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('cart_recovery_email_template','Email Template')}}
		{{Form::textarea('cart_recovery_email_template',$settings['cart_recovery_email_template'] ?? '',['id' => 'cart_recovery_email_template', 'class' => 'form-control markItUp'])}}
	</div>
	{{Form::submit('Save',['class' => 'btn bg-blue btn-flat'])}}
{!! Form::close() !!}