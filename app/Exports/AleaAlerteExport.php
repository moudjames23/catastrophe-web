<?php

namespace App\Exports;

use App\Models\Alea;
use App\Models\Alerte;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AleaAlerteExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    private $id;
    private $alea;

    /**
     * AleaAlerteExport constructor.
     * @param $alea
     */
    public function __construct($id)
    {

        $this->alea = Alea::findOrFail($id);


    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::table('alertes')
            ->join('agents', 'alertes.agent_id', 'agents.id')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->where('alertes.alea_id', $this->alea->id)
            ->select('agents.name as agent',
                'villes.nom',
                'alertes.localite',
                'alertes.superficie',
                'alertes.personnes',
                'alertes.mort',
                'alertes.date',
                'alertes.latitude',
                'alertes.longitude'
            )
            ->get();

        return $data;
    }


    public function headings(): array
    {
        return [
            'Agent',
            'Ville',
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
