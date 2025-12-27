<?php

namespace App\Models;
// namespace App\Administration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\SubmissionFactory;

class Submission extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return SubmissionFactory::new();
    }

    protected $fillable = [
        'current_odometer',
        'previous_oil_change_odometer',
        'previous_oil_change_date',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'sqlite';
}
