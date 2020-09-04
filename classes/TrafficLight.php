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

    public $state = 0;

    private $last_state;

    /**
     * @param int $state
     * 
     */
    public function set_state()
    {
        switch ($this->state) {
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
            case 4:
                $this->yellow = true;
                break;
            default:
                $this->red = true;
                break;
        }
    }

    public function last_state($last_state)
    {
        $this->last_state = $last_state;
    }

    /**
     * @param int $next_state
     * 
     * @return int The next state
     */
    public function set_next_state($next_state = null)
    {
        if (isset($this->last_state) && isset($next_state)) {
            if ($this->is_next_state_allowed($next_state)) {
                $this->state = $next_state;
            } else {
                $this->state = 0;
            }
        } else {
            $this->state = ($this->last_state + 1) % 4;
        }

        $this->set_state();
        return $this->state;
    }

    private function is_next_state_allowed(int $next_state)
    {
        switch ($this->last_state) {
            case 0:
                return $next_state == 1 || $next_state == 4;
            case 1:
                return $next_state == 2;
            case 2:
                return $next_state == 3 || $next_state == 4;
            case 4:
                return $next_state == 0 || $next_state == 4;
            default:
                return false;
        }
    }
}
