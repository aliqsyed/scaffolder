<?php return '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
<table class="table">
 <th scope="row">Are you coming</th><td>{{ $credential->are_you_coming }}</td>
 <th scope="row">Number of items</th><td>{{ $credential->number_of_items }}</td>
 <th scope="row">Start Date</th><td>{{ $credential->start_date }}</td>
 <th scope="row">End Date</th><td>{{ $credential->end_date }}</td>
 <th scope="row">Tagged At</th><td>{{ $credential->tagged_at }}</td>
 <th scope="row">First Name</th><td>{{ $credential->first_name }}</td>
 <th scope="row">Last Name</th><td>{{ $credential->last_name }}</td>
 <th scope="row">Address</th><td>{{ $credential->address }}</td>
 <th scope="row">City</th><td>{{ $credential->city }}</td>
 <th scope="row">No Type Here</th><td>{{ $credential->no_type_here }}</td>
 <th scope="row">State</th><td>{{ $credential->state }}</td>
 <th scope="row">Zip Code</th><td>{{ $credential->zip_code }}</td>
 <th scope="row">Description</th><td>{{ $credential->description }}</td>
 <th scope="row">Phone</th><td>{{ $credential->phone }}</td>
 <th scope="row">User Test Id</th><td>{{ $credential->user_test_id }}</td>
 <th scope="row">Email</th><td>{{ $credential->email }}</td>
 
</table>
  
</div>

@endsection';
