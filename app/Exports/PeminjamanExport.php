<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'ID' => $item->id,
                'Tanggal' => $item->tanggal_kegiatan,
                'Waktu Mulai' => $item->waktu_mulai,
                'Waktu Selesai' => $item->waktu_selesai,
                'Ruangan' => $item->room->nama ?? '-',
                'Peminjam' => $item->nama_peminjam,
                'Organisasi' => $item->nama_ormawa,
                'Nama Kegiatan' => $item->nama_kegiatan,
                'No WhatsApp' => $item->nomor_Whatsapp,
                'Keterangan' => $item->keterangan,
                'Status' => $item->status,
                'Pas Foto' => $item->pas_foto ? asset('storage/' . $item->pas_foto) : '-',
                'File Tambahan' => $item->file_tambahan ? asset('storage/' . $item->file_tambahan) : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Waktu Mulai',
            'Waktu Selesai',
            'Ruangan',
            'Peminjam',
            'Organisasi',
            'Nama Kegiatan',
            'No WhatsApp',
            'Keterangan',
            'Status',
            'Pas Foto',
            'File Tambahan',
        ];
    }
}
