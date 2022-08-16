@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('vacation.index') }}">bitacora de dias pendientes</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route('vacation.store') }}" method="POST">
                            @csrf
                            <select class="form-control" name="cod_employee" id="cod_employee">
                                <option value="">SELECCIONE EL CODIGO DE EMPLEADO</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->cod_employee }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="">Nombre</label>
                            <input class="form-control" readonly style="cursor: not-allowed" placeholder="NOMBRE" type="text" name="name_employee" id="name_employee" /><br>
                            <label for="">Departamento</label>
                            <input class="form-control" readonly style="cursor: not-allowed" placeholder="DEPARTAMENTO" type="text" name="department_employee" id="department_employee" /><br>
                            <label for="">Dias libres</label>
                            <input class="form-control" readonly style="cursor: not-allowed" placeholder="DIAS VACACIONES"  type="text" name="days_free_employee" id="days_free_employee" /><br>
                            <br>
                            <input type="date" name="days_free" id="days_free" class="form-control" min="{{ date('Y-m-d') }}" >
                            <button type="submit" class="btn btn-outline-success">Guardar </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        // Función que suma o resta días a la fecha indicada

        sumaFecha = function(d, fecha)
        {
            var Fecha = new Date();
            var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
            var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
            var aFecha = sFecha.split(sep);
            var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
            fecha= new Date(fecha);
            fecha.setDate(fecha.getDate()+parseInt(d));
            var anno=fecha.getFullYear();
            var mes= fecha.getMonth()+1;
            var dia= fecha.getDate();
            mes = (mes < 10) ? ("0" + mes) : mes;
            dia = (dia < 10) ? ("0" + dia) : dia;
            var fechaFinal = dia+sep+mes+sep+anno;
            return (fechaFinal);
        }
        let $cod_employee;
        $(document).ready(function (){
            $cod_employee = $("#cod_employee");
            $cod_employee.change(() => {
                const employee = $cod_employee.val();
                const url = `/api/show/${employee}`;
                $.getJSON(url, function (response) {



                    var fecha = sumaFecha(response.days_free_employee,'{{ date('d-m-Y') }}');
                    var newDateFormar = (fecha.split("-").reverse().join("-"));


                    $("#name_employee").val(response.name_employee);
                    $("#department_employee").val(response.department_employee);
                    $("#days_free_employee").val(response.days_free_employee + " DIAS DE VACACIONES");
                    $("#days_free").attr({
                        "max": `${newDateFormar}`
                    })
                })
            })
        })
    </script>
@endsection
