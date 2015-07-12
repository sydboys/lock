<?php

namespace malkusch\lock;

/**
 * The mutex provides methods for locked execution.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license WTFPL
 */
abstract class Mutex
{
    
    /**
     * Executes a block of code non interruptable.
     *
     * This method implements Java's synchronized semantic.
     *
     * @param callable $block The synchronized execution block.
     * @return mixed The return value of the execution block.
     *
     * @throws \Exception The execution block threw an exception.
     * @throws MutexException The mutex could not be aquired or released.
     */
    abstract public function synchronized(callable $block);
    
    /**
     * Performs a double-checked locking pattern.
     *
     * Call {@link DoubleCheckedLocking::execute()} on the returned object.
     *
     * @return DoubleCheckedLocking The double-checked locking pattern.
     */
    public function check(callable $check)
    {
        $doubleCheckedLocking = new DoubleCheckedLocking($this);
        $doubleCheckedLocking->setCheck($check);
        return $doubleCheckedLocking;
    }
}
