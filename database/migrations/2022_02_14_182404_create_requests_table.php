<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("RoomId");
            $table->timestamp("start_time");
            $table->timestamp("end_time");
            $table->string("program_title");
            $table->text("description")->nullable();
            $table->string("RecordFormat");
            $table->boolean("Crane");
            $table->integer("CameraAmount");
            $table->integer("CGAmount");
            $table->integer("PrompterAmount");
            $table->integer("VideoWall");
            $table->integer("StudioMonitor");
            $table->integer("WiredMicAmount");
            $table->integer("WirelessMicAmount");
            $table->integer("RadioPAmount");
            $table->integer("RadioMicAmount");
            $table->string("Player");
            $table->string("Listening");
            $table->boolean("SoundProc");
            $table->boolean("PhoneHybrid");
            $table->boolean("Skype");
            $table->boolean("IngestStudio");
            $table->boolean("IngestProd");
            $table->boolean("IngestNews");
            $table->boolean("IngestCinegy");
            $table->boolean("MCR");
            $table->float("TotalSum");
            $table->string("status_code");
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('requests');
    }
};
