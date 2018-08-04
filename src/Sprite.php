<?php
/**
 * Class: Sprite
 * Summary
 * Description
 * @author: richardrudy
 * @package svgspritefield  * @version:
 */


namespace thezennmonkey\SVGSpriteField;

use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\DB;

class Sprite extends DBField
{
    function requireField() {
        DB::require_field($this->tableName, $this->name, 'Varchar(255)');
    }
}