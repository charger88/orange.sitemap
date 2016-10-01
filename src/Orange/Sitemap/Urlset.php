<?php

namespace Sitemap;

class Urlset {
	
	const CFREQ_ALWAYS = 'always';
	const CFREQ_HOURLY = 'hourly';
	const CFREQ_DAILY = 'daily';
	const CFREQ_WEEKLY = 'weekly';
	const CFREQ_MONTHLY = 'monthly';
	const CFREQ_YEARLY = 'yearly';
	const CFREQ_NEVER = 'never';
	
	/**
     * @var \DOMDocument
     */
    private $sitemap;
	
    /**
     * @var \DOMElement
     */
    private $root;
	
	public function __construct(){
        $this->sitemap = new \DOMDocument('1.0','UTF-8');
        $this->root = $this->sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
	}
	
    public function addUrl($loc, $lastmod = null, $changefreq = null, $priority = null){
        $element = $this->sitemap->createElement('url');
        $element->appendChild(new \DOMElement('loc', htmlspecialchars($loc, ENT_COMPAT, 'UTF-8')));
        if (!is_null($lastmod)){
            $element->appendChild(new \DOMElement('lastmod', date(DATE_ATOM,$lastmod)));
        }
        if (!is_null($changefreq)){
			if (!in_array($changefreq, [self::CFREQ_ALWAYS, self::CFREQ_HOURLY, self::CFREQ_DAILY, self::CFREQ_WEEKLY, self::CFREQ_MONTHLY, self::CFREQ_YEARLY, self::CFREQ_NEVER])){
				throw new \Exception('Incorrect changefreq. Some predefined values are allowed only.');
			}
            $element->appendChild(new \DOMElement('changefreq', $changefreq));
        }
        if (!is_null($priority)){
			if (($priority < 0) || ($priority > 1)){
				throw new \Exception('Incorrect priority. Valid values range from 0.0 to 1.0.');
			}
            $element->appendChild(new \DOMElement('priority', $priority));
        }
        $this->root->appendChild($element);
    }
	
    public function build(){
        $this->sitemap->appendChild($this->root);
        return $this->sitemap->saveXML();
    }
	
}