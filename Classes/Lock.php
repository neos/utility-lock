<?php
declare(strict_types=1);
namespace Neos\Utility\Lock;

/*
 * This file is part of the Neos.Utility.Lock package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

/**
 * A general lock class.
 *
 * @api
 */
class Lock
{
    /**
     * @var LockManager|null
     */
    protected static ?LockManager $lockManager;

    /**
     * @var LockStrategyInterface
     */
    protected LockStrategyInterface $lockStrategy;

    /**
     * @param string $subject
     * @param bool $exclusiveLock true to, acquire an exclusive (write) lock, false for a shared (read) lock. An exclusive lock ist the default.
     */
    public function __construct(string $subject, bool $exclusiveLock = true)
    {
        if (self::$lockManager === null) {
            return;
        }
        $this->lockStrategy = self::$lockManager->getLockStrategyInstance();
        $this->lockStrategy->acquire($subject, $exclusiveLock);
    }

    /**
     * @return LockStrategyInterface
     */
    public function getLockStrategy(): LockStrategyInterface
    {
        return $this->lockStrategy;
    }

    /**
     * Set the instance of LockManager to use.
     *
     * Must be nullable especially for testing
     *
     * @param LockManager|null $lockManager
     * @return void
     */
    public static function setLockManager(?LockManager $lockManager): void
    {
        static::$lockManager = $lockManager;
    }

    /**
     * Releases the lock
     * @return bool true on success, false otherwise
     */
    public function release(): bool
    {
        return $this->lockStrategy->release();
    }

    /**
     * Destructor, releases the lock
     * @return void
     */
    public function __destruct()
    {
        $this->release();
    }
}
