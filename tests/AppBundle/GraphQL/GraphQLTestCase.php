<?php

declare(strict_types=1);

namespace App\Tests\GraphQL;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class GraphQLTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var string|null
     */
    protected $jsonResponse = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    protected function graphqlAssert(): void
    {
        $this->assertEquals(JsonResponse::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->jsonResponse = $this->client->getResponse()->getContent();
        $this->assertJson($this->jsonResponse);
    }

    /**
     * @return mixed
     */
    protected function decodeJsonResponseAsArray()
    {
        return json_decode($this->jsonResponse, true)['data'];
    }

    /**
     * @param string $query
     * @param array|null $variables
     * @param string|null $operationName
     */
    protected function queryRequest(string $query, array $variables = null, string $operationName = null)
    {
        $this->graphQLRequest('query', $query, $variables, $operationName);
    }

    /**
     * @param string $mutation
     * @param array|null $variables
     * @param string|null $operationName
     */
    protected function mutationRequest(string $mutation, array $variables = null, string $operationName = null)
    {
        $this->graphQLRequest('mutation', $mutation, $variables, $operationName);
    }

    /**
     * @param string $type
     * @param string $request
     * @param array|null $variables
     * @param string|null $operationName
     */
    private function graphQLRequest(string $type, string $request, array $variables = null, string $operationName = null)
    {
        $this->client->request(...[
            'POST',
            '/graphql/',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode([
                $type => $request,
                'variables' => $variables,
                'operationName' => $operationName
            ])
        ]);
    }
}
