<?php

class labScript extends CClientScript {

    //Instance of Client Script setin init()
    public $cs;

    //Asset folder location
    protected $_assetsUrl;

    //Required for Yii App Life Cycle
    public function init() {

        if (Yii::getPathOfAlias('labScript') === false)
            Yii::setPathOfAlias('labScript', realpath(dirname(__FILE__).'/..'));

        //Get instance of clientScript
        $this->cs = Yii::app()->clientScript;

        //Register Core
        $this->registerLabCore();

        parent::init();
    }

    /*
     * Get URL of assets location
     */
    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('labScript');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }

    /**
     * Register LAB.min.js located in the assets folder
     */
    protected function registerLabCore(){
       $location = Yii::app()->assetManager->publish(Yii::getPathOfAlias('labScript').'/lab/assets/js/LAB.min.js');
       $this->cs->registerScriptFile($location, self::POS_END);
    }

    /**
     * @param $list array() If key is not numeric, use key as location and value as .wait(callback())
     * @param string $callback
     */
    public function registerScriptList($list, $callback='function(){}'){
        $script = '$LAB';
        foreach($list as $itemLocation=>$item){

            if(!is_numeric($itemLocation)){
                $script.= '.script("'.$itemLocation.'")';
                $script.='.wait('.$item.');';
            }else{
                $script.= '.script("'.$item.'")';
            }
        }
        $script.='.wait('.$callback.')';

        $this->cs->registerScript('LABList', $script, CClientScript::POS_END);
    }


}