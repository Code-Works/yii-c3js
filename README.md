Yii c3.js Widget
========================

[![Latest Stable Version](https://poser.pugx.org/code-works/yii-c3js/v/stable.png)](https://packagist.org/packages/code-works/yii-c3js)
[![Total Downloads](https://poser.pugx.org/code-works/yii-c3js/downloads.png)](https://packagist.org/packages/code-works/yii-c3js)
[![License](https://poser.pugx.org/code-works/yii-c3js/license.png)](https://packagist.org/packages/code-works/yii-c3js)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/code-works/yii-c3js/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/code-works/yii-c3js/?branch=master)

Easily add [C3.js](http://http://c3js.org//) graphs to your Yii application.

Links
-----

* [Home page](https://github.com/code-works/yii-c3js)
* [C3.js demos](http://c3js.org/examples.html)
* [Report a bug](https://github.com/code-works/yii-c3js/issues)


Requirements
------------

* Yii 1.1.5 or above
* PHP 5.1 or above


Installation
-------------

* Extract the release file under `protected/extensions/`


Usage
-----

To use this widget, you may insert the following code into a view file:
```php
$this->Widget('ext.c3js.C3JsWidget', array(
    'options' => array(
        'title' => array(
            'text' => "My Chart"
        ),
        'data' => array(
            'columns' => array(
                array('data1', 30, 200, 100, 400, 150, 250)
            ),
        )
    )
));
?>
```
By configuring the `options` property, you may specify the options that need to be passed to the C3.js JavaScript object.
Please refer to the demo gallery and documentation on the [C3.js website](http://c3js.org/) for possible options.

Alternatively, you can use a valid JSON string in place of an associative array to specify options
```

*Note:* You must provide a *valid* JSON string (double quotes) when using the second option. 
You can quickly validate your JSON string online using [JSONLint](http://jsonlint.com/).