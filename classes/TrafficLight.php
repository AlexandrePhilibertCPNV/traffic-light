<?php

abstract class LightState {
    const STOP = 0;
    const READY = 1;
    const GO = 2;
    const SLOW = 3;
    const PAUSE = 4;
}

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

    public $state = LightState::STOP;

    private $last_state;

    /**
     * @param int $state
     * 
     */
    public function set_state()
    {
        switch ($this->state) {
            case LightState::READY:
                $this->yellow = true;
                // no break here as red also needs to be turned on
            case LightState::STOP:
                $this->red = true;
                break;
            case LightState::GO:
                $this->green = true;
                break;
            case LightState::SLOW:
            case LightState::PAUSE:
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
        } else if ($this->last_state == LightState::PAUSE) {
            $this->state = LightState::STOP;
        } else {
            $this->state = ($this->last_state + 1) % 4;
        }

        $this->set_state();
        return $this->state;
    }

    private function is_next_state_allowed(int $next_state)
    {
        switch ($this->last_state) {
            case LightState::STOP:
                return $next_state == LightState::READY || $next_state ==  LightState::PAUSE;
            case LightState::READY:
                return $next_state == LightState::GO;
            case LightState::GO:
                return $next_state == LightState::SLOW || $next_state == LightState::PAUSE;
            case LightState::PAUSE:
                return $next_state == LightState::STOP || $next_state == LightState::PAUSE;
            default:
                return false;
        }
    }
}
