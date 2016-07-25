<?php

namespace NodejsPhpFallback;

use CoffeeScript\Compiler as PhpCoffeeScriptEngine;

class CoffeeScript extends Wrapper
{
    protected $bare;

    public function __construct($file, $bare = true)
    {
        parent::__construct($file);
        $this->bare = $bare;
    }

    public function compile()
    {
        return $this->execModuleScript(
            'coffee-script',
            'bin/coffee',
            '--print ' . ($this->bare ? '--bare ' : '') . escapeshellarg($this->getPath('source.coffee'))
        );
    }

    public function fallback()
    {
        return CoffeeScript::compile($this->getSource(), array(
            'filename' => basename($this->getPath('source.coffee')),
            'bare' => $this->bare,
            'header' => false,
        ));
    }
}
