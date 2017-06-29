<?php
$app->post('/api/Gmail/insertSendAsAliasSMIMEconfig', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'sendAsEmail', 'expiration']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $email = empty($post_data['args']['email']) ? "me" : $post_data['args']['email'];

    $query_str = $settings['api_url'] . 'users/' . $email . '/settings/sendAs/' . $post_data['args']['sendAsEmail'] . '/smimeInfo';

    //requesting remote API
    $client = new GuzzleHttp\Client();
    $dateTime = new DateTime();
    $body['expiration'] = $dateTime->getTimestamp();
    if (!empty($post_data['args']['issuerCn'])) {
        $body['issuerCn'] = $post_data['args']['issuerCn'];
    }
    if (!empty($post_data['args']['isDefault'])) {
        $body['isDefault'] = $post_data['args']['isDefault'];
    }
    if (!empty($post_data['args']['pem'])) {
        $body['pem'] = $post_data['args']['pem'];
    }
    if (!empty($post_data['args']['pkcs12'])) {
        $body['pkcs12'] = $post_data['args']['pkcs12'];
    }
    if (!empty($post_data['args']['encryptedKeyPassword'])) {
        $body['encryptedKeyPassword'] = $post_data['args']['encryptedKeyPassword'];
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