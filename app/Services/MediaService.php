<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Media;
use Illuminate\Support\Str;
use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class MediaService 
{
    public function store(UploadedFile $file, string $name, string $description)
    {
        $file_object = new GetId3($file);

        $file_info = $file_object->extractInfo();

        $extension = $file_info['fileformat'];  

        $file_duration = $file_object->getPlaytimeSeconds() * 1000; // Saved as milliseconds

        $type = (str_contains($file_info['mime_type'], 'video')) ? 'video' : 'image';
        
        $filename = $this->generateFilename($name, $extension);

        $destination = 'medias/' . Auth::user()->id;
        
        $path = $file->storeAs($destination, $filename, 's3');
        
        Media::create([
            'name'        => $name,
            'description' => $description,
            'duration'    => $file_duration,            
            'type'        => $type,            
            'extension'   => $extension,
            'path'        => $path,
        ]);
    }

        /**
     * Generate filename for media file.
     *
     * @param  string  $media_name Name of the created media
     * @param  string $extension Extension of the file
     * @return string Formatted filename with timestamps
     */
    public function generateFilename(string $media_name, string $extension)
    {
        $current = Carbon::now()->format('Y_m_d_H_m_s');

        $filename = Str::of($media_name)->slug('-') . '.' . $extension;

        return "{$current}_{$filename}";
    }

}