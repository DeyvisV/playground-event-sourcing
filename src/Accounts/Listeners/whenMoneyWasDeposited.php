<?php namespace KBC\Accounts\Listeners;

use KBC\EventSourcing\Events\DomainEvent;
use KBC\EventSourcing\Events\Listener;

class whenMoneyWasDeposited implements Listener {

    public function handle(DomainEvent $event)
    {
        var_dump("€{$event->amount} has been deposited.");
    }
}