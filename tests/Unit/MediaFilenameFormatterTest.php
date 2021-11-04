<?php

namespace Tests\Unit;

use App\Services\MediaService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class MediaFilenameFormatterTest extends TestCase
{
    /** @test */
public function check_if_media_filename_is_being_formatted()
    {
        $media_name      = 'Nome da midia deve ficar assim 23';
        $media_extension = 'png';

        $current = Carbon::now()->format('Y_m_d_H_m_s');

        $media_service = new MediaService();

        $media_filename = $media_service->generateFilename($media_name, $media_extension);

        $current = Carbon::now()->format('Y_m_d_H_m_s');

        $this->assertEquals("{$current}_nome-da-midia-deve-ficar-assim-23.png", $media_filename);
    }
}
