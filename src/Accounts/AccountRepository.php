<?php namespace KBC\Accounts;

use KBC\EventSourcing\Events\DomainEvent;
use KBC\EventSourcing\Serialization\Deserializer;
use KBC\EventSourcing\Serialization\Serializer;
use KBC\Storages\EventStorage;

class AccountRepository {

    use Serializer, Deserializer;

    protected $storage;

    public function __construct(EventStorage $storage)
    {
        $this->storage = $storage;
    }

    public function save($model)
    {
        $events = $model->releaseEvents();

        array_map(function(DomainEvent $event) {
            $this->storage->storeEvent($this->serialize($event));
        }, $events);
    }

    public function replayAll()
    {
        $events = $this->storage->loadAll();

        foreach($events as $event) {
            if ($event) {
                $this->deserialize($event);
            }
        }
    }
}