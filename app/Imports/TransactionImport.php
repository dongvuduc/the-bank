<?php

namespace App\Imports;

use App\Models\TransactionModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;


class TransactionImport implements ToModel,WithHeadingRow,WithBatchInserts,WithChunkReading,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        // format lại định dạng
        $date = date('Y/m/d h:s:i', strtotime(str_replace('/', '-', $row['date'])));

        return new TransactionModel([
            'import_id' => request()->user()->id,
            'date' => $date,
            'content' => $row['content'],
            'amount' => $row['amount'],
            'type' => $row['type'],
        ]);
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date_format:d/m/Y H:s:i',
            'content' => 'required',
            'amount' => 'required|integer',
            'type' => 'required'
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function batchSize(): int
    {
        return 500;
    }

}
