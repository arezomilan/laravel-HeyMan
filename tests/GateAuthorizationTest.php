<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Imanghafoori\HeyMan\Facades\HeyMan;

class GateAuthorizationTest extends TestCase
{
    public function testGate()
    {
        setUp::run($this);

        Gate::define('helloGate', function ($user, $bool, $yool) {
            return $yool;
        });

        HeyMan::whenEventHappens('myEvent')->thisGateShouldAllow('helloGate', false, false)->otherwise()->weDenyAccess();

        $this->expectException(AuthorizationException::class);

        event('myEvent');
    }

    public function testGateAsMethod()
    {
        setUp::run($this);

        HeyMan::whenEventHappens('myEvent')->thisGateShouldAllow('Gates@helloGate', false)->otherwise()->weDenyAccess();

        $this->expectException(AuthorizationException::class);

        event('myEvent');
    }

}