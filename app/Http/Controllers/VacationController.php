<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Models\Employee;
use App\Models\Vacation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacations = Vacation::with('employee')->get();
        return view("vacation.days", compact('vacations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVacationRequest  $request
     * @return string
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
           'cod_employee' => 'required',
            'days_free' => 'required'
        ]);

        if($validation->fails())
        {
            return "ERROR";
        }else{
            try {
                $date1 = new \Illuminate\Support\Carbon($request->days_free);
                $date2 = new \Illuminate\Support\Carbon();
                $date2->format('Y-m-d');
                $date1->format('Y-m-d');

                $diff = $date1->diffInDays($date2);

                $employee = Employee::where("id", $request->cod_employee)->first();
                Employee::where("id", $employee->id)->update([

                    'days_free_employee' => ($employee->days_free_employee - $diff),
                ]);

                Vacation::create([
                    "employee_id" => $request->cod_employee,
                    "date_max_vacation" => $request->days_free,
                ]);

                return redirect()->route('home');
            }catch (QueryException $exception)
            {
                return $exception->getMessage();
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(Vacation $vacation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacation $vacation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVacationRequest  $request
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVacationRequest $request, Vacation $vacation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacation $vacation)
    {
        //
    }
}
