<x-Master title="Ajouter Produit">
    <div class="cont">
<h2>Ajouter Produit</h2>
<form action="{{ route('storeprod') }}" method="post">
    @csrf
    <table border="1" align="center">
    <tr><th colspan="2">Nouveau Produit</th></tr>
    <tr><td>Désignation </td><td><input type="text" name="designation"></td></tr>
    <tr><td>Description </td><td><textarea name="description"></textarea></td></tr>
    <tr><td>Image </td><td><input type="file" name="image"></td></tr>
    <tr><td>Prix </td><td><input type="number" name="prix"></td></tr>
    <tr><td>Date de Production </td><td><input type="datetime-local" name="dateprod"></td></tr>
    <tr><td>Catégorie </td><td>
    <select name="cat">
        <option value="0">choisir ici</option>
        @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->designation}}</option>
        @endforeach
    </select>
    </td></tr>
    <tr align="center"><td><input type="submit" value="Valider"></td><td><input type="reset" value="Annuler"></td></tr>
    </table>
</form>

<a href="{{route('indexprod')}}">Retour</a>
</div>
</x-Master>