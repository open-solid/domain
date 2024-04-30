<?php

namespace OpenSolid\DomainEvent\Tests\Bus;

use OpenSolid\DomainEvent\Bus\NativeDomainEventBus;
use OpenSolid\DomainEvent\DomainEvent;
use PHPUnit\Framework\TestCase;
use OpenSolid\Messenger\Bus\NativeLazyMessageBus;
use OpenSolid\Messenger\Bus\NativeMessageBus;
use OpenSolid\Messenger\Handler\HandlersCountPolicy;
use OpenSolid\Messenger\Handler\HandlersLocator;
use OpenSolid\Messenger\Middleware\HandleMessageMiddleware;

class NativeDomainEventBusTest extends TestCase
{
    public function testPublishAndSubscribe(): void
    {
        $subscriber1 = function (EntityUpdated $event): void {
            $this->addToAssertionCount(1);
        };

        $subscriber2 = function (EntityUpdated $event): void {
            $this->addToAssertionCount(1);
        };

        $nativeMessageBus = new NativeMessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator([
                    EntityUpdated::class => [$subscriber1, $subscriber2],
                ]), HandlersCountPolicy::NO_HANDLER
            ),
        ]);
        $bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityUpdated('uuid'));
        $bus->flush();

        $this->assertSame(2, $this->numberOfAssertionsPerformed());
    }

    public function testNoSubscriberForEvent(): void
    {
        $this->expectNotToPerformAssertions();

        $nativeMessageBus = new NativeMessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator([]),
                HandlersCountPolicy::NO_HANDLER,
            ),
        ]);
        $bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

        $bus->publish(new EntityUpdated('uuid'));
        $bus->flush();
    }
}

final readonly class EntityUpdated extends DomainEvent
{
}
