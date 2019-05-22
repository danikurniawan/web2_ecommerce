
<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>

<body>
<h2 align="center">Halo {{$user['name']}}</h2>
<br/>
<p>Klik link dibawah ini untuk konfirmasi akun anda.</p>
<br/>
<a href="{{ url('/verifyUser') }}/{{$user['email_verification_token']}}" class="btn btn-primary">Verifikasi Email</a>
</body>

</html>
