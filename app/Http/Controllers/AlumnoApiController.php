<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlumnoCollection;
use App\Http\Resources\AlumnoResource;
use App\Models\Alumno;
use http\Env\Response;
use Illuminate\Http\Request;

class AlumnoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return new AlumnoCollection($alumnos);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        (int)$id;
        $alumno = Alumno::find($id);
        if ($alumno==null)
            return response()->json([
                'status' => '404',
                'title' => 'Resource Not Found',
                'detail' => 'The requested resource does not exist or could not be found.'
            ]);

        return new AlumnoResource($alumno);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        (int)$id;
        $alumno = Alumno::find($id);
        if ($alumno==null)
            return response()->json([
                'status' => '404',
                'title' => 'Resource Not Found',
                'detail' => 'The requested resource does not exist or could not be found.'
            ]);
        $alumno->delete();
        return response()->noContent();

    }
}
