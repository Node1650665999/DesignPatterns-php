<?php

namespace DesignPatterns\Structural\Composite;

class Form implements RenderableInterface
{
    /**
     * @var RenderableInterface[]
     */
    private $elements;

    public function render(): string
    {
        $formCode = '<form>';

        foreach ($this->elements as $element) {
            // 子元素和 form 的一致的行为,它们组合成了form表单，对于用户来说是无区别的，都是生成一个html元素而已
            $formCode .= $element->render();
        }

        $formCode .= '</form>';

        return $formCode;
    }

    /**
     * @param RenderableInterface $element
     */
    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}