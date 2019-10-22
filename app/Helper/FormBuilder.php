<?php


namespace App\Helper;


class FormBuilder
{
    public function __construct($action, $method, $class = '')
    {
        $this->html = '<form class="' . $class . '" action="' . $action . '" method="' . $method . '">';
    }

    //To get the form once it has been build
    public function get()
    {
        $this->html .= '</form>';
        return $this->html;
    }

    public function addInput($attributes, $class = '', $label = '', $wrapper = '')
    {
        $html = '';
        //Setting up label
        if ($label != '') {
            if (array_key_exists('id', $attributes)) {
                $for = 'for="' . $attributes['id'] . '"';
            } else {
                $for = '';
            }
            $html .= '<label ' . $for . '>' . ucfirst($label) . '</label>';
        }
        //Setting input
        $html .= '<input '; //
        foreach ($attributes as $key => $element) {
            $html .= ' ' . $key . '="' . $element . '"';
        }
        $html .= ' class="' . $class . '"';
        $html .= ' autocomplete="' . 'off' . '"';
        $html .= ' >';
        //Setting wrapper
//        if ($wrapper != '') { //si wrapper es algo diferente al default
//            $html = $this->addWrapper($wrapper, $html);
//        }
        $this->html .= $html;
        return $this;
    }

    public function addTextarea($attributes, $class = '', $content = '', $label = '')
    {
        $html = '';
        //Setting label
        if ($label != '') {
            if (array_key_exists('id', $attributes)) {
                $for = 'for="' . $attributes['id'] . '"';
            } else {
                $for = '';
            }
            $html .= '<label ' . $for . 'class="' . $class . '"' . '>' . ucfirst($label) . '</label>';
        }
        //Setting textarea
        $html .= '<textarea ';
        foreach ($attributes as $key => $element) {
            $html .= $key . '="' . $element . '"';
        }
        $html .= ' class="' . $class . '"';
        $html .= ' >';
        $html .= $content;
        $html .= '</textarea>';
        $this->html .= $html;
        return $this;
    }

    public function addSubmit($attributes, $class = '')
    {
        $html = '';
        $html .= '<input ';
        foreach ($attributes as $key => $element) {
            $html .= $key . '="' . $element . '"';
        }
        $html .= ' class="' . $class . '"';
        $html .= '>';
        $this->html .= $html;
        return $this;
    }
}