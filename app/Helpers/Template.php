<?php
namespace App\Helpers;
use Config;
use Illuminate\Support\Facades\Auth as Auth;

use Illuminate\Support\Facades\Storage;
class Template {

    public static function showImagePreview ($controllerName, $fileName,$fileAlt,$options = array()) {
        $path = '';
        if ($fileName != ''){
            if (isset($options['subFolderUpload'])){
                $fileName = $options['subFolderUpload']. '/' . $fileName;
            }
            $folderUpload = Config::get('ntg.folderUpload.mainFolder') ;
            $path = asset("public/$folderUpload/$controllerName/$fileName");
        }

        $strAttr = '';
        if (isset($options['attr'])){
            foreach($options['attr'] as $key => $attr){
                $strAttr .= " $key ='$attr' ";
            }
        }
        $class = isset($options['class'])?$options['class']:'';
        $xhtml = sprintf("<img class='img-fluid img-thumb' src='%s' alt='%s'  $strAttr />",$path,$fileAlt);
        return $xhtml;
    }
    public static function showImagePreviewFileManager ($filePath,$fileAlt, $options = array()) {
        $path = '';
        if ($filePath != ''){
            $path = asset("$filePath");
        }else{
            return '';
        }
        $strAttr = '';
        if (isset($options['attr'])){
            foreach($options['attr'] as $key => $attr){
                $strAttr .= " $key ='$attr' ";
            }
        }
        $class = isset($options['class'])?$options['class']:'';
        $xhtml = sprintf("<img class='img-fluid img-thumb' src='%s' alt='%s'  $strAttr />",$path,$fileAlt);
        return $xhtml;
    }
    // public static function showItemFileAttachPreview ($controllerName, $fileName, $fileHash, $id,$options = array()) {
    //     if ($fileName != ''){
    //         $fileName= explode('|', $fileName);
    //         $fileHash= explode('|', $fileHash);
    //     }

    //     if (is_array($fileName)){
    //         $xhtml = "<ul class='list-unstyled list-file'>";
    //         foreach ($fileName as $keyFile => $valFile) {
    //             $params = ['id'=>$id,'stt'=>$keyFile,'fileName'=>$fileHash[$keyFile]];
    //             if (isset($options['subFolder'])) $params['subFolder'] = $options['subFolder'];
    //             $link = route("{$controllerName}/download",$params) ;
    //             $linkView = route("{$controllerName}/view",$params) ;
    //             $label = $valFile;

    //             $xhtml .= sprintf("<li>
    //                                 <a href='$linkView' target='_blank'
    //                                     data-toggle='tooltip' data-placement='top'
    //                                     data-original-title='Tải về: {$label} ' >
    //                                     {$label}
    //                                 </a>
    //                                 <span class='float-right'>
    //                                 <a href='$link' data-toggle='tooltip' data-placement='top'
    //                                     data-original-title='Tải về: {$label} '
    //                                     class='btn btn-success btn-sm'>
    //                                     <i class='fa fa-download'></i>
    //                                 </a>");

    //             if (isset($options['btn']) && ($options['btn'] == 'delete')){
    //                 $xhtml .= sprintf("<a href='javascript:void(0)' data-toggle='tooltip' data-placement='top'
    //                                     data-original-title='Xóa bỏ: {$label}'
    //                                     data-href='{$fileHash[$keyFile]}'
    //                                     class='btn btn-danger btn-sm'
    //                                     name='btnDeleteFile'  id='btnDeleteFile'>
    //                                     <i class='fa fa-trash'></i>
    //                                 </a>");
    //             }
    //             $xhtml .= '</span></li>';
    //         }
    //         $xhtml .= '</ul>';
    //         return $xhtml;
    //     }
    // }
    public static function showNestedSetName($name,$level){
        $xhtml = str_repeat(config("myconfig.template.char_level"),$level-1);
        $xhtml  .=  "<strong>$name</strong>";
        return $xhtml;
    }
    public static function showNestedSetUpDown($controllerName,$id,$item){
        $upButton = sprintf('
            <a href="%s" type="button" class="btn btn-primary btn-sm mb-0" data-toggle="tooltip" title="" data-original-title="Lên">
                <i class="fas fa-arrow-up"></i>
            </a>',route("$controllerName.move",['id'=>$id,'type'=>'up']));

        $downButton = sprintf('
            <a href="%s" type="button" class="btn btn-primary btn-sm mb-0" data-toggle="tooltip" title="" data-original-title="Xuống">
                <i class="fas fa-arrow-down"></i>
            </a>',route("$controllerName.move",['id'=>$id,'type'=>'down']));

        if (empty($item->getPrevSibling()) || empty($item->getPrevSibling()->parent_id)) $upButton = '';
        if (empty($item->getNextSibling())) $downButton='';

        $xhtml = '
            <span style="width:36px;display:inline-block;float:left">' . $upButton . '</span>
            <span style="width:36px;display:inline-block;float:right">' . $downButton . '</span>';
        return $xhtml;
    }
    public static function createFileManager($name,$filePath='',$params=[]){
        $btn = 'btn-' . $name;
        $thumb = $name . '-thumb';
        $src = ($filePath)?asset($filePath):'';

        $xhtml = "
            <div class='input-group'>
                <span class='input-group-btn'>
                    <a id='$btn' data-input='$name' data-preview='$thumb' class='btn btn-primary'>
                        <i class='fa fa-picture-o'></i> Chọn ảnh
                    </a>
                </span>
                <input id='$name' class='form-control' name='$name' type='hidden' value='$filePath'>
            </div>
            <img id='$thumb' style='margin-top:15px;max-height:100px;' src='$src'>
        ";
        return $xhtml;
    }
}
