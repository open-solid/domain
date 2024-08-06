# Domain Events implementation

Domain events are significant occurrences within a software system that 
reflect changes in the state of the domain. These events are used to 
capture and communicate changes, allowing different parts of the system 
to react accordingly. 

For example, in an e-commerce application, a domain event might be 
"OrderPlaced" when a customer completes a purchase. This event can then 
trigger other actions such as updating inventory, sending a confirmation 
email, or processing payment. Domain events help to decouple systems, 
making them more modular and easier to maintain, as each component can 
independently respond to changes without being tightly integrated.

## Installation

```bash
composer require open-solid/domain-event
```

## Usage

```php
<?php

use OpenSolid\Bus\Handler\MessageHandlersLocator;
use OpenSolid\Bus\Middleware\HandlingMiddleware;
use OpenSolid\Bus\NativeLazyMessageBus;
use OpenSolid\Bus\NativeMessageBus;
use OpenSolid\DomainEvent\Bus\NativeDomainEventBus;
use OpenSolid\DomainEvent\DomainEvent;

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
    new HandlingMiddleware(
        new MessageHandlersLocator([
            UserRegistered::class => [new UserRegisteredSubscriber()],
        ]),
    ),
]);
$bus = new NativeDomainEventBus(new NativeLazyMessageBus($nativeMessageBus));

$bus->publish(new EntityUpdated('uuid'));

// do something in between ...

$bus->flush();
```

## License

This software is published under the [MIT License](LICENSE)
