<?php
/**
 * Copyright (c) 2017, Willem Van Iseghem (canihavesomecoffee) <theTVDbAPI@canihavesome.coffee>
 *
 * Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is hereby
 * granted, provided that the above copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE INCLUDING ALL
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER
 * IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 */

declare(strict_types=1);

namespace CanIHaveSomeCoffee\TheTVDbAPI\Tests\Route;

use CanIHaveSomeCoffee\TheTVDbAPI\Model\UpdateInfo;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\UpdatesRoute;
use DateTime;

/**
 * Class UpdatesRouteTest
 *
 * @category TheTVDbAPI
 * @package  CanIHaveSomeCoffee\TheTVDbAPI\Tests
 * @author   Willem Van Iseghem (canihavesomecoffee) <theTVDbAPI@canihavesome.coffee>
 * @license  See start of document
 * @link     https://canihavesome.coffee/projects/theTVDbAPI
 */
class UpdatesRouteTest extends BaseRouteTest
{


    public function testFetchUpdates()
    {
        $from_time = 1495295674;
        $to_time = 1495295675;
        $options = ['query' => ['fromTime' => $from_time]];
        $options_both = ['query' => ['fromTime' => $from_time, 'toTime' => $to_time]];
        $this->parent->expects(static::exactly(2))->method('performAPICallWithJsonResponse')->with(
            static::equalTo('get'),
            static::equalTo('/updated/query'),
            static::logicalOr($options, $options_both)
        )->willReturn([['id' => 123, 'lastUpdated' => 1495295674], ['id' => 124, 'lastUpdated' => 1495295874]]);
        $instance = new UpdatesRoute($this->parent);
        $results = $instance->query(DateTime::createFromFormat('U', $from_time.''));
        static::assertContainsOnlyInstancesOf(UpdateInfo::class, $results);
        $both_results = $instance->query(DateTime::createFromFormat('U', $from_time.''), DateTime::createFromFormat('U', $to_time.''));
        static::assertContainsOnlyInstancesOf(UpdateInfo::class, $both_results);
    }
}
