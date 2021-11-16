<?php

namespace App\Jobs;

use App\Models\Media;

use Illuminate\Http\File;
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
        public string $tmp_path,
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
        $this->tmp_path = Storage::disk('local')->path($this->tmp_path);

        $path = "{$this->destination}/{$this->filename}";

        $path_s3 = Storage::putFileAs($this->destination, new File($this->tmp_path), $this->filename, 'public');

        $this->media->path = $path;
        $this->media->save();

        $local->delete($this->tmp_path);
    }
}
