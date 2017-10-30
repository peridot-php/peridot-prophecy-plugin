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
        $this->listen();
    }

    /**
     * @param Suite $suite
     */
    public function onSuiteStart(Suite $suite)
    {
        $suite->getScope()->peridotAddChildScope(new ProphecyScope());
        $description = $suite->getDescription();

            $suite->addSetupFunction(function () use ($description) {
                $prophet = $this->getProphet();
                if (class_exists($description)) {
                    $this->subject = $prophet->prophesize($description);
                }
            });

            $suite->addTearDownFunction(function () {
                $this->clearProphet();
            });
    }

    /**
     * Listen for Peridot events
     */
    private function listen()
    {
        $this->emitter->on('suite.start', [$this, 'onSuiteStart']);
    }
} 
