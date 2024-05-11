@php
  use App\Models\Authentication\User as User;
  $propertiesFirst = $audit->first()->properties->first();
  $propertiesSecond = $audit->first()->properties->last();

  $keys = array_keys($propertiesFirst);
@endphp
@extends('components/layouts/layoutMaster')


@section('content')
  <h1>View Audit Log</h1>
  <h4>Date: {{$audit->created_at}}</h4>
  <h4>Causing User: {{User::find($audit->causer_id)->display_name}}</h4>
  <h4>Affected User: {{User::find($audit->subject_id)->display_name}}</h4>
  <h5>Description: {{$audit->description}}</h5>
  <div class="card">
    <h5 class="card-header">Fields Changed</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Field</th>
          <th>Old Value</th>
          <th>New Value</th>
          {{--          @foreach($keys as $key)--}}
          {{--            <th>{{$key}}</th>--}}
          {{--          @endforeach--}}
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">

        @foreach($keys as $key)
          <tr>
            <td>{{$key}}</td>
            <td>{{$propertiesFirst[$key]}}</td>
            <td>{{$propertiesSecond[$key]}}</td>
          </tr>
        @endforeach

        </tbody>
      </table>
    </div>
  </div>
@endsection
