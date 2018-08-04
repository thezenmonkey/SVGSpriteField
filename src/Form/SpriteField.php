<?php
/**
 * Class: SpriteField
 * Summary
 * Description
 * @author: richardrudy
 * @package thezenmonkey\svgspritefield\Form  * @version:
 */


namespace thezenmonkey\SVGSpriteField\Form;


use SilverStripe\Forms\OptionsetField;
use SilverStripe\View\Requirements;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Core\Config;

class SpriteField extends OptionsetField
{

    static $sourceFile;

    /**
     * Construct the field
     *
     * @param string $name
     * @param null|string $title
     * @param string $sourceFile
     **/
    public function __construct($name, $title = null, $sourceFile = null){
        parent::__construct($name, $title, array());

        if (!$sourceFile){
            $sourceFile = Config::inst()->get('SpriteField','default_icons');
        }

        $icons = array();
        $sourcePath = BASE_PATH.$sourceFile;

        self::$sourceFile = $sourceFile;

        if (file_exists($sourcePath)) {
            $svg = simplexml_load_file($sourcePath);
            foreach ($svg->symbol as $symbol) {
                $attributes = $symbol->attributes();

                foreach ($attributes as $k => $v) {
                    if($k == 'id') {
                        $icons[ (string) $v ] = (string) $symbol->title;
                    }
                }

            }
        }

        $this->source = $icons;
        $this->sourceFile = $sourcePath;
        Requirements::css('/resources/vendor/thezenmonkey/silverstripe-svgspritefield/css/SpriteField.css');
    }

    /**
     * Build the field
     *
     * @return HTML
     **/
    public function Field($properties = array()) {
        $source = $this->getSource();
        $options = array();

        // Add a clear option
        $options[] = ArrayData::create(array(
            'ID' => 'none',
            'Name' => $this->name,
            'Value' => '',
            'Title' => '',
            'isChecked' => (!$this->value || $this->value == '')
        ));

        if ($source){
            foreach($source as $value => $title) {
                $itemID = $this->ID() . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $value);
                $options[] = ArrayData::create(array(
                    'ID' => $itemID,
                    'Name' => $this->name,
                    'Value' => $value,
                    'Title' => $title,
                    'isChecked' => $value == $this->value
                ));
            }
        }

        $properties = array_merge($properties, array(
            'Options' => ArrayList::create($options),
            'Source' =>  ltrim(self::$sourceFile, "/")
        ));

        return $this->customise($properties)->renderWith('SpriteField');
    }

    /**
     * Handle extra classes
     **/
    public function extraClass(){
        $classes = array('field', 'SpriteField', parent::extraClass());

        if (($key = array_search("icon", $classes)) !== false) {
            unset($classes[$key]);
        }

        return implode(' ', $classes);
    }

}