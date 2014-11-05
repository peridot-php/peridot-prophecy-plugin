<?php
describe('Bird', function() {

    it('should fly and then land', function() {
        $this->subject->fly()->shouldBeCalled();
        $this->subject->land()->shouldBeCalled();
        $this->getProphet()->checkPredictions();
    });

    it('should fly', function() {
        $this->subject->fly()->shouldBeCalled();
        $this->subject->reveal()->fly();
        $this->getProphet()->checkPredictions();
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
