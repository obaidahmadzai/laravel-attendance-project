@extends('layouts.admin',['title' => 'Create Teacher'])
@section('body')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title center">
                    Subjects List
                </h4>
                @if ($teachers->count() < 1)
                <p class="red-text center my-5 ">NO Teacher Found</p>
                @else

                    <table>
                        <thead>
                            <tr>
                                <th>#NO</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Last_name</th>
                                <th>Phone_number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i= 1;
                            @endphp
                            @foreach ($teachers as $teacher )
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><div style="width: 70px;height:70px; border-radius:50%; overflow:hidden" class="z-depth-1">
                                    {{-- should add data-src for lazy load --}}
                                    <img data-src="{{ asset('storage/'.$teacher->profile) }}" width="100%" class="lazy">
                                </div></td>
                                <td>{{ $teacher->user->name }}</td>
                                <td>{{ $teacher->last_name }}</td>
                                <td>{{ $teacher->phone_number }}</td>
                                <td>
                                    <div style="display: inline-flex;">
                                        <form  action="{{ route('teacher.destroy',$teacher->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-small btn-floating transparent z-debth ">
                                                <i class="material-icons red-text">delete</i>

                                            </button>
                                        </form>
                                        <a href="{{ route('teacher.edit', $teacher->id) }}"  class="btn btn-small btn-floating transparent z-debth">
                                            <i class="material-icons yellow-text">edit</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                <br>
                @endif
                <a href="{{ route('teacher.create') }}" class="btn waves-effect btn-floating mx-5 my-5 btn-large transparent">
                    <i class="material-icons black-text"> add</i>
                </a>

            </div>
        </div>
    </div>
</div>
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/datatable.min.css') }}">

@endpush
@push('js')
<script src="{{ asset('plugins/datatable/datatable.min.js') }}"></script>

@endpush
<script>
    $(document).ready(function(){
        $('table').dataTable();
    });
</script>
@endsection
