<?php return '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
<table>
<thead>
<tr>
  <th>Name</th><th>My Date</th><th>Email</th><th>Email Verified At</th><th>Password</th><th>Attending</th><th>Description</th><th>Votes</th><th>Plan Description</th><th>Remember Token</th>
</tr>
</thead>
<tbody>
@foreach($testusers as $testuser )
  <tr>
   <td>{{ $testuser->name }}</td>
 <td>{{ $testuser->my_date }}</td>
 <td>{{ $testuser->email }}</td>
 <td>{{ $testuser->email_verified_at }}</td>
 <td>{{ $testuser->password }}</td>
 <td>{{ $testuser->attending }}</td>
 <td>{{ $testuser->description }}</td>
 <td>{{ $testuser->votes }}</td>
 <td>{{ $testuser->plan_description }}</td>
 <td>{{ $testuser->remember_token }}</td>

</tr>
@endforeach  
</tbody>
</table>
</div>

@endsection';
