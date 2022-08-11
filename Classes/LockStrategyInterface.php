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
 * Contract for a lock strategy.
 *
 * @api
 */
interface LockStrategyInterface
{
    /**
     * @param string $subject
     * @param bool $exclusiveLock true to, acquire an exclusive (write) lock, false for a shared (read) lock.
     * @return void
     */
    public function acquire(string $subject, bool $exclusiveLock): void;

    /**
     * @return bool true on success, false otherwise
     */
    public function release(): bool;
}
