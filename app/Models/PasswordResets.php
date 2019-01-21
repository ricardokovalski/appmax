<?php
namespace Appmax\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $Email
 * @property string $Token
 * @property string $CreatedAt
 */
class PasswordResets extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'PasswordResets';

    /**
     * @var array
     */
    protected $fillable = ['Email', 'Token', 'CreatedAt'];

    public $timestamps = false;

}
