<table border="0">
    <?php $i = $users_login->toArray()["from"];?>
    @foreach ($users_login as $user)
        <tr>
            <td>{{$i}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->waktu_login}}</td>
        </tr>
        <?php $i++;;?>
    @endforeach
</table>