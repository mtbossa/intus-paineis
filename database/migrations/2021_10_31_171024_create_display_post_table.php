<?php

use App\Models\Display;
use App\Models\Post;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Display::class)->constrained('displays')->onDelete('cascade');
            $table->foreignIdFor(Post::class)->constrained('posts')->onDelete('cascade');
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
        Schema::dropIfExists('display_post');
    }
}
