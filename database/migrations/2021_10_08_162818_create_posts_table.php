<?php

use App\Models\Media;
use App\Models\Recurrence;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();   
            $table->integer('duration');         
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignIdFor(Media::class)->constrained('medias');
            $table->foreignIdFor(Recurrence::class)->nullable()->constrained('recurrences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
