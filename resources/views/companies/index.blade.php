@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    <a href="{{ route('companies.create')}}" class="btn btn-primary">Add New Company</a>
                    <br/><br/>
                   <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Domain</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->domain }}</td>
                                    <td>
                                        <a href="{{ route('companies.edit', $company->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        <form style="display: inline-block" action="{{ route('companies.destroy', $company->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="4">No companies</td>
                            @endforelse
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
