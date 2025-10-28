<!DOCTYPE html>
<html>
<head>
    <title>Authorize App</title>
</head>
<body>
    <h1>Autorizar Aplicación</h1>
    <p>¿Deseas autorizar que {{ $client->name }} acceda a tu cuenta?</p>

    <form method="POST" action="/oauth/authorize">
        @csrf
        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <button type="submit" name="approve" value="1">Autorizar</button>
        <button type="submit" name="deny" value="1">Rechazar</button>
    </form>
</body>
</html>
