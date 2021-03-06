# Post Type Fields for Lumberjack

[![Latest Stable Version](https://poser.pugx.org/iceagency/lumberjack-posttypes-acf-fields/v/stable)](https://packagist.org/packages/iceagency/lumberjack-posttypes-acf-fields)
[![Coverage Status](https://coveralls.io/repos/github/ICEAgency/lumberjack-posttypes-acf-fields/badge.svg?branch=master)](https://coveralls.io/github/ICEAgency/lumberjack-posttypes-acf-fields?branch=master)
[![Total Downloads](https://poser.pugx.org/iceagency/lumberjack-posttypes-acf-fields/downloads)](https://packagist.org/packages/iceagency/lumberjack-posttypes-acf-fields)
[![License](https://poser.pugx.org/iceagency/lumberjack-posttypes-acf-fields/license)](https://packagist.org/packages/iceagency/lumberjack-posttypes-acf-fields)

A Service Provider for the [Lumberjack](https://github.com/Rareloop/lumberjack) framework that allows you to define fields for your custom post types.

Written & maintained by the team at [The ICE Agency](https://www.theiceagency.co.uk)

Please note, this repo is not ready for production.

## Roadmap

1. Add support for repeater fields
2. Add support for all field types that ACF offers
3. Update documentation

## Requirements

* PHP >=7.0
* Installation via Composer
* [Lumberjack](https://github.com/Rareloop/lumberjack)
* [Advanced Custom Fields Pro](https://wordpress.org/plugins/advanced-custom-fields/)

## Installing

1. Install Lumberjack, see the guide [here](https://github.com/Rareloop/lumberjack).
2. Install via Composer:
```composer require iceagency/lumberjack-posttypes-acf-fields```
3. Add the provider within ```web/app/themes/lumberjack/config/app.php```

    ```
    'providers' => [
        ...
        IceAgency\Lumberjack\Providers\PostTypeFieldsServiceProvider::class,
        ...
    ]
    ```

## Getting Started

1. Register your Post Type within ```web/app/themes/lumberjack/app/config/posttypes.php```

    ```
    'register' => [
        ...
        App\PostTypes\YourPostType::class,
        ...
    ]
    ```

2. Create your Post Type class within ```web/app/themes/lumberjack/app/PostTypes/YourPostType.php```
3. Add the ```HasACFFields``` interface to your Post Type

    ```
    use IceAgency\Lumberjack\Interfaces\HasAcfFields;

    class YourPostType extends Post implements HasAcfFields
    {
        ...
    }
    ```

4. For each field type you need to use, ensure that you include the relevent classes at the top of your Post Type class, for this example:

    ```
    use IceAgency\Lumberjack\AcfFields\TextField;
    use IceAgency\Lumberjack\AcfFields\TextAreaField;
    ```

5. Add a static method to define your field configuration, as follows:

    ```
    public static function getFieldConfig() : array
    {
        return [
            TextField::create('text_field_name')
                ->withLabel('Text Field Label')
                ->isRequired(),
            TextAreaField::create('textarea_field_name')
                ->withLabel('Textarea Field Label')
        ]
   }
   ```

## Field Types

* Text: ``` IceAgency\Lumberjack\AcfFields\TextField ```
* Text Area: ``` IceAgency\Lumberjack\AcfFields\TextField ```
* Image: ``` IceAgency\Lumberjack\AcfFields\ImageField ```
* True/False: ``` IceAgency\Lumberjack\AcfFields\BoolField ```
* Checkbox: ``` IceAgency\Lumberjack\AcfFields\CheckboxField ```
* Email: ``` IceAgency\Lumberjack\AcfFields\EmailField ```
* File: ``` IceAgency\Lumberjack\AcfFields\FileField ```
* Number: ``` IceAgency\Lumberjack\AcfFields\NumberField ```
* Page Link: ``` IceAgency\Lumberjack\AcfFields\PageLinkField ```
* Password: ``` IceAgency\Lumberjack\AcfFields\PasswordField ```
* Post Object: ``` IceAgency\Lumberjack\AcfFields\PostObjectField ```
* Radio: ``` IceAgency\Lumberjack\AcfFields\RadioField ```
* Select: ``` IceAgency\Lumberjack\AcfFields\SelectField ```
* URL: ``` IceAgency\Lumberjack\AcfFields\UrlField ```
* User: ``` IceAgency\Lumberjack\AcfFields\UserField ```
* WYSIWYG: ``` IceAgency\Lumberjack\AcfFields\WysiwygField ```


## Generic Field Methods

**create($name)**

Create a field with the name given, this is the name that is used to retrieve the data with ACF's get_field() function

**withLabel($label)**

Set the label for the field within the WordPress Admin area.

**isRequired()**

Make the field required.

**withInstructions($instructions)**

Add instructions for the field.

**withDefaultValue($default_value)**

Add a default value to the field.

**withPlaceholder($placeholder)**

Used to set the placeholder for the field within the WordPress Admin area. (Please note, this is only possible on Text, TextArea, Number, Email, URL and Password)


## Individual Field Methods

### Text

**withMaxLength($max_length)**

Set maximum length of text (accepts integer).

**isReadOnly()**

Set field as read-only.

**isDisabled()**

Set field as disabled.


### TextArea

**withMaxLength($max_length)**

Set maximum length of text (accepts integer).

**isReadOnly()**

Set field as read-only.

**isDisabled()**

Set field as disabled.


### Image

**withMinWidth($min_width)**

Set minimum width in pixels (accepts integer)

**withMinHeight($min_height)**

Set minimum height in pixels (accepts integer)

**withMaxWidth($max_width)**

Set maximum width in pixels (accepts integer)

**withMaxHeight($max_height)**

Set maximum height in pixels (accepts integer)

**withMinSize($min_size)**

Set minimum size in MB (accepts integer)

**withMaxSize($max_size)**

Set maximum size in MB (accepts integer)

**withMimeTypes($mime_types)**

Comma-seperated list of mime types (e.g. "image/png,image/jpg,image/gif")

**withReturnFormat($return_format)**

Set the format that is returned, choose from "array", "url" or "id"


### True/False

**withMessage($message)**

Set the message that appears with the checkbox


### Checkbox

**withOptions($options)**

Set the checkbox items that appear, $options should be an array where the key is the checkbox value and the value represents the label of the checkbox.


### File

**withMinSize($min_size)**

Set minimum size in MB (accepts integer)

**withMaxSize($max_size)**

Set maximum size in MB (accepts integer)

**withMimeTypes($mime_types)**

Comma-seperated list of mime types (e.g. "image/png,image/jpg,image/gif")

**withReturnFormat($return_format)**

Set the format that is returned, choose from "array", "url" or "id"


### Number

**withMin($min)**

Set minimum number (accepts integer).

**withMax($max)**

Set maximum number (accepts integer).

**withStep($step)**

Set how many numbers are skipped when arrows are clicked (accepts integer).


### Page Link

**withPostTypes($post_types)**

An array of post types that should be given as options.

**withTaxonomy($taxonomy)**

An array of taxonomies that contain the options that are given.

**allowNull()**

Set if the select can be set as null.

**isMultiple()**

Allow the user to select multiple options.


### Post Object

**withPostTypes($post_types)**

An array of post types that should be given as options.

**withTaxonomy($taxonomy)**

An array of taxonomies that contain the options that are given.

**allowNull()**

Set if the select can be set as null.

**isMultiple()**

Allow the user to select multiple options.

**withReturnFormat($return_format)**

Choose the format that should be returned, choose between "object" and "id"


### Radio

**withOptions($options)**

Set the checkbox items that appear, $options should be an array where the key is the checkbox value and the value represents the label of the checkbox.


### Select

**withOptions($options)**

Set the checkbox items that appear, $options should be an array where the key is the checkbox value and the value represents the label of the checkbox.

**allowNull()**

Set if the select can be set as null.

**isMultiple()**

Allow the user to select multiple options.


### User

**withRoles($roles)**

Set the roles of users that should appear in the select. Needs to be an array of user roles.

**allowNull()**

Set if the select can be set as null.

**isMultiple()**

Allow the user to select multiple options.


### WYSIWYG

**withTabs($tab_perference)**

Set which tabs should show on the WYSIWYG, choose between "all", "visual" and "text"

**withToolbar($toolbar_perference)**

Set which toolbar to show in the WYSIWYG, choose between "full" and "basic"

**canUploadMedia()**

Set it so that the user can upload media with the WYSIWYG

