<?php

class TrafficLight
{

    /**
     * @var bool
     */
    public $red = false;

    /**
     * @var bool
     */
    public $yellow = false;

    /**
     * @var bool
     */
    public $green = false;

    /**
     * @param int $state
     * 
     */
    public function set_state(int $state = 0)
    {
        switch ($state) {
            case 1:
                $this->yellow = true;
                // no break here as red also needs to be turned on
            case 0:
                $this->red = true;
                break;
            case 2:
                $this->green = true;
                break;
            case 3:
                $this->yellow = true;
                break;
            default:
                $this->red = true;
                break;
        }
    }

    /**
     * @param int $state
     * 
     * @return int The next state
     */
    public function get_next_state(int $state = 1)
    {
        return ($state + 1) % 4;
    }
}
