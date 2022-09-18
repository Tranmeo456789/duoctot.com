<?php
namespace App\Helpers;

class Form {
    public static function show ($elements,$params = array()) {
        $xhtml = null;
        foreach ($elements as $element) {
            $xhtml .= self::formGroup($element,$params);
        }
        return $xhtml;
    }
    public static function showElement ($element,$params = array()) {
        return self::formGroup($element,$params);
    }
    public static function formGroup ($element, $params = array()) {
        $type = isset($element['type']) ? $element['type'] : "input";
        $widthInput =  isset($element['widthInput']) ?$element['widthInput']:(isset($params['widthInput']) ? $params['widthInput']: "col-md-9 col-sm-9 col-xs-12");
        $widthElement = isset($element['widthElement']) ? $element['widthElement']: "col-12";
        $xhtml = null;
        $styleFormGroup = isset($element['styleFormGroup'])?$element['styleFormGroup']:'';
        switch ($type) {
            case 'input':
                $xhtml .= sprintf(
                    "<div class='%s'>
                        <div class='form-group row $styleFormGroup'>
                            %s
                            <div class='%s'>
                                %s
                            </div>
                        </div>
                    </div>", $widthElement, $element['label'], $widthInput,$element['element']
                );
                break;
            case 'inline':
                $xhtml .= sprintf(
                    "<div class='%s'>
                        <div class='form-group $styleFormGroup'>
                            %s
                            %s
                        </div>
                    </div>", $widthElement, $element['label'], $element['element']
                );
                break;
            case 'input-group-addon-image-before':
                $xhtml = sprintf("
                    <div class='%s'>
                        <div class='form-group row $styleFormGroup'>
                            %s
                            <div class='%s'>
                                <div class='input-group align-self-center'>
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'><img src='%s'></span>
                                    </div>
                                    %s
                                </div>
                            </div>
                        </div>
                    </div>",
                    $widthElement, $element['label'],$widthInput,$element['image'],$element['element']
                );
                break;
            case 'password-with-image-before':
                    $xhtml = sprintf("
                        <div class='%s'>
                            <div class='form-group row $styleFormGroup'>
                                %s
                                <div class='%s'>
                                    <div class='input-group align-self-center'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'><img src='%s'></span>
                                        </div>
                                        %s
                                        <div class='input-group-append'>
                                            <span class='input-group-text changeTypePassword'><i class='fa fa-eye'></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>",
                        $widthElement, $element['label'],$widthInput,$element['image'],$element['element']
                    );
                    break;
                case 'inline-text-right':
                        $xhtml .= sprintf(
                            "<div class='%s'>
                                <div class='form-group text-justify $styleFormGroup d-inline-flex'>
                                    %s
                                    %s
                                </div>
                            </div>", $widthElement, $element['element'],$element['label']
                        );
                        break;
        }
        return $xhtml;
    }
}
