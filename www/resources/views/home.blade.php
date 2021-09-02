@extends('layouts.app')
@push('scripts')
    <script>
        document.getElementById('itemsPerPage').onchange = function() {
            window.location = "{!! url()->current() !!}?items=" + this.value;
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-Token' : $("input[name=_token]").val()
                }
            });

            $('#users-data').Tabledit({
                url:'{{ route('users-data.action') }}',
                dataType:"json",
                columns:{
                    identifier:[0, 'id'],
                    editable:[
                        [1, '<?= __('labels.name') ?>'],
                        [4, '<?= __('labels.phone_number') ?>'],
                        [5, '<?= __('labels.date_of_birth') ?>']
                    ]
                },
                onDraw: function() {

                    $('table tr td:nth-child(6) input').each(function() {
                        var $j = jQuery.noConflict();
                        $j(this).datepicker({
                            format: 'dd/mm/yyyy',
                            endDate: '+0d',
                            todayHighlight: true,
                            autoclose: true
                        });
                    });
                },
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-default',
                        html: 'Edit',
                        action: 'edit'
                    },
                    delete: {
                        class: 'btn btn-sm btn-default',
                        html: 'Delete',
                        action: 'delete'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: 'Save'
                    },
                    restore: {
                        class: 'btn btn-sm btn-warning',
                        html: 'Restore',
                        action: 'restore'
                    },
                    confirm: {
                        class: 'btn btn-sm btn-danger',
                        html: 'Confirm'
                    }
                },
                restoreButton:false,
                onFail: function(jqXHR, textStatus, errorThrown) {
                    if(data.message){
                        alert(data.message);
                        return;
                    }
                    alert(textStatus);
                },
                onSuccess:function(data, textStatus, jqXHR)
                {   
                    if(data.message){
                        alert(data.message);
                        return;
                    }

                    if(data.action === 'delete'){   
                        let $=jQuery.noConflict();
                        $('#'+data.id).remove();
                    }
                }
            });
        });
    </script>

@endpush


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>{!! __('labels.users') !!}</h1>

            @if(auth()->user()->is_admin)
            <h2><a href="{{ route('create.user') }}">{!! __('labels.create_user') !!}</a></h2>
            
            <div class="my-2">
                <form method="POST" action="{{ route('search.by.text') }}">
                    @csrf
                    <div class="form-row align-items-center">
                        
                        @if(!$searchText)
                            <div class="col-4">
                                <input type="text" class="form-control" id="searchText" name="searchText" value="{{ old('searchText') }}" placeholder="Search by name, document id, email or phone">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </div>
                        @else
                            <span>Filter apply: </span>
                            <span class="badge badge-secondary mx-2">{!! $searchText !!}</span> 
                            <span><a href="{{ route('home') }}">Delete filter</a></span>
                        @endif
                        
                            
                    </div>
                </form>
            </div>
            @endif

            <form class="form-inline my-2" method="GET" action="{{url()->current()}}">
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
                        <th scope="col">@sortablelink('id', __('labels.id'))</th>
                        <th scope="col">@sortablelink('name', __('labels.name'))</th>
                        <th scope="col">@sortablelink('name', __('labels.id_card'))</th>
                        <th scope="col">@sortablelink('name', __('labels.email'))</th>
                        <th scope="col">@sortablelink('name', __('labels.cellphone'))</th>
                        <th scope="col">@sortablelink('name', __('labels.date_of_birth'))</th>
                        <th scope="col">{!! __('labels.age') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->num_docm_identity }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->date_of_birth->format('d/m/Y') }}</td>
                            <td>{{ $user->getAge() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $users->appends(\Request::except('page'))->render() !!}

        </div>
    </div>
</div>
@endsection
