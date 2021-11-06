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
        $file_info     = $file_object->extractInfo();

        $file_duration = $file_object->getPlaytimeSeconds() * 1000; // Saved as milliseconds
        $type          = (str_contains($file_info['mime_type'], 'video')) ? 'video' : 'image'; 
        $extension     = $file_info['fileformat'];   
        $filename      = self::generateFilename($name, $extension);

        $destination = 'medias/' . Auth::user()->id;

        // TODO criar job para enviar para o s3 após salvar local primeiro e depois excluir local
        
        $path = $file->storeAs($destination, $filename);
        
        $media = Media::create([
            'name'        => $name,
            'description' => $description,
            'duration'    => $file_duration,            
            'type'        => $type,            
            'extension'   => $extension,
            'path'        => $path,
        ]);

        return $media;
    }

    public function update(string $name, string $description, Media $media)
    {   
        $media->name        = $name;
        $media->description = $description;

        $media->save();

        return $media;
    }

    /**
     * Generate filename for media file.
     *
     * @param  string  $media_name Name of the created media
     * @param  string $extension Extension of the file
     * @return string Formatted filename with timestamps
     */
    public static function generateFilename(string $media_name, string $extension)
    {
        $current = Carbon::now()->format('Y-m-d-H-m-s');

        $filename = Str::of($media_name)->slug('-') . '.' . $extension;

        return "{$current}-{$filename}";
    }

}