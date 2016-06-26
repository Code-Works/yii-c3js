<?php

/**
 * C3JsWidget class file.
 *
 * @author Frank Gehann <fg@code-works.de>
 * @link https://github.com/code-works/yii-c3js/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0.0
 */

/**
 * C3JsWidget encapsulates the {@link http://c3js.org/ C3.js} D3-based reusable chart library.
 *
 * To use this widget, you may insert the following code in a view:
 * <pre>
 * $this->Widget('ext.c3js.C3JsWidget',array(
 *     'options' => "
 *         data: {
 *           columns: [
 *             ['data1', 30, 200, 100, 400, 150, 250],
 *            ['data2', 50, 20, 10, 40, 15, 25]
 *           ],
 *           axes: {
 *             data2: 'y2'
 *           }
 *         },
 *         axis: {
 *           y: {
 *             label: { // ADD
 *               text: 'Y Label',
 *               position: 'outer-middle'
 *             }
 *           },
 *           y2: {
 *             show: true,
 *             label: { // ADD
 *               text: 'Y2 Label',
 *               position: 'outer-middle'
 *             }
 *           }
 *         }
 *     "
 * ));
 * </pre>
 *
 * By configuring the {@link $options} property, you may specify the options
 * that need to be passed to the C3.js JavaScript object. Please refer to
 * the demo gallery and documentation on the {@link http://c3js.org/examples.html C3.js examples Website}
 * for possible options.
 */
class C3JsWidget extends CWidget
{
    public $options = array();
    public $htmlOptions = array();

    /**
     * Renders the widget.
     */
    public function run()
    {
        $defaultHtmlOptions = array('class' => "c3");

        if (isset($this->htmlOptions['id'])) {
            $id = $this->htmlOptions['id'];
        } else {
            $id = $this->htmlOptions['id'] = $this->getId();
        }

        $mergedHtmlOptions = CMap::mergeArray($defaultHtmlOptions, $this->htmlOptions);

        echo CHtml::openTag('div', $mergedHtmlOptions);
        echo CHtml::closeTag('div');

        // check if options parameter is a json string
        if (is_string($this->options)) {
            if (!$this->options = CJSON::decode($this->options)) {
                throw new CException('The options parameter is not valid JSON.');
            }
        }

        // merge options with default values
        $defaultOptions = array('bindto' => '#'.$id);
        $this->options = CMap::mergeArray($defaultOptions, $this->options);

        $jsOptions = CJavaScript::encode($this->options);
        $this->registerScripts(__CLASS__ . '#' . $id, "var c3js_chart_{$id} = c3.generate($jsOptions);");
    }

    /**
     * Publishes and registers the necessary script files.
     *
     * @param string the id of the script to be inserted into the page
     * @param string the embedded script to be inserted into the page
     */
    protected function registerScripts($id, $embeddedScript)
    {
        $basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath, false, 1, YII_DEBUG);

        $cs = Yii::app()->clientScript;

        // register additional scripts
        $extension = YII_DEBUG ? '.min.js' : '.js';
        $extension_css = YII_DEBUG ? '.min.css' : '.css';
        $cs->registerScriptFile("{$baseUrl}/d3{$extension}");
        $cs->registerScriptFile("{$baseUrl}/c3{$extension}");
        $cs->registerCssFile("{$baseUrl}/c3{$extension_css}");

        // register embedded script
        $cs->registerScript($id, $embeddedScript, CClientScript::POS_LOAD);
    }
}
