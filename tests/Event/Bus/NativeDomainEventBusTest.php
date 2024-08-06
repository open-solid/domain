<?php

declare(strict_types=1);

/*
 * This file is part of OpenSolid package.
 *
 * (c) Yonel Ceruto <open@yceruto.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenSolid\Domain\Tests\Event\Bus;

use OpenSolid\Bus\Handler\MessageHandlersCountPolicy;
use OpenSolid\Bus\Handler\MessageHandlersLocator;
use OpenSolid\Bus\Middleware\HandlingMiddleware;
use OpenSolid\Bus\NativeLazyMessageBus;
use OpenSolid\Bus\NativeMessageBus;
use OpenSolid\Domain\Event\Bus\NativeEventBus;
use OpenSolid\Domain\Tests\Fixtures\Event\EntityCreated;
use PHPUnit\Framework\TestCase;

class NativeDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscribe(): void
    {
        $subscriber1 = function (EntityCreated $event): void {
            $this->addToAssertionCount(1);
        };

        $subscriber2 = function (EntityCreated $event): void {
            $this->addToAssertionCount(1);
        };

        $nativeMessageBus = new NativeMessageBus([
            new HandlingMiddleware(
                new MessageHandlersLocator([
                    EntityCreated::class => [$subscriber1, $subscriber2],
                ]), MessageHandlersCountPolicy::NO_HANDLER
            ),
        ]);
        $bus = new NativeEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityCreated('uuid'));
        $bus->flush();

        $this->assertSame(2, $this->numberOfAssertionsPerformed());
    }

    public function testNoSubscriberForEvent(): void
    {
        $this->expectNotToPerformAssertions();

        $nativeMessageBus = new NativeMessageBus([
            new HandlingMiddleware(
                new MessageHandlersLocator([]),
                MessageHandlersCountPolicy::NO_HANDLER,
            ),
        ]);
        $bus = new NativeEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityCreated('uuid'));
        $bus->flush();
    }
}
