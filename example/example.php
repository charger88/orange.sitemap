<?php

require_once __DIR__ . '/../src/Orange/Sitemap/Urlset.php';
require_once __DIR__ . '/../src/Orange/Sitemap/Index.php';

use \Orange\Sitemap\Urlset;
use \Orange\Sitemap\Index;

/* sitemap_pages.xml */
$index = new Urlset();
$index->addUrl('http://example.com/index.html', time(), Urlset::CFREQ_HOURLY, 0.2);
$index->addUrl('http://example.com/stats.html', time(), Urlset::CFREQ_ALWAYS, 0.5);
$index->addUrl('http://example.com/contacts.html?axd&test', time(), Urlset::CFREQ_MONTHLY, 1);
echo $index->build(); // Should be saved in file sitemap_pages.xml

/* sitemap_posts.xml */
$index = new Urlset();
$index->addUrl('http://example.com/my-post-1.html', time(), Urlset::CFREQ_NEVER, 0.9);
$index->addUrl('http://example.com/my-post-2.html', time(), Urlset::CFREQ_NEVER, 0.9);
$index->addUrl('http://example.com/my-post-3.html', time(), Urlset::CFREQ_NEVER, 0.9);
$index->addUrl('http://example.com/my-post-4.html', time(), Urlset::CFREQ_NEVER, 0.9);
$index->addUrl('http://example.com/my-post-5.html', time(), Urlset::CFREQ_NEVER, 0.9);
echo $index->build(); // Should be saved in file sitemap_posts.xml

/* sitemap.xml */
$index = new Index();
$index->addSitemap('http://example.com/sitemap_pages.xml', time());
$index->addSitemap('http://example.com/sitemap_posts.xml', time());
echo $index->build(); // Should be saved in file