<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data user</title>
</head>
<body>
    <h1>Data user</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>ID Level pengguna</td>
            {{-- <td>Jumlah pengguna</td> --}}
        </tr>
        {{-- @foreach ($data as $d) --}}
            <tr>
                {{-- <td> {{$d->user_id}} </td>
                <td> {{$d->username}} </td>
                <td> {{$d->nama}} </td>
                <td> {{$d->level_id}} </td> --}}

                <td>{{ $data->user_id}}</td>
                <td>{{ $data->username}}</td>
                <td>{{ $data->nama}}</td>
                <td>{{ $data->level_id}}</td>
              
                {{-- <td>{{ $userCount}}</td>  --}}
            </tr>
        {{-- @endforeach --}}
    </table>
</body>
</html>