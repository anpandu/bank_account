@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create New Account</div>
				<div class="panel-body">
					<form method="POST" action="{{url('/account')}}" class="form-horizontal" id="form_user">

						<div class="form-group">
							<label for="input_user_id" class="col-sm-3 control-label">User ID</label>
							<div class="col-sm-9">
								<input name="user_id" type="text" class="form-control" id="input_user_id" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_screen_name" class="col-sm-3 control-label">Screen Name</label>
							<div class="col-sm-9">
								<input name="screen_name" type="text" class="form-control" id="input_screen_name" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_consumer_key" class="col-sm-3 control-label">Consumer Key</label>
							<div class="col-sm-9">
								<input name="consumer_key" type="text" class="form-control" id="input_consumer_key" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_consumer_secret" class="col-sm-3 control-label">Consumer Secret</label>
							<div class="col-sm-9">
								<input name="consumer_secret" type="text" class="form-control" id="input_consumer_secret" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_access_token" class="col-sm-3 control-label">Access Token</label>
							<div class="col-sm-9">
								<input name="access_token" type="text" class="form-control" id="input_access_token" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_access_token_secret" class="col-sm-3 control-label">Access Token Secret</label>
							<div class="col-sm-9">
								<input name="access_token_secret" type="text" class="form-control" id="input_access_token_secret" placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label for="input_social_media" class="col-sm-3 control-label">Social Media</label>
							<div class="col-sm-9">
								 <select name="social_media" class="form-control">
									<option value="twitter">twitter</option>
									<option value="facebook">facebook</option>
								</select> 
							</div>
						</div>

						<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-primary">ADD</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
