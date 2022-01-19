<?php

namespace App\Http\Livewire;

use App\Models\Alea;
use App\Models\Ville;
use Livewire\Component;
use App\Models\Catastrophe;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VilleCatastrophesDetail extends Component
{
    use AuthorizesRequests;

    public Ville $ville;
    public Catastrophe $catastrophe;
    public $villeAleas = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Catastrophe';

    protected $rules = [
        'catastrophe.alea_id' => ['required', 'exists:aleas,id'],
        'catastrophe.valeur' => ['required', 'numeric'],
        'catastrophe.url' => ['nullable', 'url'],
    ];

    public function mount(Ville $ville)
    {
        $this->ville = $ville;
        $this->villeAleas = Alea::pluck('nom', 'id');
        $this->resetCatastropheData();
    }

    public function resetCatastropheData()
    {
        $this->catastrophe = new Catastrophe();

        $this->catastrophe->alea_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCatastrophe()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.ville_catastrophes.new_title');
        $this->resetCatastropheData();

        $this->showModal();
    }

    public function editCatastrophe(Catastrophe $catastrophe)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.ville_catastrophes.edit_title');
        $this->catastrophe = $catastrophe;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->catastrophe->ville_id) {
            $this->authorize('create', Catastrophe::class);

            $this->catastrophe->ville_id = $this->ville->id;
        } else {
            $this->authorize('update', $this->catastrophe);
        }

        $this->catastrophe->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Catastrophe::class);

        Catastrophe::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCatastropheData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->ville->catastrophes as $catastrophe) {
            array_push($this->selected, $catastrophe->id);
        }
    }

    public function render()
    {
        return view('livewire.ville-catastrophes-detail', [
            'catastrophes' => $this->ville->catastrophes()->paginate(20),
        ]);
    }
}
