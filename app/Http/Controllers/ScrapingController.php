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
    public function scrapePublicationsFrontend(Request $request)
    {
        $filter = [
            'dosen_id' => $request->input('dosen_id'),
            'prodi_id' => $request->input('prodi_id'),
            'fakultas_id' => $request->input('fakultas_id'),
        ];
        $startYear = $request->input('startYear');
        $endYear = $request->input('endYear');

        // Panggil fungsi scrapePublications
        $this->scrapePublications($filter, $startYear, $endYear);

        return back()->with('success', 'Scraping berhasil dimulai!');
    }
    
    // Scraping Scopus
    public function scrapeScopus($scopus_id, $author_id)
    {
        $api_key = '2f3be97cfe6cc239b0a9f325a660d9c1'; // API Key Scopus
        $base_url = 'https://api.elsevier.com/content/';
        $articles = $this->get_scopus_articles($scopus_id, $api_key, $base_url);

        if ($articles) {
            foreach ($articles['search-results']['entry'] as $article) {
                $doi = $article['prism:doi'] ?? null;

                // Cari publikasi berdasarkan DOI
                $existingPublication = Publikasi::where('doi', $doi)->first();

                // Data yang akan dimasukkan atau diperbarui
                $newData = [
                    'author_id' => $author_id ?? 'Unknown',
                    'title' => $article['dc:title'] ?? 'Unknown',
                    'journal_name' => $article['prism:publicationName'] ?? 'Unknown',
                    'publication_date' => $article['prism:coverDate'] ?? null,
                    'citations' => $article['citedby-count'] ?? 0,
                    'source' => 'scopus',
                ];

                if ($existingPublication) {
                    // Periksa apakah ada perubahan di kolom lain
                    $isUpdated = false;
                    foreach ($newData as $key => $value) {
                        if ($existingPublication->$key !== $value) {
                            $isUpdated = true;
                            break;
                        }
                    }

                    // Jika ada perubahan, lakukan pembaruan data
                    if ($isUpdated) {
                        $existingPublication->update($newData);
                    }
                } else {
                    // Jika DOI belum ada, tambahkan data baru
                    Publikasi::create(array_merge($newData, ['doi' => $doi]));
                }
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
                    $doi = $article['doi'] ?? null;

                    // Cari publikasi berdasarkan DOI
                    $existingPublication = Publikasi::where('doi', $doi)->first();

                    // Data yang akan dimasukkan atau diperbarui
                    $newData = [
                        'author_id' => $author_id ?? 'Unknown',
                        'title' => $article['title'],
                        'journal_name' => $article['journal_name'] ?? 'Unknown',
                        'publication_date' => $article['publication_date'] ?? null,
                        'citations' => $article['citations'] ?? 0,
                        'source' => 'scholar',
                    ];

                    if ($existingPublication) {
                        // Periksa apakah ada perubahan di kolom lain
                        $isUpdated = false;
                        foreach ($newData as $key => $value) {
                            if ($existingPublication->$key !== $value) {
                                $isUpdated = true;
                                break;
                            }
                        }

                        // Jika ada perubahan, lakukan pembaruan data
                        if ($isUpdated) {
                            $existingPublication->update($newData);
                        }
                    } else {
                        // Jika DOI belum ada, tambahkan data baru
                        Publikasi::create(array_merge($newData, ['doi' => $doi]));
                    }
                }
            }
        } else {
            file_put_contents('scholar_error_log.txt', "Failed to scrape Scholar for user ID: $scholar_id\n", FILE_APPEND);
        }
    }

    public function scrapePublications($filter = [], $startYear = null, $endYear = null)
    {
        // Ambil data author sesuai filter
        $authors = DB::table('users')
            ->select('scopus_id', 'scholar_id', 'id')
            ->where('role', 'dosen')
            ->when(isset($filter['dosen_id']), function ($query) use ($filter) {
                $query->where('id', $filter['dosen_id']);
            })
            ->when(isset($filter['prodi_id']), function ($query) use ($filter) {
                $query->where('prodi_id', $filter['prodi_id']);
            })
            ->when(isset($filter['fakultas_id']), function ($query) use ($filter) {
                $query->where('fakultas_id', $filter['fakultas_id']);
            })
            ->get();

        // Loop melalui setiap author dan scrape data
        foreach ($authors as $author) {
            if (!empty($author->scholar_id)) {
                if ($startYear && $endYear) {
                    // Scrape Scholar berdasarkan rentang tahun
                    $this->scrapeScholarByYearRange($author->scholar_id, $author->id, $startYear, $endYear);
                } else {
                    $this->scrapeScholar($author->scholar_id, $author->id);
                }
                sleep(2); // Delay untuk menghindari scraping terlalu cepat
            }
            if (!empty($author->scopus_id)) {
                if ($startYear && $endYear) {
                    // Scrape Scopus berdasarkan rentang tahun
                    $this->scrapeScopusByYearRange($author->scopus_id, $author->id, $startYear, $endYear);
                } else {
                    $this->scrapeScopus($author->scopus_id, $author->id);
                }
                sleep(2); // Delay untuk menghindari scraping terlalu cepat
            }
        }

        return response()->json(['message' => 'Scraping publications complete!']);
    }


    public function scrapePublicationsByProdi($prodi_id)
    {
        $this->scrapePublications(['prodi_id' => $prodi_id]);
    }

    public function scrapePublicationsByFakultas($fakultas_id)
    {
        $this->scrapePublications(['fakultas_id' => $fakultas_id]);
    }

    public function scrapePublicationsByDosen($dosen_id)
    {
        $this->scrapePublications(['dosen_id' => $dosen_id]);
    }

    public function scrapeScopusByYearRange($scopus_id, $author_id, $startYear, $endYear)
    {
        $api_key = '2f3be97cfe6cc239b0a9f325a660d9c1'; // API Key Scopus
        $base_url = 'https://api.elsevier.com/content/';
        $articles = $this->get_scopus_articles($scopus_id, $api_key, $base_url);

        if ($articles) {
            foreach ($articles['search-results']['entry'] as $article) {
                // Pastikan artikel memiliki tanggal publikasi
                if (!empty($article['prism:coverDate'])) {
                    $publicationYear = (int)date('Y', strtotime($article['prism:coverDate']));

                    // Hanya proses artikel dalam rentang tahun yang ditentukan
                    if ($publicationYear >= $startYear && $publicationYear <= $endYear) {
                        $doi = $article['prism:doi'] ?? null;

                        // Cari publikasi berdasarkan DOI
                        $existingPublication = Publikasi::where('doi', $doi)->first();

                        // Data yang akan dimasukkan atau diperbarui
                        $newData = [
                            'author_id' => $author_id ?? 'Unknown',
                            'title' => $article['dc:title'] ?? 'Unknown',
                            'journal_name' => $article['prism:publicationName'] ?? 'Unknown',
                            'publication_date' => $article['prism:coverDate'] ?? null,
                            'citations' => $article['citedby-count'] ?? 0,
                            'source' => 'scopus',
                        ];

                        if ($existingPublication) {
                            // Periksa apakah ada perubahan di kolom lain
                            $isUpdated = false;
                            foreach ($newData as $key => $value) {
                                if ($existingPublication->$key !== $value) {
                                    $isUpdated = true;
                                    break;
                                }
                            }

                            // Jika ada perubahan, lakukan pembaruan data
                            if ($isUpdated) {
                                $existingPublication->update($newData);
                            }
                        } else {
                            // Jika DOI belum ada, tambahkan data baru
                            Publikasi::create(array_merge($newData, ['doi' => $doi]));
                        }
                    }
                }
            }
        } else {
            file_put_contents('scopus_error_log.txt', "Failed to scrape Scopus for author ID: $scopus_id\n", FILE_APPEND);
        }
    }

    public function scrapeScholarByYearRange($scholar_id, $author_id, $startYear, $endYear)
    {
        $base_url = 'https://scholar.google.com/citations?user=' . $scholar_id;
        $articles = $this->get_scholar_articles($base_url);

        if ($articles) {
            foreach ($articles as $article) {
                // Pastikan artikel memiliki informasi tanggal publikasi
                if (!empty($article['publication_date'])) {
                    $publicationYear = (int)$article['publication_date'];

                    // Hanya proses artikel dalam rentang tahun yang ditentukan
                    if ($publicationYear >= $startYear && $publicationYear <= $endYear) {
                        if (!empty($article['title']) && !empty($article['author_name'])) {
                            $doi = $article['doi'] ?? null;

                            // Cari publikasi berdasarkan DOI
                            $existingPublication = Publikasi::where('doi', $doi)->first();

                            // Data yang akan dimasukkan atau diperbarui
                            $newData = [
                                'author_id' => $author_id ?? 'Unknown',
                                'title' => $article['title'],
                                'journal_name' => $article['journal_name'] ?? 'Unknown',
                                'publication_date' => $article['publication_date'] ?? null,
                                'citations' => $article['citations'] ?? 0,
                                'source' => 'scholar',
                            ];

                            if ($existingPublication) {
                                // Periksa apakah ada perubahan di kolom lain
                                $isUpdated = false;
                                foreach ($newData as $key => $value) {
                                    if ($existingPublication->$key !== $value) {
                                        $isUpdated = true;
                                        break;
                                    }
                                }

                                // Jika ada perubahan, lakukan pembaruan data
                                if ($isUpdated) {
                                    $existingPublication->update($newData);
                                }
                            } else {
                                // Jika DOI belum ada, tambahkan data baru
                                Publikasi::create(array_merge($newData, ['doi' => $doi]));
                            }
                        }
                    }
                }
            }
        } else {
            file_put_contents('scholar_error_log.txt', "Failed to scrape Scholar for user ID: $scholar_id\n", FILE_APPEND);
        }
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

        // Simpan respon untuk debugging jika diperlukan
        file_put_contents('response_log.html', $response);

        // Periksa apakah ada CAPTCHA dalam respon
        if (strpos($response, 'id="recaptcha"') !== false) {
            file_put_contents('scholar_error_log.txt', "CAPTCHA detected for URL: $base_url\n", FILE_APPEND);
            return null;
        }

        $dom = new \DOMDocument();
        @$dom->loadHTML($response);
        $xpath = new \DOMXPath($dom);
        $articles = [];

        foreach ($xpath->query('//tr[@class="gsc_a_tr"]') as $article) {
            $titleNode = $xpath->query('.//a[@class="gsc_a_at"]', $article)->item(0);
            $title = $titleNode ? trim($titleNode->textContent) : 'Unknown';

            $authorNode = $xpath->query('.//div[@class="gs_gray"]', $article)->item(0);
            $author = $authorNode ? trim($authorNode->textContent) : 'Unknown';

            $journalNode = $xpath->query('.//div[@class="gs_gray"]', $article)->item(1);
            $journal = $journalNode ? trim($journalNode->textContent) : 'Unknown';

            $yearNode = $xpath->query('.//span[@class="gsc_a_h gsc_a_hc gs_ibl"]', $article)->item(0);
            $year = $yearNode ? trim($yearNode->textContent) : null;

            $citationNode = $xpath->query('.//a[contains(@href,"cites")]', $article)->item(0);
            $citations = $citationNode ? preg_replace('/\D/', '', $citationNode->textContent) : 0;

            // Ambil URL artikel sebagai alternatif untuk DOI
            $linkNode = $xpath->query('.//a[@class="gsc_a_at"]', $article)->item(0);
            $doi = $linkNode ? $linkNode->getAttribute('href') : null;

            if ($title !== 'Unknown') {
                $articles[] = [
                    'title' => $title,
                    'author_name' => $author,
                    'journal_name' => $journal,
                    'publication_date' => $year,
                    'citations' => $citations,
                    'doi' => $doi ?? 'N/A', // Gunakan URL jika DOI tidak tersedia
                ];
            }
        }

        // Simpan data artikel untuk debugging
        file_put_contents('articles_log.txt', print_r($articles, true), FILE_APPEND);

        return $articles;
    }
}
