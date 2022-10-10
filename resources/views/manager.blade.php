@php
    function applicationAddress($host, $type, $subAddres){
        if($host == ''){
            return '---';
        }
        if($type == 'subdomain'){
            return $subAddres.'.'.$host;
        }
        return $host.'/'.$subAddres;
    }
@endphp

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body >
        <div class="wrapper">

            @if(! empty($error))
                <div class="error">{{ $error }}</div>
            @endif
        
            <div class="card header">
                <div class="cel">Name</div>
                <div class="cel">IP</div>
                <div class="cel address">Address</div>
                <div class="cel status">Status</div>
            </div>
            <div class="card">
                    <div class="cel">foo-app</div>
                    <div class="cel">
                        {{ $foo?->getAttribute('status.hostIP', '---') }}
                    </div>
                    <div class="cel address">
                        <a target="blank" href="{{ applicationAddress( env('DOMAIN'), '', 'foo') }}">
                            {{ applicationAddress( env('DOMAIN'), '', 'foo') }}
                        </a>
                    </div>
                    <div class="cel status">{{ $foo ? $foo->getAttribute('status.phase', '---') : 'not-created' }}</div>
            </div>
            <div class="card">
                    <div class="cel">bar-app</div>
                    <div class="cel">
                        {{ $bar?->getAttribute('status.hostIP', '---') }}
                    </div>
                    <div class="cel address">
                        <a target="blank" href="{{ applicationAddress( env('DOMAIN'), '', 'bar') }}">
                            {{ applicationAddress( env('DOMAIN'), '', 'bar') }}
                        </a>
                    </div>
                    <div class="cel status">{{ $bar ? $bar->getAttribute('status.phase', '---') : 'not-created' }}</div>
            </div>

            <div class="display: block">
                <a class="button" href="{{ route('create-resource') }}">Create Resorce</a>
                <a class="button" href="{{ route('delete-resource') }}">Delete Resorce</a>
            </div>
        
        </div>
    </body>
</html>
