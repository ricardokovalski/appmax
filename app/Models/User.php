<?php
namespace Appmax\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $UserID
 * @property string $Name
 * @property string $Email
 * @property string $Password
 * @property string $RememberToken
 * @property boolean $IsActive
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'User';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'UserID';

    /**
     * @var array
     */
    protected $fillable = ['Name', 'Email', 'Password', 'IsActive'];

    protected $hidden = [
        'RememberToken',
    ];

    public $timestamps = false;
}
