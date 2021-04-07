<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\TransactionImport;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class APIController extends Controller
{

    public function import(ImportRequest $request)
    {
        $file = $request->file('import_file');


        try {
            Excel::import(new TransactionImport(), $request->file('import_file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
            return ['error' => $failures];
        }

//        $extension = $file->getClientOriginalExtension();
//        $filename = time() . '.' . $extension;
//        $file->move('import_file', $filename);

        return ['message' => 'Import Success'];
    }
}
