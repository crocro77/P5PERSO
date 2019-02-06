<?php

// TEST 2

class FlashMessages extends Twig_Extension
{
    protected $flash;

    public function __construct(Messages $flash)
    {
        $this->flash = $flash;
    }

    // public function getName()
    // {
    //     return 'slim-twig-flash';
    // }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('flash', [$this, 'getMessages']),
        ];
    }

    public function getMessages($key = null)
    {
        if (null !== $key) {
            return $this->flash->getMessage($key);
        }
        return $this->flash->getMessages();
    }
}