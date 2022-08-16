@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('salary.index') }}">Ver saldo empleados</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>CODIGO</th>
                                <th>DIAS FALTANTES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vacations as $vacation)
                            <tr>
                                <td>{{ $vacation->employee->name_employee }}</td>
                                <td>{{ $vacation->employee->cod_employee }}</td>
                                <td>
                                    @php
                                        $date1 = new \Illuminate\Support\Carbon($vacation->date_max_vacation);
                                        $date2 = new \Illuminate\Support\Carbon();
                                        $dateF2  = $date2->format('Y-m-d');
                                        $dateF1  = $date1->format('Y-m-d');

                                        $diff = $date1->diffInDays($date2);
                                        echo $diff." DIAS RESTANTES";
                                    @endphp
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
