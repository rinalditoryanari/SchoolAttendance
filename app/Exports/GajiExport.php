<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GajiExport implements FromView
{

    protected $data;

    function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('contents.admin.gaji.export-excel', [
            'title' => 'Penggajian',
            'tahuns' => $this->data['tahuns'],
            'user' => $this->data['user'],
            'data' => $this->data['data'],
            'tanggal' => $this->data['tanggal'],
            'input' => $this->data['input'],
        ]);
    }
}
