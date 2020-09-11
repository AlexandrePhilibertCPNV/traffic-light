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

    public $last_state;

    /**
     * @param int $state
     * 
     */
    public function set_lights()
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

    /**
     * @param int $next_state
     * 
     * @return int The state to display
     */
    public function set_next_state($next_state = null)
    {
        if (isset($next_state)) {
            if ($this->is_next_state_allowed($next_state)) {
                $this->state = $next_state;
            } else {
                // Keep old state if we were not allowed to change
                $this->state = $this->last_state;
                $this->set_lights();
                return $this->state;
            }
        } else if ($this->last_state == LightState::PAUSE) {
            // Always default to false when comming from PAUSE state
            $this->state = LightState::STOP;
        } else {
            $this->state = ($this->last_state + 1) % 4;
        }

        $this->set_lights();
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
