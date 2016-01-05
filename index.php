<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';
require 'calculator.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
// GET route
$app->get(
        '/', function () {
    
}
);



// POST route
$app->post(
        '/post', function () {
    
}
);

// PUT route
$app->put(
        '/put', function () {
    
}
);

// PATCH route
$app->patch('/patch', function () {
    
});

// DELETE route
$app->delete(
        '/delete', function () {
    
}
);


/**
 * Step 4: Configuring the routes
 */
$app->post('/add', 'add');
$app->post('/subtract', 'subtract');
$app->post('/multiply', 'multiply');
$app->post('/divide', 'divide');


/**
 * Step 5: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();

function logMsg($msg, $level = 'info') {

    $levelStr = '';
    switch ($level) {
        case 'info':
            $levelStr = 'INFO';
            break;

        case 'warning':
            $levelStr = 'WARNING';
            break;

        case 'error':
            $levelStr = 'ERROR';
            break;
    }

    $date = date('Y-m-d H:i:s');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // formate the message
    // 1o: actutal date
    // 2o: mensagem level (INFO, WARNING ou ERROR)
    // 3o: user IP
    // 4o: the message
    // 5o: /n
    $logMessage = sprintf("[%s] [%s] [%s]: %s%s", $date, $levelStr, $ip, $msg, PHP_EOL);

    $file = 'log/ApiLog_' . date('d_m_Y') . '.log';

    file_put_contents($file, $logMessage, FILE_APPEND);
}

function add() {
    logMsg("#####################################################");
    logMsg("ADD CALLED");

    $app = new \Slim\Slim();
    $calculator = new Calculator();

    if (is_numeric($app->request->params('number1')) && is_numeric($app->request->params('number2'))) {
        logMsg("NUMBER1: " . $app->request->params('number1'));
        logMsg("NUMBER2: " . $app->request->params('number2'));

        $calculator->setParameter('+');
        $calculator->setNumbers($app->request->params('number1'), $app->request->params('number2'));

        echo json_encode(array('result' => $calculator->getResult()));

        logMsg("RESULT RETURNED: " . $calculator->getResult());
    } else {
        logMsg("usuario nao foi autenticado com sucesso....email ");
        echo json_encode(array('result' => 'missing parameters'));
    }
    logMsg("#####################################################");
}

function subtract() {
    logMsg("#####################################################");
    logMsg("SUBSTRACT CALLED");

    $app = new \Slim\Slim();
    $calculator = new Calculator();

    if (is_numeric($app->request->params('number1')) && is_numeric($app->request->params('number2'))) {
        logMsg("NUMBER1: " . $app->request->params('number1'));
        logMsg("NUMBER2: " . $app->request->params('number2'));

        $calculator->setParameter('-');
        $calculator->setNumbers($app->request->params('number1'), $app->request->params('number2'));

        echo json_encode(array('result' => $calculator->getResult()));

        logMsg("RESULT RETURNED: " . $calculator->getResult());
    } else {
        logMsg("usuario nao foi autenticado com sucesso....email ");
        echo json_encode(array('result' => 'missing parameters'));
    }
    logMsg("#####################################################");
}

function multiply() {
    logMsg("#####################################################");
    logMsg("MULTIPLY CALLED");

    $app = new \Slim\Slim();
    $calculator = new Calculator();

    if (is_numeric($app->request->params('number1')) && is_numeric($app->request->params('number2'))) {
        logMsg("NUMBER1: " . $app->request->params('number1'));
        logMsg("NUMBER2: " . $app->request->params('number2'));

        $calculator->setParameter('*');
        $calculator->setNumbers($app->request->params('number1'), $app->request->params('number2'));

        echo json_encode(array('result' => $calculator->getResult()));

        logMsg("RESULT RETURNED: " . $calculator->getResult());
    } else {
        logMsg("usuario nao foi autenticado com sucesso....email ");
        echo json_encode(array('result' => 'missing parameters'));
    }
    logMsg("#####################################################");
}

function divide() {
    logMsg("#####################################################");
    logMsg("DIVIDE CALLED");

    $app = new \Slim\Slim();
    $calculator = new Calculator();

    if (is_numeric($app->request->params('number1')) && is_numeric($app->request->params('number2'))) {
        logMsg("NUMBER1: " . $app->request->params('number1'));
        logMsg("NUMBER2: " . $app->request->params('number2'));

        $calculator->setParameter('/');
        $calculator->setNumbers($app->request->params('number1'), $app->request->params('number2'));

        echo json_encode(array('result' => $calculator->getResult()));

        logMsg("RESULT RETURNED: " . $calculator->getResult());
    } else {
        logMsg("missing parameters");
        echo json_encode(array('result' => 'missing parameters'));
    }
    logMsg("#####################################################");
}
