<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Components\Search;

/**
 * Class SearchController.
 */
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryTerm  = $options_query = $request->input('query_term', '');    // (optional) search query
        $size       = $request->input('count', 30);
        $page       = $request->input('page', 1);
        $scope      = $request->input('scope', 'all');
        $division   = $request->input('division', 'all');
        --$page;

        $articleResults     = array();
        $userResults        = array();
        $publicationResults = array();
        $discussionResults  = array();
        $resourceResults    = array();

        if (trim($options_query) != '') {
            $articleQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title', 'excerpt', 'keywords', 'source_url'],
                ],
            ];
            $userQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['first_name', 'last_name', 'email', 'organization_name', 'division', 'specializaiton', 'location'],
                ],
            ];
            $publicationQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title', 'description', 'publisher', 'institution', 'conference'],
                ],
            ];
            $discussionQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['title'],
                ],
            ];
            $resourceQuery = [
                'multi_match' => [
                    'query' => $options_query,
                    'fields' => ['name', 'url', 'country', 'region', 'divisions', 'keywords'],
                ],
            ];

            if ($scope == 'all') {
                $articleResults     = Search::queryArticles($page, $size, $articleQuery);
                $userResults        = Search::queryUsers($page, $size, $userQuery);
                $publicationResults = Search::queryPublications($page, $size, $publicationQuery);
                $discussionResults  = Search::queryDiscussions($page, $size, $discussionQuery);
                $resourceResults    = Search::queryResources($page, $size, $resourceQuery);
            } elseif ($scope == 'users') {
                $items = Search::queryArticles($page, $size, $articleQuery);
            } elseif ($scope == 'articles') {
                $items = Search::queryArticles($page, $size, $userQuery);
            } elseif ($scope == 'publications') {
                $items = Search::queryPublications($page, $size, $publicationQuery);
            } elseif ($scope == 'discussions') {
                $items = Search::queryDiscussions($page, $size, $discussionQuery);
            } elseif ($scope == 'resources') {
                $items = Search::queryResources($page, $size, $resourceQuery);
            }
        } else {
            $articleResults     = Search::queryArticles($page, $size);
            $userResults        = Search::queryUsers($page, $size);
            $publicationResults = Search::queryPublications($page, $size);
            $discussionResults  = Search::queryDiscussions($page, $size);
            $resourceResults    = Search::queryResources($page, $size);
        }

        $divisions = $allDivisions = Division::all();
        $searchBar = true;

        if ($scope == 'all' || trim($options_query) == '') {
            $articleTotalCount      = isset($articleResults['total'])       ? $articleResults['total']      : 0;
            $userTotalCount         = isset($userResults['total'])          ? $userResults['total']         : 0;
            $publicationTotalCount  = isset($publicationResults['total'])   ? $publicationResults['total']  : 0;
            $discussionTotalCount   = isset($discussionResults['total'])    ? $discussionResults['total']   : 0;
            $resourceTotalCount     = isset($resourceResults['total'])      ? $resourceResults['total']     : 0;

            $articleResults     = Search::formatElasticSearchToArray($articleResults['hits']);
            $userResults        = Search::formatElasticSearchToArray($userResults['hits']);
            $publicationResults = Search::formatElasticSearchToArray($publicationResults['hits']);
            $discussionResults  = Search::formatElasticSearchToArray($discussionResults['hits']);
            $resourceResults    = Search::formatElasticSearchToArray($resourceResults['hits']);

            return view('frontend.search.index', compact([
                'articleResults', 'userResults', 'publicationResults', 'discussionResults', 'resourceResults',
                'articleTotalCount', 'userTotalCount', 'publicationTotalCount', 'discussionTotalCount', 'resourceTotalCount',
                'searchBar', 'queryTerm', 'scope', 'allDivisions',
            ]));
        } else {
            $totalCount = isset($items['total']) ? $items['total'] : 0;
            $items      = Search::formatElasticSearchToArray($items['hits']);

            return view('frontend.search.results', compact([
                'items', 'totalCount',
                'searchBar', 'queryTerm', 'scope', 'division', 'divisions',
            ]));
        }
    }
}
