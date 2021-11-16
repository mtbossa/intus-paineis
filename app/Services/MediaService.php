<?php

namespace App\Services;

use App\Jobs\MediaS3UploadProcess;
use Carbon\Carbon;
use App\Models\Media;
use Illuminate\Support\Str;
use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaService 
{
    public function store(UploadedFile $file, string $media_name, string $description): Media
    {
        $file_object = new GetId3($file);
        $file_info     = $file_object->extractInfo();

        $file_duration = $file_object->getPlaytimeSeconds() * 1000; // Saved as milliseconds
        $type          = (str_contains($file_info['mime_type'], 'video')) ? 'video' : 'image'; 
        $extension     = $file_info['fileformat'];   
        $filename      = self::generateFilename($media_name, $extension);

        $destination = 'medias/' . Auth::user()->id;
        $tmp_folder  = 'tmp/' . Auth::user()->id;

        $tmp_path = $file->storeAs(
            $tmp_folder,
            $filename,
            'local'
        );

        $media = Media::create([
            'name'        => $media_name,
            'description' => $description,
            'duration'    => $file_duration,            
            'type'        => $type,            
            'extension'   => $extension,
        ]);
     
        MediaS3UploadProcess::dispatch(
            tmp_path: $tmp_path,
            destination: $destination,
            filename: $filename,
            media: $media
        );

        return $media;
    }

    public function update(string $media_name, string $description, Media $media): Media
    {   
        $media->name        = $media_name;
        $media->description = $description;

        $media->save();

        return $media;
    }

    public function delete(Media $media): void
    {
        Storage::delete($media->path);

        $media->delete();        
    }

    /**
     * Generate filename for media file.
     *
     * @param  string $media_name Name of the created media
     * @param  string $extension Extension of the file
     * @return string Formatted filename with timestamps
     */
    public static function generateFilename(string $media_name, string $extension): string
    {
        $current = Carbon::now()->format('Y-m-d-H-m-s');

        $filename = Str::of($media_name)->slug('-') . '.' . $extension;

        return "{$current}-{$filename}";
    }

}