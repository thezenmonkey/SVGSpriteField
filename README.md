# SVGSpriteField
This module lets you assign icons to a DataObject using 
[SVG Sprites](https://css-tricks.com/svg-sprites-use-better-icon-fonts/). It can be configured to use a default sprite 
file or a custom sprite file can be on a per-field basis. This module is heavily based on 
[jaedb/IconField](https://github.com/jaedb/IconField) and if you need a solution that used multiple image files for 
icons you should use th one. 

## Requirements
SilverStripe CMS ^4.2
Silverstripe SVG ^2 (for inlining Sprites)

## Installation
```
composer require thezenmonkey/silverstripe-svgspritefield
```

## Configuration
The Sprite field is a subclass of OptionSetField and takes the same parameters with a SVG Sprite File being used as the 
source array.

## Usage
* Set your $db field to type Icon (eg 'Icon' => Sprite::class)
* ```SpriteField::create($name, $title, $iconFolder)```
  * _$name_ is the database field as defined in your class
  * _$title_ is the label for this field
  * _$sourceFile_ (optional) defines SVG Sprite file with Icons.

### Setting Up Sprites
The module will use the ```symbol``` as the value stored in your database. The ```<title>``` provides the Name od the 
Icon.

### Templates 
To use in you theme use the stndard SVG use markup with _$Value_ as the name of your DataBase field
```html
<svg viewBox="0 0 100 100" class="icon">
    <use xlink:href="#{$Value}" />
</svg>
```

Ensure you include the SVG source file somewhere on the page set to display none
```html
{$SVG('mysource.svg').customBasePath('my/base/path').extraClass('myhiddenclass')}
```
Please see [SilverStripe SVG](https://github.com/stevie-mayhew/silverstripe-svg) for correct implementation.

## Acknowledgments
* [jaedb/IconField](https://github.com/jaedb/IconField)
* [CSS Tricks](https://css-tricks.com/svg-sprites-use-better-icon-fonts/)
* [SilverStripe SVG](https://github.com/stevie-mayhew/silverstripe-svg)

## ToDo
* More Configuration Options
* Built-in Template
* Built in inclusion of SpriteFile on page