@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <br>
            <div class="pull-left">
                <h2>Manajemen Proyek</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg" style="border: 1px solid #dee2e6 background-color: #fff important;">
        <tr>
            <th>No</th>
            <th>Nama Proyek</th>
            <th>Pemberi Kerja</th>
            <th>Vendor</th>
            <th>PIC</th>
            <th>Nilai Kontrak</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th width="80px">Action</th>
        </tr>
        @foreach ($projects as $project)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->owner }}</td>
                <td>{{ $project->vendor }}</td>
                <td>{{ $project->pic }}</td>
                <td>Rp. {{ number_format($project->cost, 0, ',', '.') }}</td>
                <td>
                    @if ($project->start_date)
                        {{ date_format(date_create($project->start_date), 'j F Y') }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($project->end_date)
                        {{ date_format(date_create($project->end_date), 'j F Y') }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                        <a href="{{ route('projects.edit', $project->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $projects->links() !!}

@endsection
