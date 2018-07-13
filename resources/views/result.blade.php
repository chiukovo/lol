<!DOCTYPE html>
<html>
<head>
<title></title>
<link href="/css/result.css" rel="stylesheet">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="container">
    <div class="row profile">
        @foreach( $allData as $data )
        <div class="col-md-2">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="{{ $data['info']['img'] }}" class="img-responsive" alt="">
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $data['info']['name'] }}
                    </div>
                    <div class="profile-usertitle-job">
                        {{ $data['info']['rank'] }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
</html>