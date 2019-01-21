<?php
namespace Appmax\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ProductID
 * @property string $Name
 * @property string $Description
 * @property int $Amount
 * @property float $Price
 * @property string $Sku
 * @property boolean $IsActive
 * @property string $CreatedAt
 */
class Product extends Model
{
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
    protected $fillable = ['Name', 'Description', 'Amount', 'Price', 'Sku', 'IsActive', 'CreatedAt'];

    public $timestamps = false;

}
