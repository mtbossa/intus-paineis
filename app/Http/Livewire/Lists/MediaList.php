<?php

namespace App\Http\Livewire\Lists;

use App\Models\Media;
use Livewire\Component;
use App\Services\MediaService;

class MediaList extends Component
{   
    public bool $showDeleteModal = false;
    public int $mediaIdToBeDeleted;

    public function render()
    {
        return view('livewire.lists.media-list', [
            'medias' => Media::all(),
        ]);
    }

    public function showDeleteModal(int $media_id)
    {
        $this->showDeleteModal = true;
        $this->mediaIdToBeDeleted = $media_id;
    }

    public function deleteMedia(MediaService $media_service)
    {
        $media = Media::findOrFail($this->mediaIdToBeDeleted);
        $media_service->delete($media);

        session()->flash('sucess', __('messages.media_deleted'));

        $this->showDeleteModal = false;
    }
}
