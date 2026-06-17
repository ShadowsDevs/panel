<?php

namespace Shadowdactyl\Tests\Unit\Http\Middleware;

use Shadowdactyl\Tests\TestCase;
use Shadowdactyl\Tests\Traits\Http\RequestMockHelpers;
use Shadowdactyl\Tests\Traits\Http\MocksMiddlewareClosure;
use Shadowdactyl\Tests\Assertions\MiddlewareAttributeAssertionsTrait;

abstract class MiddlewareTestCase extends TestCase
{
    use MiddlewareAttributeAssertionsTrait;
    use MocksMiddlewareClosure;
    use RequestMockHelpers;

    /**
     * Setup tests with a mocked request object and normal attributes.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->buildRequestMock();
    }
}
