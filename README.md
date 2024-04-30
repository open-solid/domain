# Domain Events

## Installation

```bash
composer require open-solid/domain-event
```

## Usage

```php
<?php

use OpenSolid\DomainEvent\Bus\NativeDomainEventBus;
use OpenSolid\DomainEvent\DomainEvent;
use OpenSolid\Messenger\Bus\NativeLazyMessageBus;
use OpenSolid\Messenger\Bus\NativeMessageBus;
use OpenSolid\Messenger\Handler\HandlersLocator;
use OpenSolid\Messenger\Middleware\HandleMessageMiddleware;

final readonly class UserRegistered extends DomainEvent
{
}

final readonly class UserRegisteredSubscriber
{
    public function __invoke(UserRegistered $event): void
    {
        // Handle the event
    }
}

$nativeMessageBus = new NativeMessageBus([
    new HandleMessageMiddleware(
        new HandlersLocator([
            UserRegistered::class => [new UserRegisteredSubscriber()],
        ]),
    ),
]);
$bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

$bus->publish(new EntityUpdated('uuid'));
$bus->flush();
```

## License

This software is published under the [MIT License](LICENSE)
