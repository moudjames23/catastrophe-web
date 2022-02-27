<?php

namespace App\Exports;

use App\Models\Alerte;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlerteExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $data = DB::table('alertes')
            ->join('agents', 'alertes.agent_id', 'agents.id')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->join('sous_prefectures', 'alertes.sous_prefecture_id', 'sous_prefectures.id')
            ->join('regions', 'villes.region_id', 'regions.id')
            ->join('aleas', 'alertes.alea_id', 'aleas.id')
            ->select('agents.name as agent',
                'regions.nom as region',
                'villes.nom as ville',
                'sous_prefectures.nom as sousprefecture',
                'aleas.nom',
                'alertes.localite',
                'alertes.superficie',
                'alertes.personnes',
                'alertes.mort',
                'alertes.date',
                'alertes.latitude',
                'alertes.longitude'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Agent',
            'Région',
            'Préfecture',
            'Sous-Préfecture',
            'Alea',
            'Localité',
            'Superficie',
            'Personnes',
            'Décédées',
            'Date',
            'Latitude',
            'Longitude',
        ];
    }
}
