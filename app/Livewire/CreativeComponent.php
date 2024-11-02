<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Creative;

class CreativeComponent extends Component
{
    public $creatives;
    public $main_asset, $logo, $cta, $url, $position;
    public $updateMode = false;
    public $creative_id;

    public function mount()
    {
        $this->creatives = Creative::all();
    }

    // নতুন Creative তৈরি করা
    public function store()
    {
        $this->validate([
            'main_asset' => 'required',
            'logo' => 'required',
            'cta' => 'required',
            'url' => 'nullable|url',
            'position' => 'required|integer',
        ]);

        Creative::create([
            'main_asset' => $this->main_asset,
            'logo' => $this->logo,
            'cta' => $this->cta,
            'url' => $this->url,
            'position' => $this->position,
        ]);

        $this->resetInputFields();
        $this->creatives = Creative::all(); // তালিকা আপডেট
    }

    public function resetInputFields()
    {
        $this->main_asset = '';
        $this->logo = '';
        $this->cta = '';
        $this->url = '';
        $this->position = '';
    }

    // নির্দিষ্ট Creative তথ্য এডিট করার জন্য লোড করা
    public function edit($id)
    {
        $creative = Creative::findOrFail($id);
        $this->creative_id = $id;
        $this->main_asset = $creative->main_asset;
        $this->logo = $creative->logo;
        $this->cta = $creative->cta;
        $this->url = $creative->url;
        $this->position = $creative->position;
        $this->updateMode = true;
    }

    // তথ্য আপডেট করা
    public function update()
    {
        $this->validate([
            'main_asset' => 'required',
            'logo' => 'required',
            'cta' => 'required',
            'url' => 'nullable|url',
            'position' => 'required|integer',
        ]);

        $creative = Creative::find($this->creative_id);
        $creative->update([
            'main_asset' => $this->main_asset,
            'logo' => $this->logo,
            'cta' => $this->cta,
            'url' => $this->url,
            'position' => $this->position,
        ]);

        $this->updateMode = false;
        $this->resetInputFields();
        $this->creatives = Creative::all(); // তালিকা আপডেট
    }

    public function render()
    {
        return view('livewire.creative-component');
    }
}
