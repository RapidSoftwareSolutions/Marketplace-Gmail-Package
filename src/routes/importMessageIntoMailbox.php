<?php
$app->post('/api/Gmail/importMessageIntoMailbox', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $post_data = $request->getParsedBody();
    //forming request to vendor API
    $email = empty($post_data['args']['email']) ? "me" : $post_data['args']['email'];

    $query_str = $settings['api_url'] . 'users/' . $email . '/messages/import';

    //requesting remote API
    $client = new GuzzleHttp\Client();
    $body['raw'] = \Models\EmailEncoder::base64url_encode($post_data['args']['raw']);

    if (!empty($post_data['args']['deleted'])) {
        $body['deleted'] = $post_data['args']['deleted'];
    }
    if (!empty($post_data['args']['internalDateSource'])) {
        $body['internalDateSource'] = $post_data['args']['internalDateSource'];
    }
    if (!empty($post_data['args']['internalDate'])) {
        $body['internalDate'] = $post_data['args']['internalDate'];
    }
    if (!empty($post_data['args']['neverMarkSpam'])) {
        $body['neverMarkSpam'] = $post_data['args']['neverMarkSpam'];
    }
    if (!empty($post_data['args']['processForCalendar'])) {
        $body['processForCalendar'] = $post_data['args']['processForCalendar'];
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
        $responseBody = $exception->getResponse()->getBody()->getContents();
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