<form action="{{ route('findprod') }}" method="post" class="find">
    @csrf
    <table border="1" align="center">
    <tr><th>Critère</th>
        <td><input type="text" name="critere"></td>
        <td><input type="submit" value="Valider"></td>
    </tr>
    </table>
</form>