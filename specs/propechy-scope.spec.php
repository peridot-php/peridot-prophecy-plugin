<?php
use Peridot\Plugin\Prophecy\ProphecyScope;
use Prophecy\Prophet;

describe('ProphecyScope', function() {

    beforeEach(function() {
        $this->scope = new ProphecyScope();
    });

    describe('->getProphet()', function() {
        it('should return a prophet object', function() {
            $prophet = $this->scope->getProphet();
            assert($prophet instanceof Prophet, "Prophet should have been returned");
        });

        it('should return the same prophet object', function() {
            $prophet = $this->scope->getProphet();
            $again = $this->scope->getProphet();
            assert($prophet === $again, "should be same prophet");
        });
    });
});
