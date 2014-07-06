<?php
    /* @var $this CWidgetFlowPlayer */
    
    Yii::app()->getClientScript()->registerScript($this->id, "
        $(document).ready(function() {
            flowplayer('{$this->id}', '{$this->swf}', {$this->options});
        });    
    
    ", $this->scriptPosition);
    echo CHtml::link(' ', $this->flv, $this->htmlOptions);
?>

