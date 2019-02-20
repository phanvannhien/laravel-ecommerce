<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_TAG') }}"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

		<link href="{{ url('/css/app.css' ) }}" rel="stylesheet" type="text/css"/>
		<link rel="icon" type="image/png" href="/favicon.png">

		<title></title>
		<meta name="description" content=""/>
		<link rel="canonical" href="{{ url('/') }}" />
		<meta property="og:locale" content="vi_VN" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="{{ url('/') }}" />
		<meta property="og:site_name" content="" />
		<meta property="og:image" content="" />
		<meta property="og:image:secure_url" content="" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:description" content="" />
		<meta name="twitter:title" content="" />
		<meta name="twitter:site" content="@phanvannhien" />
		<meta name="twitter:image" content="" />

		<script type='application/ld+json'>
			{
				"@context":"https:\/\/schema.org",
				"@type":"WebSite",
				"@id":"#website",
				"url":"https:\/\/roastandbrew.coffee\/",
				"name":"Roast And Brew"
			}
		</script>
		<script type='application/ld+json'>
			{
				"@context":"https:\/\/schema.org",
				"@type":"Organization",
				"url":"https:\/\/roastandbrew.coffee\/",
				"sameAs":
					[
						"https:\/\/www.facebook.com/roastandbrewcoffee\/",
						"https:\/\/twitter.com\/roast_n_brew"
					],
				"@id":"https:\/\/roastandbrew.coffee\/#organization",
				"name":"Roast And Brew",
				"logo":"https:\/\/roastandbrew.coffee\/img\/og-roast.jpg"
			}
		</script>

	</head>
	<body>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '{{ env('GOOGLE_GA') }}', 'auto');
			ga('send', 'pageview');
		</script>
		<div id="app">

		</div>
		<script type="text/javascript" src="{{ url('js/app.js') }}"></script>

	</body>
</html>
