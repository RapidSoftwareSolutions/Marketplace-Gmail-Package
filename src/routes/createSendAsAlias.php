<?php
$app->post('/api/Gmail/createSendAsAlias', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'sendAsEmail']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $email = empty($post_data['args']['email']) ? "me" : $post_data['args']['email'];

    $query_str = $settings['api_url'] . 'users/' . $email . '/settings/sendAs';

    //requesting remote API
    $client = new GuzzleHttp\Client();
    $body['sendAsEmail'] = $post_data['args']['sendAsEmail'];

    if (!empty($post_data['args']['displayName'])) {
        $body['displayName'] = $post_data['args']['displayName'];
    }
    if (!empty($post_data['args']['isDefault'])) {
        $body['isDefault'] = $post_data['args']['isDefault'];
    }

    if (!empty($post_data['args']['replyToAddress'])) {
        $body['replyToAddress'] = $post_data['args']['replyToAddress'];
    }
    if (!empty($post_data['args']['sendAsEmail'])) {
        $body['sendAsEmail'] = $post_data['args']['sendAsEmail'];
    }
    if (!empty($post_data['args']['signature'])) {
        $body['signature'] = $post_data['args']['signature'];
    }
    if (!empty($post_data['args']['host'])) {
        $body['smtpMsa']['host'] = $post_data['args']['host'];
    }
    if (!empty($post_data['args']['password'])) {
        $body['smtpMsa']['password'] = $post_data['args']['password'];
    }
    if (!empty($post_data['args']['port'])) {
        $body['smtpMsa']['port'] = $post_data['args']['port'];
    }
    if (!empty($post_data['args']['securityMode'])) {
        $body['smtpMsa']['securityMode'] = $post_data['args']['securityMode'];
    }
    if (!empty($post_data['args']['username'])) {
        $body['smtpMsa']['username'] = $post_data['args']['username'];
    }
    if (!empty($post_data['args']['treatAsAlias'])) {
        $body['treatAsAlias'] = $post_data['args']['treatAsAlias'];
    }
    try {

        $resp = $client->request('POST', $query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' . $post_data['args']['accessToken']
            ],
            'json' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());
        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        $responseBody = $exception->getResponse()->getReasonPhrase();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $responseBody;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});