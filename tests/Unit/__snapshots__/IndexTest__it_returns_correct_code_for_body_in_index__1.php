<?php return '<tbody>
@foreach($credentials as $credential )
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
@endforeach  
</tbody>';
