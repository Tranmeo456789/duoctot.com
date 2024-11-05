<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="container">
        <h6 class="mb-3">This XML Sitemap contains {{ count($links) }} URLs.</h6>
        <a href="/sitemap.xml">← Sitemap Index</a>
        <table class="table table-striped mt-2">
            <thead class="">
            <tr style="background-color: #4275f4; color: white">
                <th>URL</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($links as $sitemap)
                <tr style="color: #05809e; font-size: 14px; cursor: pointer;" onclick="window.location='{{ $sitemap }}';">
                    <td><a href="{{ $sitemap }}" target="_blank">{{ $sitemap }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
