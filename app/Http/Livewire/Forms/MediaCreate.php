<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\MediaService;
use Livewire\Redirector;

class MediaCreate extends Component
{
    use WithFileUploads;

    public $media;
    public $name;
    public $description;

    protected $rules = [
        'name'        => 'required|min:6|max:50',
        'description' => 'required|min:6|max:100',
        'media'       => 'required|mimes:avi,mp4,jpg,jpeg,png|max:102400',
    ];

    public function render()
    {
        return view('livewire.forms.media-create');
    }

    public function updatedMedia()
    {
        $this->validate([
            'media' => 'mimes:avi,mp4,jpg,jpeg,png|max:102400', // 100MB Max
        ]);
    }

    public function storeMedia(MediaService $media_service): Redirector
    {
        $this->validate();

        if(!$this->media->isValid()) {
            return redirect()->back();
        }

        $media = $media_service->store($this->media, $this->name, $this->description);

        return redirect()->route('medias.index');
    }
}
