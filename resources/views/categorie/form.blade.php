<x-Master title="Ajouter Categorie">
    <div class="cont">
        <h2>Ajouter Categorie</h2>
        <form action="{{route('storecat')}}" method="post">
            @csrf
            <table border="1" align="center">
                <tr>
                    <th colspan="2">Nouvel Categorie</th>
                </tr>
                <tr>
                    <td>Désignation </td>
                    <td><input type="text" name="designation"></td>
                </tr>
                <tr>
                    <td>Description </td>
                    <td><textarea name="description"></textarea></td>
                </tr>


                <tr align="center">
                    <td><input type="submit" value="Valider"></td>
                    <td><input type="reset" value="Annuler"></td>
                </tr>
            </table>
        </form>


    </div>
</x-Master>