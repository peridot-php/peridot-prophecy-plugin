<?php
describe('Bird', function() {

    /**
     * Use after each to check mock assumptions 
     */
    afterEach(function() {
        $this->getProphet()->checkPredictions();
    });

    it('should fly and then land', function() {
        $this->subject->fly()->shouldBeCalled();
        $this->subject->land()->shouldBeCalled();
    });

    it('should fly', function() {
        $this->subject->fly()->shouldBeCalled();
        $this->subject->reveal()->fly();
    });
});



class Bird
{
    protected $flying = false;

    public function call()
    {
        return 'tweet';
    }

    public function fly()
    {
        $this->flying = true;
    }

    public function land()
    {
        $this->flying = false;
    }
}
