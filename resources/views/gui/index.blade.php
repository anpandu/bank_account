@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			@if (isset($message))
				<div class="alert alert-danger">
					<strong>Whoops!</strong> {{$message}}
				</div>
			@endif

			@if (count($twitter_accounts)>0)
				<div class="panel panel-default">
					<div class="panel-heading">Twitter Accounts ({{count($twitter_accounts)}} items)</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-bordered">
								<tr>
									<td>ID</td>
									<td>Use Count</td>
									<td>Active</td>
									<td>Image</td>
									<td>Username</td>
									<td>Access Token</td>
									<td>Access Token Secret</td>
									<td></td>
								</tr>
								@foreach ($twitter_accounts as $account)
									<tr>
										<td>{{$account->id}}</td>
										<td>{{$account->use_count}}</td>
										<td><span class="glyphicon glyphicon-{{($account->active) ? 'ok' : 'remove'}}" aria-hidden="true"></span></td>
										<td>
											<a target="_blank" href="{{$account->image}}"><img style="max-height:48px" src="{{$account->image}}"/></a>
										</td>
										<td>
											<a target="_blank" href="http://twitter.com/{{$account->screen_name}}">{{$account->screen_name}}</a>
										</td>
										<td>{{$account->access_token}}</td>
										<td>{{$account->access_token_secret}}</td>
										<td>
											<form method="POST" action="{{url('/account').'/'.$account->id}}">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">
												<a href="#" onclick="$(this).closest('form').submit()">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a>
											</form>
										</td>
									</tr>
								@endforeach 
							</table>
						</div>
					</div>
				</div>
			@endif

			@if (count($facebook_accounts)>0)
				<div class="panel panel-default">
					<div class="panel-heading">Facebook Accounts ({{count($facebook_accounts)}} items)</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-bordered">
								<tr>
									<td>ID</td>
									<td>Use Count</td>
									<td>Active</td>
									<td>Image</td>
									<td>Name</td>
									<td>Access Token</td>
									<td></td>
								</tr>
								@foreach ($facebook_accounts as $account)
									<tr>
										<td>{{$account->id}}</td>
										<td>{{$account->use_count}}</td>
										<td><span class="glyphicon glyphicon-{{($account->active) ? 'ok' : 'remove'}}" aria-hidden="true"></span></td>
										<td>
											<a target="_blank" href="{{$account->image}}"><img style="max-height:48px" src="{{$account->image}}"/></a></td>
										<td>
											<a target="_blank" href="http://facebook.com/{{$account->user_id}}">{{$account->screen_name}}</a>
										</td>
										<td>
											<textarea cols="70" rows="3">{{$account->access_token}}</textarea>
										</td>
										<td>
											<form method="POST" action="{{url('/account').'/'.$account->id}}">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">
												<a href="#" onclick="$(this).closest('form').submit()">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a>
											</form>
										</td>
									</tr>
								@endforeach 
							</table>
						</div>
					</div>
				</div>
			@endif

			@if (count($instagram_accounts)>0)
				<div class="panel panel-default">
					<div class="panel-heading">Instagram Accounts ({{count($instagram_accounts)}} items)</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-bordered">
								<tr>
									<td>ID</td>
									<td>Use Count</td>
									<td>Active</td>
									<td>Image</td>
									<td>Name</td>
									<td>Access Token</td>
									<td></td>
								</tr>
								@foreach ($instagram_accounts as $account)
									<tr>
										<td>{{$account->id}}</td>
										<td>{{$account->use_count}}</td>
										<td><span class="glyphicon glyphicon-{{($account->active) ? 'ok' : 'remove'}}" aria-hidden="true"></span></td>
										<td>
											<a target="_blank" href="{{$account->image}}"><img style="max-height:48px" src="{{$account->image}}"/></a></td>
										<td>
											<a target="_blank" href="http://instagram.com/{{$account->screen_name}}">{{$account->screen_name}}</a>
										</td>
										<td>{{$account->access_token}}</td>
										<td>
											<form method="POST" action="{{url('/account').'/'.$account->id}}">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">
												<a href="#" onclick="$(this).closest('form').submit()">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a>
											</form>
										</td>
									</tr>
								@endforeach 
							</table>
						</div>
					</div>
				</div>
			@endif

			@if (count($googleplus_accounts)>0)
				<div class="panel panel-default">
					<div class="panel-heading">Google+ Accounts ({{count($googleplus_accounts)}} items)</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-bordered">
								<tr>
									<td>ID</td>
									<td>Use Count</td>
									<td>Active</td>
									<td>Image</td>
									<td>Name</td>
									<td>Access Token</td>
									<td></td>
								</tr>
								@foreach ($googleplus_accounts as $account)
									<tr>
										<td>{{$account->id}}</td>
										<td>{{$account->use_count}}</td>
										<td><span class="glyphicon glyphicon-{{($account->active) ? 'ok' : 'remove'}}" aria-hidden="true"></span></td>
										<td>
											<a target="_blank" href="{{$account->image}}"><img style="max-height:48px" src="{{$account->image}}"/></a></td>
										<td>
											<a target="_blank" href="http://plus.google.com/u/0/{{$account->user_id}}">{{$account->screen_name}}</a>
										</td>
										<td>{{$account->access_token}}</td>
										<td>
											<form method="POST" action="{{url('/account').'/'.$account->id}}">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">
												<a href="#" onclick="$(this).closest('form').submit()">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a>
											</form>
										</td>
									</tr>
								@endforeach 
							</table>
						</div>
					</div>
				</div>
			@endif

			@if (count($linkedin_accounts)>0)
				<div class="panel panel-default">
					<div class="panel-heading">LinkedIn Accounts ({{count($linkedin_accounts)}} items)</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-bordered">
								<tr>
									<td>ID</td>
									<td>Use Count</td>
									<td>Active</td>
									<td>Image</td>
									<td>Name</td>
									<td>Access Token</td>
									<td></td>
								</tr>
								@foreach ($linkedin_accounts as $account)
									<tr>
										<td>{{$account->id}}</td>
										<td>{{$account->use_count}}</td>
										<td><span class="glyphicon glyphicon-{{($account->active) ? 'ok' : 'remove'}}" aria-hidden="true"></span></td>
										<td>
											<a target="_blank" href="{{$account->image}}"><img style="max-height:48px" src="{{$account->image}}"/></a></td>
										<td>
											<a target="_blank" href="https://www.linkedin.com/profile/view?id={{$account->user_id}}">{{$account->screen_name}}</a>
										</td>
										<td>{{$account->access_token}}</td>
										<td>
											<form method="POST" action="{{url('/account').'/'.$account->id}}">
												<input name="_method" type="hidden" value="DELETE">
												<input name="_redirect" type="hidden" class="form-control" id="" placeholder="" value="gui">
												<a href="#" onclick="$(this).closest('form').submit()">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a>
											</form>
										</td>
									</tr>
								@endforeach 
							</table>
						</div>
					</div>
				</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">Contoh Penggunaan</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed table-hover table-bordered">
							<tr>
								<td>Use</td>
								<td>
									<a target='_blank' href="{{url('/account')}}/use/1">
										{{url('/account')}}/use/1
									</a>
								</td>
							</tr>
							<tr>
								<td>Cancel</td>
								<td>
									<a target='_blank' href="{{url('/account')}}/cancel/1">
										{{url('/account')}}/cancel/1
									</a>
								</td>
							</tr>
							<tr>
								<td>Fast Use (twitter)</td>
								<td>
									<a target='_blank' href="{{url('/account')}}/fastuse/twitter">
										{{url('/account')}}/fastuse/twitter
									</a>
								</td>
							</tr>
							<tr>
								<td>Fast Use (facebook)</td>
								<td>
									<a target='_blank' href="{{url('/account')}}/fastuse/facebook">
										{{url('/account')}}/fastuse/facebook
									</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
