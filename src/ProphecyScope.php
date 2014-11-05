<?php
namespace Peridot\Plugin\Prophecy;

use Peridot\Core\Scope;
use Prophecy\Prophet;

class ProphecyScope extends Scope
{
    /**
     * @var Prophet
     */
    protected $prophet;

    /**
     * @return Prophet
     */
    public function getProphet()
    {
        if (is_null($this->prophet)) {
            $this->prophet = new Prophet();
        }
        return $this->prophet;
    }

    /**
     * Sets the prophet to null
     */
    public function clearProphet()
    {
        $this->prophet = null;
    }
} 
