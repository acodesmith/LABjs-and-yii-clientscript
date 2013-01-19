LABjs-and-yii-clientscript
==========================

Yii extension for LABjs to load scripts via clientScript.

Speed up your page load time by dynamically adding JS files.

```php
	//@param_1 array of js locations
	//@param_2 string of javascript for after list loaded.
	//array value will be used as callback if key is location. 
	//array('/js/example.js'=>'function(){ alert("example has been loaded")}');
	Yii::app()->labScript->registerScriptList(array(), callback());
```