<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

use Slim\Environment;

class IndexTest extends PHPUnit_Framework_TestCase {

    public function request($method, $path, $options = array()) {
// Capture STDOUT
        ob_start();

// Prepare a mock environment
        Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'slim-test.dev',
                        ), $options));

        $app = new \Slim\Slim();
        $this->app = $app;
        $this->request = $app->request();
        $this->response = $app->response();

// Return STDOUT
        return ob_get_clean();
    }

    public function get($path, $options = array()) {
        $this->request('GET', $path, $options);
    }

    public function post($path, $options = array()) {
        $this->request('POST', $path, $options);
    }

    public function delete($path, $options = array()) {
        $this->request('DELETE', $path, $options);
    }

    public function testIndex() {
        $this->get('/');
        $this->assertEquals('200', $this->response->status());
    }

    public function testaddNotOk() {
        $result = $this->prepareUrl('add', 'number1=1');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testaddNotOkString() {
        $result = $this->prepareUrl('add', 'number1=a&number2=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testaddOk() {
        $result = $this->prepareUrl('add', 'number1=1&number2=2');
        $this->assertEquals('{"result":3}', $result);
    }

    public function testSubtractNotOk() {

        $result = $this->prepareUrl('subtract', 'number1=1');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testSubtractNotOkString() {
        $result = $this->prepareUrl('subtract', 'number1=a&number2=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testSubtractOk() {
        $result = $this->prepareUrl('subtract', 'number1=2&number2=2');
        $this->assertEquals('{"result":0}', $result);
    }

    public function testMultiplyNotOk() {

        $result = $this->prepareUrl('multiply', 'number1=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testMultiplyNotOkString() {
        $result = $this->prepareUrl('multiply', 'number1=a&number2=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testMultiplyOk() {

        $result = $this->prepareUrl('multiply', 'number1=2&number2=2');
        $this->assertEquals('{"result":4}', $result);
    }

    public function testDivideNotOk() {

        $result = $this->prepareUrl('divide', 'number1=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testDivideNotOkString() {
        $result = $this->prepareUrl('divide', 'number1=a&number2=2');
        $this->assertEquals('{"result":"missing parameters"}', $result);
    }

    public function testDivideOk() {

        $result = $this->prepareUrl('divide', 'number1=2&number2=2');
        $this->assertEquals('{"result":1}', $result);
    }

    protected function prepareUrl($method, $params) {
        $useragent = "Fake Mozilla 5.0 ";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_URL, 'http://www.carlossouza.com/calculator/' . $method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
