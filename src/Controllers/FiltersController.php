<?php
/*
 * Pipedrive
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace Pipedrive\Controllers;

use Pipedrive\APIException;
use Pipedrive\APIHelper;
use Pipedrive\Configuration;
use Pipedrive\Models;
use Pipedrive\Exceptions;
use Pipedrive\Http\HttpRequest;
use Pipedrive\Http\HttpResponse;
use Pipedrive\Http\HttpMethod;
use Pipedrive\Http\HttpContext;
use Pipedrive\OAuthManager;
use Pipedrive\Servers;
use Pipedrive\Utils\CamelCaseHelper;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class FiltersController extends BaseController
{
    /**
     * @var FiltersController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return FiltersController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Marks multiple filters as deleted.
     *
     * @param string $ids Comma-separated filter IDs to delete
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function deleteMultipleFiltersInBulk(
        $ids
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'ids' => $ids,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Returns data about all filters
     *
     * @param string $type (optional) Types of filters to fetch
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getAllFilters(
        $type = null
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'type' => $type,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Adds a new filter, returns the ID upon success. Note that in the conditions json object only one
     * first-level condition group is supported, and it must be glued with 'AND', and only two second level
     * condition groups are supported of which one must be glued with 'AND' and the second with 'OR'. Other
     * combinations do not work (yet) but the syntax supports introducing them in future. For more
     * information on how to add a new filter, see <a href="https://pipedrive.readme.io/docs/adding-a-
     * filter" target="_blank" rel="noopener noreferrer">this tutorial</a>.
     *
     * @param  array  $options    Array with all options for search
     * @param string $options['name']       Filter name
     * @param string $options['conditions'] Filter conditions as a JSON object. It requires a minimum structure as
     *                                      follows: {"glue":"and","conditions":[{"glue":"and","conditions":
     *                                      [CONDITION_OBJECTS]},{"glue":"or","conditions":[CONDITION_OBJECTS]}]}.
     *                                      Replace CONDITION_OBJECTS with JSON objects of the following structure:
     *                                      {"object":"","field_id":"", "operator":"","value":"", "extra_value":""} or
     *                                      leave the array empty. Depending on the object type you should use another
     *                                      API endpoint to get field_id. There are five types of objects you can
     *                                      choose from: "person", "deal", "organization", "product", "activity" and
     *                                      you can use these types of operators depending on what type of a field you
     *                                      have: "IS NOT NULL", "IS NULL", "<=", ">=", "<", ">", "!=", "=", "LIKE
     *                                      '%$%'", "NOT LIKE '%$%'", "LIKE '$%'", "NOT LIKE '$%'", "LIKE '%$'", "NOT
     *                                      LIKE '%$'". To get a better understanding of how filters work try creating
     *                                      them directly from the Pipedrive application.
     * @param string $options['type']       Type of filter to create.
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function addANewFilter(
        $options
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //prepare parameters
        $_parameters = array (
            'name'       => $this->val($options, 'name'),
            'conditions' => $this->val($options, 'conditions'),
            'type'     => APIHelper::prepareFormFields($this->val($options, 'type'))
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl, $_parameters);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Form($_parameters));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Returns all supported filter helpers. It helps to know what conditions and helpers are available
     * when you want to <a href="/docs/api/v1/#!/Filters/post_filters">add</a> or <a href="/docs/api/v1/#!
     * /Filters/put_filters_id">update</a> filters. For more information on how filter’s helpers can be
     * used, see <a href="https://pipedrive.readme.io/docs/adding-a-filter" target="_blank" rel="noopener
     * noreferrer">this tutorial</a>.
     *
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getAllFilterHelpers()
    {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters/helpers';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Marks a filter as deleted.
     *
     * @param integer $id ID of the filter
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function deleteAFilter(
        $id
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Returns data about a specific filter. Note that this also returns the condition lines of the filter.
     *
     * @param integer $id ID of the filter
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getOneFilter(
        $id
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }

    /**
     * Updates existing filter.
     *
     * @param  array  $options    Array with all options for search
     * @param integer $options['id']         ID of the filter
     * @param string  $options['conditions'] Filter conditions as a JSON object. It requires a minimum structure as
     *                                       follows: {"glue":"and","conditions":[{"glue":"and","conditions":
     *                                       [CONDITION_OBJECTS]},{"glue":"or","conditions":[CONDITION_OBJECTS]}]}.
     *                                       Replace CONDITION_OBJECTS with JSON objects of the following structure:
     *                                       {"object":"","field_id":"", "operator":"","value":"", "extra_value":""} or
     *                                       leave the array empty. Depending on the object type you should use another
     *                                       API endpoint to get field_id. There are five types of objects you can
     *                                       choose from: "person", "deal", "organization", "product", "activity" and
     *                                       you can use these types of operators depending on what type of a field you
     *                                       have: "IS NOT NULL", "IS NULL", "<=", ">=", "<", ">", "!=", "=", "LIKE
     *                                       '%$%'", "NOT LIKE '%$%'", "LIKE '$%'", "NOT LIKE '$%'", "LIKE '%$'", "NOT
     *                                       LIKE '%$'". To get a better understanding of how filters work try creating
     *                                       them directly from the Pipedrive application.
     * @param string  $options['name']       (optional) Filter name
     * @return \Pipedrive\Utils\JsonSerializer response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function updateFilter(
        $options
    ) {
        //check or get oauth token
        OAuthManager::getInstance()->checkAuthorization();

        //prepare query string for API call
        $_queryBuilder = '/filters/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'         => $this->val($options, 'id'),
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri() . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Authorization' => sprintf('Bearer %1$s', Configuration::$oAuthToken->accessToken)
        );

        //prepare parameters
        $_parameters = array (
            'conditions' => $this->val($options, 'conditions'),
            'name'       => $this->val($options, 'name')
        );

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl, $_parameters);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers, Request\Body::Form($_parameters));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return CamelCaseHelper::keysToCamelCase($response->body);
    }


    /**
    * Array access utility method
     * @param  array          $arr         Array of values to read from
     * @param  string         $key         Key to get the value from the array
     * @param  mixed|null     $default     Default value to use if the key was not found
     * @return mixed
     */
    private function val($arr, $key, $default = null)
    {
        if (isset($arr[$key])) {
            return is_bool($arr[$key]) ? var_export($arr[$key], true) : $arr[$key];
        }
        return $default;
    }
}
