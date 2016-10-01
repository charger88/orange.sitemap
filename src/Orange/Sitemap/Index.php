<?php

namespace Orange\Sitemap;

class Index {
	
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
        $this->root = $this->sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'sitemapindex');
	}
	
    public function addSitemap($loc, $lastmod = null){
        $element = $this->sitemap->createElement('sitemap');
        $element->appendChild(new \DOMElement('loc', htmlspecialchars($loc, ENT_COMPAT, 'UTF-8')));
        if (!is_null($lastmod)){
            $element->appendChild(new \DOMElement('lastmod', date(DATE_ATOM, $lastmod)));
        }
        $this->root->appendChild($element);
    }
	
    public function build(){
        $this->sitemap->appendChild($this->root);
        return $this->sitemap->saveXML();
    }
	
}