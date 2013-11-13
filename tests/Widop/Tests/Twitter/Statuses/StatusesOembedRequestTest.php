<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Statuses;

use Widop\Twitter\Statuses\StatusesOembedRequest;

/**
 * Statuses oembed request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesOembedRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Statuses\StatusesOembedRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesOembedRequest('123', 'foo.com');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\AbstractRequest', $this->request);
        $this->assertSame('/statuses/oembed.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertSame('123', $this->request->getId());
        $this->assertSame('foo.com', $this->request->getUrl());
        $this->assertNull($this->request->getMaxWidth());
        $this->assertNull($this->request->getHideMedia());
        $this->assertNull($this->request->getHideThread());
        $this->assertNull($this->request->getOmitScript());
        $this->assertNull($this->request->getAlign());
        $this->assertNull($this->request->getRelated());
        $this->assertNull($this->request->getLang());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testUrl()
    {
        $this->request->setUrl('foo.fr');

        $this->assertSame('foo.fr', $this->request->getUrl());
    }

    public function testMaxWidth()
    {
        $this->request->setMaxWidth(200);

        $this->assertSame(200, $this->request->getMaxWidth());
    }

    public function testHideMedia()
    {
        $this->request->setHideMedia(true);

        $this->assertTrue($this->request->getHideMedia());
    }

    public function testHideThread()
    {
        $this->request->setHideThread(true);

        $this->assertTrue($this->request->getHideThread());
    }

    public function testOmitScript()
    {
        $this->request->setOmitScript(true);

        $this->assertTrue($this->request->getOmitScript());
    }

    public function testAlign()
    {
        $this->request->setAlign('foo');

        $this->assertSame('foo', $this->request->getAlign());
    }

    public function testRelated()
    {
        $this->request->setRelated('foo');

        $this->assertSame('foo', $this->request->getRelated());
    }

    public function testLang()
    {
        $this->request->setLang('fr');

        $this->assertSame('fr', $this->request->getLang());
    }

    public function testSignatureUrl()
    {
        $this->request->setBaseUrl('https://api.twitter.com/oauth');

        $this->assertSame('https://api.twitter.com/oauth/statuses/oembed.json', $this->request->getSignatureUrl());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetGetParametersWithoutId()
    {
        $this->request->setId(null);

        $this->request->getGetParameters();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetGetParametersWithoutUrl()
    {
        $this->request->setUrl(null);

        $this->request->getGetParameters();
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setMaxWidth(200);
        $this->request->setHideMedia(true);
        $this->request->setHideThread(true);
        $this->request->setOmitScript(true);
        $this->request->setAlign('center');
        $this->request->setRelated('foo');
        $this->request->setLang('fr');

        $expected = array(
            'id'          => '123',
            'url'         => 'foo.com',
            'maxwidth'    => '200',
            'hide_media'  => '1',
            'hide_thread' => '1',
            'omit_script' => '1',
            'align'       => 'center',
            'related'     => 'foo',
            'lang'        => 'fr',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
