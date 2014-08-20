<?php

class InvariantViolationException extends Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return 'Invariant violation: ' . $this->message . '\n' . $this->getTraceAsString();
    }
}