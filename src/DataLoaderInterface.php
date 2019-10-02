<?php

/*
 * This file is part of the DataLoaderPhp package.
 *
 * (c) Overblog <http://github.com/overblog/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Overblog\DataLoader;

interface DataLoaderInterface
{
    /**
     * Loads a key, returning a `Promise` for the value represented by that key.
     *
     * @param string $key
     * @param mixed $context
     *
     * @return mixed return a Promise
     */
    public function load($key, $context = null);

    /**
     * Loads multiple keys, promising an array of values:
     *
     *     list($a, $b) = $myLoader->loadMany(['a', 'b']);
     *
     * This is equivalent to the more verbose:
     *
     *     list($a, $b) = \React\Promise\all([
     *       $myLoader->load('a'),
     *       $myLoader->load('b')
     *     ]);
     * @param array $keys
     * @param mixed $context
     *
     * @return mixed return a Promise
     */
    public function loadMany($keys, $context = null);

    /**
     * Clears the value at `key` from the cache with `context`, if it exists.
     *
     * @param $key
     * @param mixed $context
     * @return $this
     */
    public function clear($key, $context = null);

    /**
     * Clears the value at `key` from the cache, if it exists.
     *
     * @param $key
     * @param mixed $context
     * @return $this
     */
    public function clearKey($key);

    /**
     * Clears the entire cache. To be used when some event results in unknown
     * invalidations across this particular `DataLoader`.
     *
     * @return $this
     */
    public function clearAll();

    /**
     * Adds the provided key and value to the cache. If the key already exists, no
     * change is made. Returns itself for method chaining.
     * @param $key
     * @param $value
     * @param mixed $context
     * @return $this
     */
    public function prime($key, $value, $context = null);

    /**
     * @param $promise
     * @param bool $unwrap controls whether or not the value of the promise is returned for a fulfilled promise or if an exception is thrown if the promise is rejected
     * @return mixed
     * @throws \Exception
     */
    public static function await($promise = null, $unwrap = true);
}
