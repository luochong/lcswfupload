<?php
/**
 * SWFUpload CWidget
 *
 * @author luochong <luochong1987@gmail.com>
 * @version 1.0.2  2010.10.19 14:08 
 */
class SWFUpload extends CWidget
{
    public $fileQuenueLimit  = 10; // file quenue limit
    public $imgUrlList       =array();
    public $uploadUrl        = ''; //
    public $postParams       =array();
	public $debug            =false;    
    public $fileSizeLimit    = 5;  // file size limit 5MB
    public $fileTypes        = '*.jpg;*.jpeg;*.gif;*.png'; // uploaded file types
    public $buttonText       = '选择图片';
	/**
	 * callbackJS是一个js函数
	 * 参数name为文件名,path为文件路径
	 * function(name,path)
	 * {
	 * }
	 * @var javascript function
	 */
	public $callbackJS       =''/*'function(name,path){alert("文件名:"+name);alert("文件路径:"+path);}'*/;


    public static $threadId  = 0; //处理一个页面的多个上传widget,这里输入不同的参数
    private $baseUrl     = '';

	
	public function init()
	{
        SWFUpload::$threadId ++ ;

	    if(is_string($this->imgUrlList))
	    {
	        $this->imgUrlList = array($this->imgUrlList);
	    }
	    if($this->uploadUrl === '')
	    {
	       $this->uploadUrl =  $this->controller->createUrl('upload'); //上传路径默认action为upload ，可以使用SWFUploadAction
	    }
	    if(!is_bool($this->debug))
	    {
	        throw new Exception('debug参数需要一个bool值(false/true)');
	    }
	    $this->postParams['SWFUpload'] = SWFUpload::$threadId; //标识是SWFUpload上传请求
	    $this->postParams['callbackJS'] = $this->callbackJS;
	    $this->postParams['SessionID'] = Yii::app()->session->getSessionID();
	    $this->postParams['fileQuenueLimit'] = $this->fileQuenueLimit;
		
        $assets=dirname(__FILE__).'/assets';
		$this->baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)){
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($this->baseUrl.'/swfupload.js',CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile($this->baseUrl.'/handlers.js',CClientScript::POS_HEAD);
		} else {
			throw new Exception('SWFUpload - Error: Couldn\'t find assets to publish.');
		}
	}
	
	public function run()
	{
	    $this->renderFile(dirname(__FILE__).'/views/swfupload.php',array(
    		'fileQuenueLimit'=>$this->fileQuenueLimit,
    		'threadId'=>SWFUpload::$threadId,    	
    		'imgUrlList'=>$this->imgUrlList,
    		'uploadUrl' =>$this->uploadUrl, 
    		'postParams' =>CJavaScript::jsonEncode((object)$this->postParams),
    		'debug'     =>$this->debug?'true':'false',        
            'fileSizeLimit' => $this->fileSizeLimit,
            'fileTypes' => $this->fileTypes,
            'buttonText' => $this->buttonText,
            'baseUrl'    => $this->baseUrl,
		));
	}
}
