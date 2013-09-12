### Yii extensions:
http://www.yiiframework.com/extension/lcswfupload/



中文说明
----------

SWFUpload Yii文件上传 整合 swfupload

    flash文件上传

    支持多文件同时上传

    显示文件上传进度条

#### Requirements

Yii 1.1 or above
Usage

#### SWFUpload 图片上传

第一步：在控制器类里面载入SWFUploadAction

    public function actions() {
        return array(
            'upload'=>array(
                'class'=>'application.extensions.swfupload.SWFUploadAction',
                
                //注意这里是绝对路径,.EXT是文件后缀名替代符号
                'filepath'=>'/var/www/yourpath/yourfilename.EXT',
                
                'onAfterUpload'=>array($this,'saveFile'),
            )
        );
    }

说明:

**你必须要有这个upload action的权限，可以在accessRules函数中添加upload action 的访问权限**


1. filepath 文件上传后保存到服务器的的绝对路径,包括文件名 如: /var/www/images/logo.EXT 文件未上传之前后缀名是未知的，故在这里用 .EXT 做为替代符，lcswfupload保存文件时获得文件扩展名替代.EXT


2. SWFUploadAction支持两个事件 onBeforeUpload 和 onAfterUpload

onAfterUpload 在文件保存到服务器后执行
如上代码，onAfterUpload 绑定了$this->saveFile 函数。
你可以在此函数中将文件名保存到数据库中，或者进行图片裁剪工作等。

    public function saveFile($event)
    {
        //$event->sender['uploadedFile']  这个是 CUploadedFile 对象
        //$event->sender['uploadedFile']->name;  文件上传之前的名字
       // $event->sender['name']  yourfilename.EXT 文件保存到服务器的名字 由filepath指定
       // do something   ......

    }

第二步：在视图中调用widget

        <?php 
            $this->widget(
                'application.extensions.swfupload.SWFUpload',
                array(
                    'callbackJS'=>'swfupload_callback'
                )
            );
        ?>

说明:

    callbackJS 是图片上传后lcswfupload将自动执行的js函数，用于在页面上获得上传后的文件名等。
    用于场景如：将上传成功后的图片立即显示出来等。
    函数定义格式如下： 
        第一参数是文件名字name，
        第二参数是文件路径path，
        第三参数是oldname是文件的原始名字，

javascript代码示例：

    function swfupload_callback(name,path,oldname)  
    {
           $("#Sponsor_logo").val(name);
           $("#thumbnails_1").html("<img src='"+path+"/"+name+"?"+(new Date()).getTime()+"' />"); 
    }




English description
----------

SWFUpload is a small JavaScript/Flash library to get the best of both worlds. It features the great upload capabilities of Flash and the accessibility and ease of HTML/CSS now combined with the power of Yii framework.

####Requirements

Yii 1.1 or above

####Installation

Extract the release file under protected/extensions

Directory structure like this

    --extensions
    ----swfupload
    ------assets
    ------views
    ------SWFUpload.php
    ------SWFUploadAction.php

####Usage

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
