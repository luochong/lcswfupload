Yii extensions:
http://www.yiiframework.com/extension/lcswfupload/

Author:  
luochong <luochong1987@gmail.com>
#######################################################################
中文说明

SWFUpload Yii文件上传 整合 swfupload

    flash文件上传

    支持多文件同时上传

    显示文件上传进度条

Requirements

Yii 1.1 or above
Usage

SWFUpload 图片上传

第一步：在控制器类里面载入SWFUploadAction

public function actions() {
        return array(
            'upload'=>array(
                'class'=>'application.extensions.swfupload.SWFUploadAction',
                'filepath'=>'/var/www/yourpath/yourfilename.EXT', //注意这里是绝对路径,.EXT是文件后缀名替代符号
            )
        );
}

说明:

你必须要有这个upload action的权限，可以在accessRules函数中添加upload action 的访问权限

    filepath 文件的完整上传路径 包括文件名 如: C:/file/logo.EXT 后缀名是用户上传的文件决定所以在这里只需要用 .EXT 替代

    SWFUploadAction支持两个事件 onBeforeUpload 和 onAfterUpload

第二步：在视图中调用widget

<?php 
       $this->widget('application.extensions.swfupload.SWFUpload',array('callbackJS'=>'swfupload_callback'));
?>

说明:
callbackJS 是图片上传后执行的js函数 函数定义格式如下：

第一参数是文件名字name，

第二参数是文件路径path，

第三参数是oldname是文件的原始名字，

javascript代码如下：

function swfupload_callback(name,path,oldname)  
   {
           $("#Sponsor_logo").val(name);
           $("#thumbnails_1").html("<img src='"+path+"/"+name+"?"+(new Date()).getTime()+"' />"); 
   }


#########################################################################################

English description

SWFUpload is a small JavaScript/Flash library to get the best of both worlds. It features the great upload capabilities of Flash and the accessibility and ease of HTML/CSS now combined with the power of Yii framework.
Requirements

Yii 1.1 or above

Installation

Extract the release file under protected/extensions

Directory structure like this

--extensions
----swfupload
------assets
------views
------SWFUpload.php
------SWFUploadAction.php

Usage

See the following code example:

On controller

public function accessRules()
{
     return array(
        array('allow', 
              'actions'=>array('upload'),
              'users'=>array('*'),
        ),
        ......
      );
}
 
 
public function actions() {
        return array(
            'upload'=>array(
                'class'=>'application.extensions.swfupload.SWFUploadAction',
                'filepath'=>'/var/www/yourpath/yourfilename.EXT',   // 'EXT' will be replaced by file extension
                'onAfterUpload'=>array($this,'saveFile'),
            )
        );
}
 
 
public function saveFile($event)
{
        //$event->sender['uploadedFile'] is CUploadedFile
        //$event->sender['uploadedFile']->name; the original name of the file being uploaded
       // $event->sender['name']  yourfilename.EXT
       // do something   ......
 
}

On Views

<?php  
$this->widget('application.extensions.swfupload.SWFUpload',array(
     'callbackJS'=>'swfupload_callback',
    )
);
?>
<input type="text"  name="image_name" id="image_name" />
 
<script>
   function swfupload_callback(name,path,oldname)  
   {
           $("#image_name").val(name);
           $("#thumbnails_1").html("<img src='"+path+"/"+name+"?"+(new Date()).getTime()+"' />"); 
   } 
</script>
