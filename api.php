<?php

// api.php
// Include required classes

require_once 'class.create.php';
require_once 'class.edit.php';
require_once 'class.delete.php';
require_once 'class.manage.php';

// Set headers
header('Content-Type: application/json');

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Parse input data
$input = json_decode(file_get_contents('php://input'), true);

// Determine the action based on the request method
switch ($method) {
    case 'GET':
        // // Retrieve all users or a specific user if 'id' is provided
        // $manager = new Manage();
        // if (isset($_GET['id'])) {
        //     $data = $manager->renderUserTable();
        // } else {
        //     $data = $manager->getUsers();
        // }
        // echo json_encode($data);
        $uri = $_SERVER['REQUEST_URI'];

        // Parse the URL to handle different endpoints
        if (strpos($uri, '/pdo/api.php/users') !== false) {
            // If the URL contains '/users', check if an 'id' is provided
            $manager = new Manage();
            if (isset($_GET['id'])) {
                // Retrieve a specific user based on 'id'
                $data = $manager->renderUserTable();
            } else {
                // Retrieve all users if no 'id' is provided
                $data = $manager->getUsers();
            }
            echo json_encode($data);
        }
        //  elseif (strpos($uri, '/another-endpoint') !== false) {
        //     // Handle another URL (e.g., '/another-endpoint')
        //     $data = handleAnotherEndpoint();
        //     echo json_encode($data);
        // }
        break;

    case 'POST':
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, '/pdo/api.php/register') !== false) {
            // Create new user
            if (!isset($input['name']) || !isset($input['email'])) {
                echo json_encode(['error' => 'Missing required fields']);
                exit;
            }
            $creator = new UserCreate();
            $result = $creator->addUser($input['name'], $input['email']);
            echo json_encode(['success' => $result]);
        }
        break;

    case 'PUT':
        $uri = $_SERVER['REQUEST_URI'];
        if(strpos($uri, '/pdo/api.php/update') !== false) {
            // Update an existing user
            if (!isset($input['id']) || !isset($input['name']) || !isset($input['email'])) {
                echo json_encode(['error' => 'Missing required fields']);
                exit;
            }
            $editor = new Edit();
            $result = $editor->updateUser($input['id'], $input['name'], $input['email']);
            echo json_encode(['success' => $result]);
        }
        break;

    case 'DELETE':
        $uri = $_SERVER['REQUEST_URI'];
        // Delete a user
        if(strpos($uri, '/pdo/api.php/delete') !== false) {
        if (!isset($input['id'])) {
            echo json_encode(['error' => 'Missing user ID']);
            exit;
        }
        $deleter = new Delete();
        $result = $deleter->deleteUser($input['id']);
        echo json_encode(['success' => $result]);
         }
        break;

    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}
?>

