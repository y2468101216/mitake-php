<?php

namespace Mitake\Tests\Message;

use Mitake\Message\Response;
use Mitake\Message\Result;
use Mitake\Message\StatusCode;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 * @package Mitake\Tests\Message
 */
class ResponseTest extends TestCase
{
    /**
     * @return Response
     */
    public function testConstruct()
    {
        $result = (new Result())
            ->setMsgid('1234567890')
            ->setStatuscode(new StatusCode('4'));
        $resp = (new Response())
            ->addResult($result)
            ->setAccountPoint(99);

        $this->assertEquals([$result], $resp->getResults());
        $this->assertEquals(99, $resp->getAccountPoint());

        $resp->setResults([$result]);

        $this->assertEquals([$result], $resp->getResults());

        return $resp;
    }

    /**
     * @depends testConstruct
     * @param Response $obj
     */
    public function testToArray($obj)
    {
        $expected = [
            'results' => [
                [
                    'msgid' => '1234567890',
                    'statuscode' => '4',
                ],
            ],
            'accountPoint' => 99,
        ];

        $this->assertEquals($expected, $obj->toArray());
    }
}
