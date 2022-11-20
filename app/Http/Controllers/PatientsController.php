<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;


class PatientsController extends Controller
{
    # method index - get all resources
    public function index()
    {
        # menggunakan model patients untuk select data
        $patients = Patients::all();

        $data = [
            'message' => 'Get all patients',
            'data' => $patients,
        ];

        # menggunakan response json laravel
        # otomatis set header content type json
        # otomatis mengubah data array ke JSON
        # mengatur status code
        return response()->json($data, 200);
    }

    # menambahkan resource patients
    # membuat method store
    public function store(Request $request)
    {
        # menangkap data request
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ];

        # menggunakan patients untuk insert data
        $patients = Patients::create($input);

        $data = [
            'message' => 'Patients is created successfully',
            'data' => $patients,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    # mendapatkan detail resource patients
    # membuat method show
    public function show($id)
    {
        # cari data patients
        $patients = Patients::find($id);

        if ($patients) {
            $data = [
                'message' => 'Get detail patients',
                'data' => $patients,
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patients not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    # mengupdate resource patients
    # membuat method update
    public function update(Request $request, $id)
    {
        # cari data patients yg ingin diupdate
        $patients = Patients::find($id);

        if ($patients) {
            # mendapatkan data request
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->in_date_at ?? $patients->out_date_at,
            ];

            # mengupdate data
            $patients->update($input);

            $data = [
                'message' => 'Resource patients updated',
                'data' => $patients,
            ];

            # mengirimkan respon json dgn status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patients not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        # cari data patients yg ingin dihapus
        $patients = Patients::find($id);

        if ($patients) {
            # hapus data patients
            $patients->delete();

            $data = [
                'message' => 'Patients is deleted',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patients not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
    # untuk mendapatkan resource berdasarkan name
    # membuat method search 
    public function search($name)
    {
        # search data patients berdasarkan name
        $patients = Patients::where('name', 'LIKE', "%$name%")->get();

        if (count($patients) > 0) {
            $data = [
                'message' => 'Get Detail Searched Resource',
                'data' => $patients
            ];

            #mengembalikan data json status code 200
            return response()->json($data, 200);
        } 
        else {
            $data = [
                'message' => 'Resource not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    # untuk Mendapatkan resource yang positif
    # membuat method positif
    public function positive()
    {
        $patients = Patients::where('status', 'positive')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'message' => 'Get Positive Resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total patients' => $total
            ];
            return response()->json($data, 200);
        }
    }

    # untuk Mendapatkan resource yang sudah recovered (sembuh)
    # membuat method recovered (sembuh)
    public function  recovered()
    {
        $patients = Patients::where('status', 'recovered')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'message' => 'Get Recovered Resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total patients' => $total
            ];
            return response()->json($data, 200);
        }
    }

    # untuk Mendapatkan resource yang dead (meninggal)
    # membuat method dead
    public function dead()
    {
        $patients = Patients::where('status', 'dead')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'message' => 'Get Dead Resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total patients' => $total
            ];
            return response()->json($data, 200);
        }
    }
}