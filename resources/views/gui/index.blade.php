@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Show All Accounts ({{count($accounts)}} items)</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed table-hover table-bordered">
							<tr>
								<td>ID</td>
								<td>use_count</td>
								<td>social_media</td>
								<td>access_token</td>
								<td>access_token_secret</td>
								<td></td>
							</tr>
							@foreach ($accounts as $account)
								<tr>
									<td>{{$account->id}}</td>
									<td>{{$account->use_count}}</td>
									<td>{{$account->social_media}}</td>
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
			<div class="panel panel-default">
				<div class="panel-heading">Contoh Penggunaan</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed table-hover table-bordered">
							<tr>
								<td>Use</td>
								<td>bankaccount.dev/account/use/1</td>
							</tr>
							<tr>
								<td>Cancel</td>
								<td>bankaccount.dev/account/cancel/1</td>
							</tr>
							<tr>
								<td>Fast Use</td>
								<td>bankaccount.dev/account/fastuse</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
