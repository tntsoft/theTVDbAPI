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
 *
 * Interface for the theTVDbAPI client.
 *
 * PHP version 7.1
 *
 * @category TheTVDbAPI
 * @package  CanIHaveSomeCoffee\TheTVDbAPI
 * @author   Willem Van Iseghem (canihavesomecoffee) <theTVDbAPI@canihavesome.coffee>
 * @license  See start of document
 * @link     https://canihavesome.coffee/projects/theTVDbAPI
 */
declare(strict_types = 1);

namespace CanIHaveSomeCoffee\TheTVDbAPI;

use Exception;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use CanIHaveSomeCoffee\TheTVDbAPI\Exception\ParseException;
use CanIHaveSomeCoffee\TheTVDbAPI\Exception\ResourceNotFoundException;
use CanIHaveSomeCoffee\TheTVDbAPI\Exception\UnauthorizedException;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\AuthenticationRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\EpisodesRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\LanguagesRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\SearchRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\SeriesRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\UpdatesRoute;
use CanIHaveSomeCoffee\TheTVDbAPI\Route\UsersRoute;

/**
 * Interface TheTVDbAPIInterface
 *
 * @category TheTVDbAPI
 * @package  CanIHaveSomeCoffee\TheTVDbAPI
 * @author   Willem Van Iseghem (canihavesomecoffee) <theTVDbAPI@canihavesome.coffee>
 * @license  See start of document
 * @link     https://canihavesome.coffee/projects/theTVDbAPI
 */
interface TheTVDbAPIInterface
{


    /**
     * Sets the authentication token.
     *
     * @param string $token A valid authentication token
     *
     * @return void
     */
    public function setToken(string $token = null);

    /**
     * Sets the language(s) that will be sent to the API for localized series information.
     *
     * @param array $languages An array with language abbreviation. E.g. en, nl or de.
     *
     * @return void
     */
    public function setAcceptedLanguages(array $languages);

    /**
     * Retrieves the language(s) that will be sent to the API for localized series information.
     *
     * @return array An array with language abbreviation. E.g. en, nl or de.
     */
    public function getAcceptedLanguages(): array;

    /**
     * Sets the version of the theTVDb API to call (e.g. 2.1.1).
     *
     * @param string $version Version in format x.y.z
     *
     * @return void
     * @throws InvalidArgumentException If the string doesn't match the format
     */
    public function setVersion(string $version);

    /**
     * Returns the authentication route object.
     *
     * @return AuthenticationRoute
     */
    public function authentication(): AuthenticationRoute;

    /**
     * Get language extension
     *
     * @return LanguagesRoute
     */
    public function languages(): LanguagesRoute;

    /**
     * Get episodes extension
     *
     * @return EpisodesRoute
     */
    public function episodes(): EpisodesRoute;

    /**
     * Get series extension
     *
     * @return SeriesRoute
     */
    public function series(): SeriesRoute;

    /**
     * Get search extension
     *
     * @return SearchRoute
     */
    public function search(): SearchRoute;

    /**
     * Get updates extension
     *
     * @return UpdatesRoute
     */
    public function updates(): UpdatesRoute;

    /**
     * Get users extension
     *
     * @return UsersRoute
     */
    public function users(): UsersRoute;

    /**
     * Makes a call to the API and return headers only.
     *
     * @param string $method  HTTP Method (post, getUserData, put, etc.)
     * @param string $path    Path to the API call
     * @param array  $options HTTP Client options
     *
     * @return array
     * @throws UnauthorizedException
     * @throws ResourceNotFoundException
     */
    public function requestHeaders($method, $path, array $options = []): array;

    /**
     * Perform an API call to theTVDb.
     *
     * @param string $method  HTTP Method (post, getUserData, put, etc.)
     * @param string $path    Path to the API call
     * @param array  $options HTTP Client options
     *
     * @return Response
     * @throws UnauthorizedException
     * @throws ResourceNotFoundException
     */
    public function performAPICall($method, $path, array $options = []): Response;

    /**
     * Perform an API call to theTVDb and return a JSON response
     *
     * @param string $method  HTTP Method (post, getUserData, put, etc.)
     * @param string $path    Path to the API call
     * @param array  $options HTTP Client options
     *
     * @return mixed
     * @throws ParseException
     * @throws UnauthorizedException
     * @throws ResourceNotFoundException
     * @throws Exception
     */
    public function performAPICallWithJsonResponse($method, $path, array $options = []);

    /**
     * Returns the JSON errors for the latest request.
     *
     * @return array An array of JSONError instances.
     */
    public function getLastJSONErrors(): array;

    /**
     * Returns the links from the latest request.
     *
     * @return array An array of link pages.
     */
    public function getLastLinks(): array;
}
