<?php
namespace Appmax\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $ProductID
 * @property string $Name
 * @property string $Description
 * @property int $Amount
 * @property float $Price
 * @property string $Sku
 * @property boolean $MethodInsert
 * @property boolean $IsActive
 * @property string $CreatedAt
 * @property string $UpdatedAt
 * @property string $DeletedAt
 */
class Product extends Model
{
    use SoftDeletes;

    const DELETED_AT = "DeletedAt";

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Product';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ProductID';

    /**
     * @var array
     */
    protected $fillable = ['Name', 'Description', 'Amount', 'Price', 'Sku', 'MethodInsert', 'IsActive', 'CreatedAt', 'UpdatedAt', 'DeletedAt'];

    public $timestamps = false;

    protected $dates = ['DeletedAt'];

}
