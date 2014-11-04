<?php
use Evenement\EventEmitter;
use Peridot\Core\Suite;
use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Prophecy\Prophet;

describe('ProphecyPlugin', function () {

    beforeEach(function () {
        $this->emitter = new EventEmitter();
        $this->plugin = new ProphecyPlugin($this->emitter);
    });

    context('when suite.start event fires', function() {
        it('should set add the prophecy scope to the child scope', function() {
            $suite = new Suite("suite", function() {});
            $this->emitter->emit('suite.start', [$suite]);
            $prophet = $suite->getScope()->getProphet();
            assert($prophet instanceof Prophet, 'suite should be able to get a prophet');
        });

        it('should set a subject as mock if description is a class', function() {
            $suite = new Suite('Peridot\Core\Suite', function() {});
            $this->emitter->emit('suite.start', [$suite]);
            $dummy = $suite->getScope()->subject->reveal();
            assert($dummy instanceof Suite, "subject->reveal() should be instance of Suite");
        });
    });

});
