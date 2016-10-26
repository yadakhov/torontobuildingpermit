@extends('_layouts.main')

@section('content')
    <h4>Building Application Status</h4>

    <div class="row">
        <div class="col-md-12">

            <table>
                <tr>
                    <td>Application #</td>
                    <td>{{ $permit->id }}</td>
                </tr>
                <tr>
                    <td>Application</td>
                    <td>{{ $permit->permit_type }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $permit->status }}</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>
                        {{ isset($geocode) ? $geocode->address : '' }}
                    </td>
                </tr>
                <tr>
                    <td>Application Date</td>
                    <td>{{ $permit->application_date }}</td>
                </tr>
                <tr>
                    <td>Issued Date</td>
                    <td>{{ $permit->issued_date }}</td>
                </tr>
                <tr>
                    <td>Completed Date</td>
                    <td>{{ $permit->completed_date }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $permit->description }}</td>
                </tr>
            </table>

        </div>
    </div>
@stop
