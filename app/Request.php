<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $RoomId
 * @property string $start_time
 * @property string $end_time
 * @property string $program_title
 * @property string $description
 * @property string $RecordFormat
 * @property boolean $Crane
 * @property int $CameraAmount
 * @property int $CGAmount
 * @property int $PrompterAmount
 * @property int $VideoWall
 * @property int $StudioMonitor
 * @property int $WiredMicAmount
 * @property int $WirelessMicAmount
 * @property int $RadioPAmount
 * @property int $RadioMicAmount
 * @property string $Player
 * @property string $Listening
 * @property boolean $SoundProc
 * @property boolean $PhoneHybrid
 * @property boolean $Skype
 * @property boolean $IngestStudio
 * @property boolean $IngestProd
 * @property boolean $IngestNews
 * @property boolean $IngestCinegy
 * @property boolean $MCR
 * @property float $TotalSum
 * @property string $status_code
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Request extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'RoomId', 'start_time', 'end_time', 'program_title', 'description', 'RecordFormat', 'Crane', 'CameraAmount', 'CGAmount', 'PrompterAmount', 'VideoWall', 'StudioMonitor', 'WiredMicAmount', 'WirelessMicAmount', 'RadioPAmount', 'RadioMicAmount', 'Player', 'Listening', 'SoundProc', 'PhoneHybrid', 'Skype', 'IngestStudio', 'IngestProd', 'IngestNews', 'IngestCinegy', 'MCR', 'TotalSum', 'status_code', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
