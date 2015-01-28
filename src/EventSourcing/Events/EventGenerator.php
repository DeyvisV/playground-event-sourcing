<?php namespace KBC\EventSourcing\Events;

trait EventGenerator {

    protected $recordedEvents;

    public function releaseEvents()
    {
        $events = $this->recordedEvents;

        $this->recordedEvents = [];

        return $events;
    }

    public function recordThat(DomainEvent $event)
    {
        $this->recordedEvents[] = $event;
    }

}