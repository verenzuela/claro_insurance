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

            <h1>{!! __('labels.emails') !!}</h1>

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
                        <th scope="col">{{ __('labels.from') }}</th>
                        <th scope="col">{{ __('labels.to') }}</th>
                        <th scope="col">{{ __('labels.cc') }}</th>
                        <th scope="col">{{ __('labels.subject') }}</th>
                        <th scope="col">{{ __('labels.createdAt') }}</th>
                        <th scope="col">{{ __('labels.dateSent') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emails as $email)
                        <tr>

                          <td class="align-middle">
                            @foreach ( json_decode(json_encode($email->from),true) as $key => $value)
                              @if($key == 'address')
                                {{ $value }}
                              @endif
                            @endforeach
                          </td>
                          <td class="align-middle">{{ str_replace('"', '', $email->recipient) }}</td>
                          <td class="align-middle">{{ $email->cc }}</td>
                          <td class="align-middle">{{ $email->subject }}</td>
                          <td class="align-middle">
                            {!! ($email->created_at) ? $email->created_at->format('M d, Y') . "<br>" . $email->created_at->format('  h:i:s A') : '' !!}
                          </td>
                          <td class="align-middle">
                            {!! ($email->sent_at) ? $email->sent_at->format('M d, Y') . "<br>" . $email->sent_at->format('h:i:s A') : __('labels.noSentYet') !!}
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $emails->appends(\Request::except('page'))->render() !!}

        </div>
    </div>
</div>
@endsection