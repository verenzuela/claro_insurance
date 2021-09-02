@extends('layouts.app')
@push('scripts')
    <script>
        document.getElementById('itemsPerPage').onchange = function() {
            window.location = "{!! url()->current() !!}?items=" + this.value;
        };
    </script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>{!! __('labels.audits') !!}</h1>

            <form class="form-inline" method="GET" action="{{url()->current()}}">
                <div class="form-group">
                    <label for="perPage">{!! __('labels.items_per_page') !!}:  </label>
                    <select id="itemsPerPage">
                        <option value="5" @if($items == 5) selected @endif >5</option>
                        <option value="10" @if($items == 10) selected @endif >10</option>
                        <option value="25" @if($items == 25) selected @endif >25</option>
                    </select>
                </div>
            </form>

            <table id="users-data" class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">{{ __('labels.#') }}</th>
                        <th scope="col">{{ __('labels.event') }}</th>
                        <th scope="col">{{ __('labels.tags') }}</th>
                        <th scope="col">{{ __('labels.type') }}</th>
                        <th scope="col">{{ __('labels.user') }}</th>
                        <th scope="col">{{ __('labels.ip') }}</th>
                        <th scope="col">{{ __('labels.createdAt') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audits as $audit)
                        <tr>
                            <td class="align-middle">{{ $audit->id }}</td>
                          <td class="align-middle" style=" color: {{ $audit->getColorAction($audit->event) }} " >{{ $audit->event }}</td>
                          <td class="align-middle">{{ $audit->tags }}</td>
                          <td class="align-middle">{{ $audit->auditable_type }}</td>
                          <td class="align-middle">{{ $audit->getUserName($audit->user_id) }}</td>
                          <td class="align-middle">{{ $audit->ip_address }}</td>
                          <td class="align-middle">{{ $audit->created_at->format('M d, Y h:i:s A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $audits->appends(\Request::except('page'))->render() !!}

        </div>
    </div>
</div>
@endsection