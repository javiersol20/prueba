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
                                <th>SUELDO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salarys as $salary)
                                <tr>
                                    <td>{{ $salary->employee->name_employee }}</td>
                                    <td>{{ $salary->employee->cod_employee }}</td>
                                    <td>
                                        Q. {{ number_format($salary->salary, 2) }}
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
