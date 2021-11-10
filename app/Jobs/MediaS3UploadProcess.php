<?php

namespace App\Jobs;

use App\Models\Media;

use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MediaS3UploadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public UploadedFile $file,
        public Media $media,
        public string $destination,
        public string $filename,        
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = $this->destination . '/' . $this->filename;

        $s3 = Storage::disk('s3');        
        $s3->put($path, file_get_contents($this->file), 'public');

        $this->media->path = $path;
        $this->media->save();
    }
}
