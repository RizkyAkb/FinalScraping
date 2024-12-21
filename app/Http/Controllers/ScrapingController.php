<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Publikasi;
use App\Models\Fakultas;
use App\Models\Prodi;

use Goutte\Client;

class ScrapingController extends Controller
{
    // Scraping Scopus
    public function scrapeScopus($scopus_id, $author_id)
    {
        $api_key = '2f3be97cfe6cc239b0a9f325a660d9c1'; // API Key Scopus
        $base_url = 'https://api.elsevier.com/content/';
        $articles = $this->get_scopus_articles($scopus_id, $api_key, $base_url);

        if ($articles) {
            foreach ($articles['search-results']['entry'] as $article) {
                Publikasi::create([
                    'author_id' => $author_id ?? 'Unknown',
                    'title' => $article['dc:title'] ?? 'Unknown',
                    'journal_name' => $article['prism:publicationName'] ?? 'Unknown',
                    'publication_date' => $article['prism:coverDate'] ?? null,
                    'doi' => $article['prism:doi'] ?? null,
                    'citations' => $article['citedby-count'] ?? 0,
                    'source' => 'scopus',
                ]);
            }
        } else {
            file_put_contents('scopus_error_log.txt', "Failed to scrape Scopus for author ID: $scopus_id\n", FILE_APPEND);
        }
    }

    // Scraping Google Scholar
    public function scrapeScholar($scholar_id, $author_id)
    {
        $base_url = 'https://scholar.google.com/citations?user=' . $scholar_id;
        $articles = $this->get_scholar_articles($base_url);

        if ($articles) {
            foreach ($articles as $article) {
                if (!empty($article['title']) && !empty($article['author_name'])) {
                    Publikasi::create([           
                        'author_id' => $author_id ?? 'Unknown',             
                        'title' => $article['title'],
                        'journal_name' => $article['journal_name'] ?? 'Unknown',
                        'publication_date' => $article['publication_date'] ?? null,
                        'citations' => $article['citations'] ?? 0,
                        'doi' => $article['doi'] ?? null,
                        'source' => 'scholar',
                    ]);
                }
            }
        } else {
            file_put_contents('scholar_error_log.txt', "Failed to scrape Scholar for user ID: $scholar_id\n", FILE_APPEND);
        }
    }

    public function scrapePublications()
    {
        $authors = DB::table('authors')->select('id_scopus', 'id_scholar', 'id')->get();
        $api_key = '2f3be97cfe6cc239b0a9f325a660d9c1';
        $base_url = 'https://api.elsevier.com/content/';

        foreach ($authors as $author) {
            if (!empty($author->id_scholar)) {
                $this->scrapeScholar($author->id_scholar, $author->id);
                sleep(2); // Delay to avoid quick scraping
            }
        }

        foreach ($authors as $author) {
            if (!empty($author->id_scopus)) {
                $this->scrapeScopus($author->id_scopus, $author->id);
                sleep(2); // Delay to avoid quick scraping
            }
        }

        return response()->json(['message' => 'Scraping publications complete!']);
    }

    // Get Scopus articles
    private function get_scopus_articles($scopus_id, $api_key, $base_url)
    {
        $endpoint = "search/scopus";
        $query = "AU-ID($scopus_id)";
        $url = $base_url . $endpoint . "?query=" . urlencode($query);
        $headers = ["X-ELS-APIKey: $api_key"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            file_put_contents('curl_error_log.txt', curl_error($ch), FILE_APPEND);
            return null;
        }
        curl_close($ch);

        return json_decode($response, true);
    }

    // Get Google Scholar articles using Goutte
    private function get_scholar_articles($base_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, seperti Gecko) Chrome/87.0.4280.66 Safari/537.36',
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            file_put_contents('curl_error_log.txt', curl_error($ch), FILE_APPEND);
            return null;
        }
        curl_close($ch);

        $dom = new \DOMDocument();
        @$dom->loadHTML($response);
        $xpath = new \DOMXPath($dom);
        $articles = [];

        foreach ($xpath->query('//tr[@class="gsc_a_tr"]') as $article) {
            $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article)->item(0);
            $title = $titleNode ? $titleNode->textContent : 'Unknown';

            $authorNode = $xpath->query('.//div[@class="gs_gray"]', $article)->item(0);
            $author = $authorNode ? $authorNode->textContent : 'Unknown';

            $journalNode = $xpath->query('.//div[@class="gs_gray"]', $article)->item(1);
            $journal = $journalNode ? $journalNode->textContent : 'Unknown';

            $yearNode = $xpath->query('.//span[@class="gsc_a_h gsc_a_hc gs_ibl"]', $article)->item(0);
            $year = $yearNode ? $yearNode->textContent : null;

            $citationNode = $xpath->query('.//a[contains(@href,"cites")]', $article)->item(0);
            $citations = $citationNode ? preg_replace('/\D/', '', $citationNode->textContent) : 0;

            if ($title !== 'Unknown') {
                $articles[] = [
                    'title' => $title,                    
                    'journal_name' => $journal,
                    'publication_date' => $year,
                    'citations' => $citations,
                    'doi' => null,
                ];
            }
        }

        return $articles;
    }
}
