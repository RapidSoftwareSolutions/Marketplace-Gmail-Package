<?php
$app->post('/api/Gmail/importMessageIntoMailbox', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'raw']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $email = empty($post_data['args']['email']) ? "me" : $post_data['args']['email'];

    $query_str = $settings['api_url'] . 'users/' . $email . '/messages/import';

    //requesting remote API
    $client = new GuzzleHttp\Client();
    $body['raw'] = $post_data['args']['raw'];

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
    if (!empty($post_data['args']['labelIds'])) {
        $body['labelIds'] = $post_data['args']['labelIds'];
    }
    if (!empty($post_data['args']['historyId'])) {
        $body['historyId'] = $post_data['args']['historyId'];
    }
    if (!empty($post_data['args']['id'])) {
        $body['id'] = $post_data['args']['id'];
    }
    if (!empty($post_data['args']['payload'])) {
        $body['payload'] = $post_data['args']['payload'];
    }
    if (!empty($post_data['args']['sizeEstimate'])) {
        $body['sizeEstimate'] = $post_data['args']['sizeEstimate'];
    }
    if (!empty($post_data['args']['snippet'])) {
        $body['snippet'] = $post_data['args']['snippet'];
    }
    if (!empty($post_data['args']['threadId'])) {
        $body['threadId'] = $post_data['args']['threadId'];
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