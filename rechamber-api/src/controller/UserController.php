<?php

namespace Controller;

class UserController
{
    public function handleGetRequest()
    {
        $responseData = array(
            'message' => 'GET request received for /api/v1/users'
        );
        return json_encode($responseData);
    }

    public function handlePostRequest()
    {
        // Retrieve the request data
        $requestData = json_decode(file_get_contents('php://input'), true);

        $responseData = array(
            'message' => 'POST request received for /api/v1/users',
            'data' => $requestData
        );
        return json_encode($responseData);
    }
}
