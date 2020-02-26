<?php return '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
<table>
<thead>
<tr>
  <th>Are you coming</th><th>Number of items</th><th>Start Date</th><th>End Date</th><th>Tagged At</th><th>First Name</th><th>Last Name</th><th>Address</th><th>City</th><th>No Type Here</th><th>State</th><th>Zip Code</th><th>Description</th><th>Phone</th><th>User Test Id</th><th>Email</th>
</tr>
</thead>
<tbody>
  <tr>
   <td>{{ $credential->are_you_coming }}</td>
 <td>{{ $credential->number_of_items }}</td>
 <td>{{ $credential->start_date }}</td>
 <td>{{ $credential->end_date }}</td>
 <td>{{ $credential->tagged_at }}</td>
 <td>{{ $credential->first_name }}</td>
 <td>{{ $credential->last_name }}</td>
 <td>{{ $credential->address }}</td>
 <td>{{ $credential->city }}</td>
 <td>{{ $credential->no_type_here }}</td>
 <td>{{ $credential->state }}</td>
 <td>{{ $credential->zip_code }}</td>
 <td>{{ $credential->description }}</td>
 <td>{{ $credential->phone }}</td>
 <td>{{ $credential->user_test_id }}</td>
 <td>{{ $credential->email }}</td>

</tr>
</tbody>
</table>
</div>

@endsection';
