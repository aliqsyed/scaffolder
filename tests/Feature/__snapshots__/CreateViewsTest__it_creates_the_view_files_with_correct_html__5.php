<?php return '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
<table class="table">
 <th scope="row">Name</th><td>{{ $testuser->name }}</td>
 <th scope="row">My Date</th><td>{{ $testuser->my_date }}</td>
 <th scope="row">Email</th><td>{{ $testuser->email }}</td>
 <th scope="row">Email Verified At</th><td>{{ $testuser->email_verified_at }}</td>
 <th scope="row">Password</th><td>{{ $testuser->password }}</td>
 <th scope="row">Attending</th><td>{{ $testuser->attending }}</td>
 <th scope="row">Description</th><td>{{ $testuser->description }}</td>
 <th scope="row">Votes</th><td>{{ $testuser->votes }}</td>
 <th scope="row">Plan Description</th><td>{{ $testuser->plan_description }}</td>
 <th scope="row">Remember Token</th><td>{{ $testuser->remember_token }}</td>
 
</table>
  
</div>

@endsection';
