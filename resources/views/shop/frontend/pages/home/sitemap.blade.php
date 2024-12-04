<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($sitemaps as $sitemap)
    <url>
        <loc>{{ $sitemap['url'] }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($sitemap['last_modified'])->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach
</urlset>
