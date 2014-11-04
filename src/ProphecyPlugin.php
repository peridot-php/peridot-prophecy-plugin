<?php
namespace Peridot\Plugin\Prophecy;

use Evenement\EventEmitterInterface;
use Peridot\Core\Suite;

class ProphecyPlugin
{
    /**
     * @var EventEmitterInterface
     */
    protected $emitter;

    /**
     * @var ProphecyScope
     */
    protected $scope;

    /**
     * @param EventEmitterInterface $emitter
     */
    public function __construct(EventEmitterInterface $emitter)
    {
        $this->emitter = $emitter;
        $this->scope = new ProphecyScope();
        $this->listen();
    }

    /**
     * @param Suite $suite
     */
    public function onSuiteStart(Suite $suite)
    {
        $suite->getScope()->peridotAddChildScope($this->scope);
        $prophet = $this->scope->getProphet();
        if (class_exists($suite->getDescription())) {
            $suite->getScope()->subject = $prophet->prophesize($suite->getDescription());
        }
    }

    /**
     * Listen for Peridot events
     */
    private function listen()
    {
        $this->emitter->on('suite.start', [$this, 'onSuiteStart']);
    }
} 
