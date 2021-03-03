<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}"/>

<meta property="og:locale" content="{{ $locale ?? config('app.locale') }}" />
<meta property="og:type" content="{{ $type ?? 'website' }}" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:url" content="{{ $url ?? Request::url() }}" />
@if(isset($image)) <meta property="og:image" content="{{ $image }}" /> @endif
<meta name="twitter:card" content="{{ $tw_type ?? 'summary' }}" />
@if(isset($tw_site)) <meta name="twitter:site" content="{{ $tw_site }}" /> @endif
@if(isset($tw_author)) <meta name="twitter:creator" content="{{ $tw_author }}" /> @endif
