<?php
/**
* CWidgetFlowPlayer
* 
* 
* @link http://www.flowplayer.org
* @link 
* @version 0.1
* @author Laptev Grigory <greh88@gmail.com>
*/
class CWidgetFlowPlayer extends CWidget {
    
    /**
    * Префикс для сгенерированного ID 
    * 
    * @var string
    */
    public $prefix = 'player_';
    
    /**
    * Параметры плеера
    * 
    * @var array
    */
    public $options = array();
    
    /**
    * Начинать проигрывание сразу после загрузки страницы
    * 
    * @var boolean
    */
    public $autoPlay = false;
    
    /**
    * Начать буферизацию сразу после загрузки страницы
    * 
    * @var boolean
    */
    public $autoBuffering = false;
    
    /**
    * Ссылка на проигрываемый файл
    * 
    * @var string
    */
    public $flv;
    
    /**
    * Ссылка на swf плеера
    * 
    * @var mixed
    */
    public $swf;
    
    /**
    * Высота плеера в пикселях
    * 
    * @var integer
    */
    public $height;
    
    /**
    * Ширина плеера в пикселях
    * 
    * @var integer
    */
    public $width;
    
    /**
    * Позиция публикации скрипта 
    * 
    * @var integer
    */
    public $scriptPosition = CClientScript::POS_END;
    
    public $htmlOptions = array(
        'style' => 'display:block;'
    );
    
    public $id;
    
    public function init() {
        
        $this->id = $this->prefix . $this->getId();
        
        $assetUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets');
        
        Yii::app()->getClientScript()
            ->registerCssFile($assetUrl . '/css/flowplayer/skin/minimalist.css')
            ->registerScriptFile($assetUrl . '/js/flowplayer-3.2.11.min.js', CClientScript::POS_END)
        ;    
        
        if (empty($this->swf)) {
            $this->swf = $assetUrl . '/swf/flowplayer-3.2.15.swf';
        }
        
        if (!isset($this->options['clip']['autoPlay'])) {
            $this->options['clip']['autoPlay'] = $this->autoPlay;
        }
        if (!isset($this->options['clip']['autoBuffering'])) {
            $this->options['clip']['autoBuffering'] = $this->autoBuffering;
        }
        
        if (!empty($this->height)) {
            $this->htmlOptions['style'] .= 'height:' . $this->height . 'px;';
        }
        
        if (!empty($this->width)) {
            $this->htmlOptions['style'] .= 'width:' . $this->width . 'px;';
        }
        
        $this->htmlOptions['id'] = $this->id;
        
    }        
    
    public function run() {
        $this->options = CJSON::encode($this->options);
        $this->render('index');
    }
    
}
?>
