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
								<td>social_media</td>
								<td>access_token</td>
								<td>access_token_secret</td>
								<td>use_count</td>
							</tr>
							@foreach ($accounts as $account)
								<tr>
									<td>{{$account->id}}</td>
									<td>{{$account->social_media}}</td>
									<td>{{$account->access_token}}</td>
									<td>{{$account->access_token_secret}}</td>
									<td>{{$account->use_count}}</td>
								</tr>
							@endforeach 
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
