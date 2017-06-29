<?php
$app->post('/api/Gmail/createFilter', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $email = empty($post_data['args']['email']) ? "me" : $post_data['args']['email'];

    $query_str = $settings['api_url'] . 'users/' . $email . '/settings/filters';

    //requesting remote API
    $client = new GuzzleHttp\Client();
    if (!empty($post_data['args']['addLabelIds'])) {
        $body['action']['addLabelIds'] = $post_data['args']['addLabelIds'];
    }
    if (!empty($post_data['args']['removeLabelIds'])) {
        $body['action']['removeLabelIds'] = $post_data['args']['removeLabelIds'];
    }
    if (!empty($post_data['args']['forward'])) {
        $body['action']['forward'] = $post_data['args']['forward'];
    }
    if (!empty($post_data['args']['excludeChats'])) {
        $body['criteria']['excludeChats'] = $post_data['args']['excludeChats'];
    }
    if (!empty($post_data['args']['from'])) {
        $body['criteria']['from'] = $post_data['args']['from'];
    }
    if (!empty($post_data['args']['hasAttachment'])) {
        $body['criteria']['hasAttachment'] = $post_data['args']['hasAttachment'];
    }
    if (!empty($post_data['args']['negatedQuery'])) {
        $body['criteria']['negatedQuery'] = $post_data['args']['negatedQuery'];
    }
    if (!empty($post_data['args']['query'])) {
        $body['criteria']['query'] = $post_data['args']['query'];
    }
    if (!empty($post_data['args']['size'])) {
        $body['criteria']['size'] = $post_data['args']['size'];
    }
    if (!empty($post_data['args']['sizeComparison'])) {
        $body['criteria']['sizeComparison'] = $post_data['args']['sizeComparison'];
    }
    if (!empty($post_data['args']['subject'])) {
        $body['criteria']['subject'] = $post_data['args']['subject'];
    }
    if (!empty($post_data['args']['to'])) {
        $body['criteria']['to'] = $post_data['args']['to'];
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