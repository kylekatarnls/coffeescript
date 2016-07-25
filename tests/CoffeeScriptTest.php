<?php

use NodejsPhpFallback\NodejsPhpFallback;
use NodejsPhpFallback\CoffeeScript;

class CoffeeScriptWithoutNode extends CoffeeScript
{
    public function compile()
    {
        return;
    }
}

class CoffeeScriptTest extends PHPUnit_Framework_TestCase
{
    public function testGetSourceFromRaw()
    {
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.coffee')));
        $coffee = new CoffeeScript($expected);
        $coffee = trim($coffee->getSource());

        $this->assertSame($expected, $coffee, 'CoffeeScript can be get as it with a raw input.');
    }

    public function testGetResultFromRaw()
    {
        $code = file_get_contents(__DIR__ . '/test.coffee');
        $stylus = new CoffeeScript($code);
        $js = trim($stylus->getResult());
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.js')));

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered anyway.');
    }

    public function testGetSourceFromPath()
    {
        $coffee = new CoffeeScript(__DIR__ . '/test.coffee');
        $coffee = trim(str_replace("\r", '', $coffee->getSource()));
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.coffee')));

        $this->assertSame($expected, $coffee, 'CoffeeScript can be get with a file path input too.');
    }

    public function testGetResult()
    {
        $coffee = new CoffeeScript(__DIR__ . '/test.coffee');
        $js = trim($coffee);
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.js')));

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered anyway.');
    }

    public function testNonBareGetResult()
    {
        $coffee = new CoffeeScript(__DIR__ . '/test.coffee', false);
        $js = preg_replace('/\s/', '', $coffee->getResult());
        $expected = preg_replace('/\s/', '', '(function(){' . file_get_contents(__DIR__ . '/test.js') . '}).call(this);');

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered in a function with node.');
    }

    public function testNonBareGetResultWithoutNode()
    {
        $coffee = new CoffeeScriptWithoutNode(__DIR__ . '/test.coffee', false);
        $js = preg_replace('/\s/', '', $coffee->getResult());
        $expected = preg_replace('/\s/', '', '(function(){' . file_get_contents(__DIR__ . '/test.js') . '}).call(this);');

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered in a function without node.');
    }

    public function testWrite()
    {
        $file = sys_get_temp_dir() . '/test.js';
        $coffee = new CoffeeScript(__DIR__ . '/test.coffee');
        $coffee->write($file);
        $js = trim(str_replace("\r", '', file_get_contents($file)));
        unlink($file);
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.js')));

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered anyway.');
    }

    public function testGetResultWithoutNode()
    {
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.js')));
        $coffee = new CoffeeScriptWithoutNode(__DIR__ . '/test.coffee');
        $js = trim(str_replace(array("\r", "\t"), array('', '  '), $coffee->getResult()));

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered anyway.');
    }

    public function testWriteWithoutNode()
    {
        $expected = trim(str_replace("\r", '', file_get_contents(__DIR__ . '/test.js')));
        $coffee = new CoffeeScriptWithoutNode(__DIR__ . '/test.coffee');
        $file = sys_get_temp_dir() . '/test.js';
        $coffee->write($file);
        $js = trim(str_replace("\r", '', file_get_contents($file)));
        unlink($file);

        $this->assertSame($expected, $js, 'CoffeeScript should be rendered anyway.');
    }
}
